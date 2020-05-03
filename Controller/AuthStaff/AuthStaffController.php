<?php
include_once("./Model/AuthStaff.php");
include_once("./Model/Student.php");
include_once("./Model/Tutor.php");
include_once("./Model/Staff.php");
include_once("./Controller/Layout.php");

class AuthStaffController extends LayoutController{
    public function getAllTutor(){
        $tutor_list = new AuthStaff();
        $data = $tutor_list->getAllTutor();
        $this->loadView('Tutor_List_For_Authorize_Staff', $data);
    }
    public function getAllStudent(){
        $stu_list = new AuthStaff();
        $data = $stu_list->getAllStudent();
        $this->loadView('Student_List_For_Authorize_Staff', $data);
    }
    public function getAllStaff(){
        $staff_list = new AuthStaff();
        $data = $staff_list->getAllStaff();
        $this->loadView('Staff_List_For_Authorize_Staff', $data);
    }

    public function loadStaffDash(){
        $staD = new Staff();
        $data['tu_message_num'] = $staD->get_message_number_tutor();
        $data['stu_message_num'] = $staD->get_message_number_stu();
        $data['tutor_num'] = $staD->get_available_tutor_num();
        $data['stu_num'] = $staD->get_unallocate_student_num();
        $this->loadView("index_staff_for_authstaff", $data);
    }

    public function loadStudentDash($email){
        $stuD = new Student();
        $data['meeting_num'] = $stuD->get_meeting_number($email);
        $data['message_num'] = $stuD->get_message_number($email);
        $data['document_num'] = $stuD->get_document_number($email);
        $this->loadView("index_student_for_authstaff", $data);
    }

    public function loadTutorDash($email){
        $tuD = new Tutor();
        $data['meeting_num'] = $tuD->get_meeting_number($email);
        $data['message_num'] = $tuD->get_message_number($email);
        $data['document_num'] = $tuD->get_document_number($email);
        $this->loadView("index_tutor_for_authstaff", $data);
    }
    public function getExceptionReport(){
        $staff = new Staff();
        $data['student_without_tutor'] = $staff->loadUnallocatedStudent();
        $data['student_without_interaction'] = $staff->getInactiveStudent();
        $data['tutor_without_interaction'] = $staff->getInactiveTutor();
        $this->loadView("exception_report",$data);
    }
}
?>