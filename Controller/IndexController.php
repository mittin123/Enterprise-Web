<?php
include("Layout.php");
include_once("./Model/Staff.php");
include_once("./Model/Student.php");
include_once("./Model/Tutor.php");
include_once("./Model/AuthStaff.php");
include_once("./Model/Home.php");

class IndexController extends LayoutController{
    public function index($type){
        switch($type){
            case 1:
                $stuD = new Student();
                $data['meeting_num'] = $stuD->get_meeting_number($_SESSION['email']);
                $data['message_num'] = $stuD->get_message_number($_SESSION['email']);
                $data['document_num'] = $stuD->get_document_number($_SESSION['email']);
                $this->loadView("index_student", $data);
            break;
            case 2:
                $tuD = new Tutor();
                $data['meeting_num'] = $tuD->get_meeting_number($_SESSION['email']);
                $data['message_num'] = $tuD->get_message_number($_SESSION['email']);
                $data['document_num'] = $tuD->get_document_number($_SESSION['email']);
                $this->loadView("index_tutor", $data);
            break;
            case 3:
                $staD = new Staff();
                $data['tu_message_num'] = $staD->get_message_number_tutor();
                $data['stu_message_num'] = $staD->get_message_number_stu();
                $data['tutor_num'] = $staD->get_available_tutor_num();
                $data['stu_num'] = $staD->get_unallocate_student_num();
                $this->loadView("index_staff", $data);
            break;
            case 4:
                $astaD = new AuthStaff();
                $data['inactive_stu'] = $astaD->getInactiveStudentNumber();
                $data['inactive_tutor'] = $astaD->getInactiveTutorNumber();
                $data['unallocate_stu'] = $astaD->getUnallocatedStudentNumber();
                $data['mess_number'] = $astaD->getMessageNumber();
                $this->loadView("index_authstaff", $data);
            break;
            default:
                $blog = new Home();
                $data = $blog->getAllBlog();
                $this->loadView("index_default", $data);
            break;
        }
    }
} 
?>