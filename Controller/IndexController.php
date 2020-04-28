<?php
include("Layout.php");
include_once("./Model/Staff.php");
include_once("./Model/Student.php");
include_once("./Model/Tutor.php");

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

                $this->loadView("index_tutor", $data);
            break;
            case 3:

                $this->loadView("index_staff", $data);
            break;
            default:
                $this->loadView("index_default");
            break;
        }
    }
} 
?>