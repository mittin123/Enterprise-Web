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
    public function loadExceptionReportPage(){
        $staff = new Staff();
        $data['student_without_tutor'] = $staff->getUnallocatedStudent();
        $data['student_without_interaction'] = $staff->getInactiveStudent();
        $data['tutor_without_interaction'] = $staff->getInactiveTutor();
        $this->loadView("exception_report",$data);
    }
    public function loadStatisticReportPage(){
        $auth_staff = new AuthStaff();
        $data = $auth_staff->getStatisticReport();
        $new_data = [];
        $i = 0;
        while($i<count($data['message_stat'])){
            $new_data['message'][$i]['tutor_name'] = $data['message_stat'][$i]['name'];
            $new_data['message'][$i]['average_message'] = $data['message_stat'][$i]['Total_message']/$data['student_stat'][$i]['Total_student'];
            $new_data['message'][$i]['7_days_message'] = $data['message_stat'][$i]['7_days_message'];
            $i++;
        }
        $i =0;
        while($i<count($data['arrange_stat'])){
            $new_data['arrange'][$i]['tutor_name'] = $data['arrange_stat'][$i]['email'];
            $new_data['arrange'][$i]['7_days_arrangement'] = $data['arrange_stat'][$i]['Total_arrangement'];
            $i++;
        }
        $this->loadView("statistic_report",$new_data);
    }
}
?>