<?php
include_once("./Model/Student.php");
include_once("./Controller/Layout.php");
class StudentController{
    public function uploadFile($student, $file, $folder_id){

    }

    public function viewArrangeList(){
        $view = new Student();
        $data = $view->view_arrange_list();
        $this->loadView("Student_Arrange",$data);
    }

    public function viewArrangeDetail($id){
        $viewD = new Student();
        $data = $viewD->view_arrange_detail($id);
        $this->loadView("Student_Arrange_Detail",$data);
    }

    public function addArrange(){
        $viewD = new Student();
        $data = '';
        $this->loadView("ArrangingStudent",$data);
    }

    public function checkAllocate(){
        $viewD = new Student();
        $check = $viewD->check_allocate()
        if($check['check_allocate'] > 0){
            $data = $viewD->view_arrange_list();
            $this->loadView("Student_Arrange",$data);
        }else{
            $data['meeting_num'] = $viewD->get_meeting_number($_SESSION['email']);
            $data['message_num'] = $viewD->get_message_number($_SESSION['email']);
            $data['document_num'] = $viewD->get_document_number($_SESSION['email']);
            $this->loadView("index_student", $data);
        }
    }
}
?>