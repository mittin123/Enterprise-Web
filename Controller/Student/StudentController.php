<?php
include_once("./Model/Student.php");
include_once("./Controller/Layout.php");
class StudentController extends LayoutController{
    public function getStudentInfo($email){
        $model_student = new Student();
        return $model_student->getStudentInfo($email);
    }

    public function view_all_folder($email){
        $model_student = new Student();
        $data = $model_student->view_all_folder($email);
        $this->loadView("folder_list_student",$data);
    }

    public function view_folder($folder_id){
        $model_student = new Student();
        $file_list = $model_student->get_file_list($folder_id);
        $folder_info = $model_student->get_folder_info($folder_id);
        $data['file_list'] = $file_list;
        $data['folder_info'] = $folder_info;
        $this->loadView("folder_detail",$data);
    }

    public function view_create_folder(){
        $this->loadView("create_folder");
    }
    
    public function create_folder($name, $std_tutor_id){
        $model_student = new Student();
        $result = $model_student->create_folder($name, $std_tutor_id);
        return $result;
    }

    public function uploadFile($student_email, $file, $folder_id, $type){
        $model_student = new Student();
        return $model_student->uploadFile($student_email, $file, $folder_id, $type);
    }

    public function viewArrangeList(){
        $view = new Student();
        $data = $view->view_arrange_list();
        $this->loadView("Student_Arrange",$data);
    }

    public function viewArrangeDetail($id){
        $viewD = new Student();
        $data['detail'] = $viewD->view_arrange_detail($id);
        $data['file'] = $viewD->getAllFile($id);
        $this->loadView("Student_Arrange_Detail",$data);
    }

    public function createArrange($name, $create_time, $arrange_date, $note){
        $viewD = new Student();
        $result = $viewD->arranging_meeting_student($name, $create_time, $arrange_date, $note);
        $data = $viewD->view_arrange_list();
        $this->loadView("Student_Arrange",$data);
    }

    public function loadAddArrange(){
        $viewD = new Student();
        $data['student_code'] = $stu_id;
        $this->loadView("Arranging-With-Student",$data);
    }

    public function checkAllocate(){
        $viewD = new Student();
        $check = $viewD->check_allocate();
        if($check){
            $data = $viewD->view_arrange_list();
            $this->loadView("Student_Arrange",$data);
        }else{
            $data['meeting_num'] = $viewD->get_meeting_number($_SESSION['email']);
            $data['message_num'] = $viewD->get_message_number($_SESSION['email']);
            $data['document_num'] = $viewD->get_document_number($_SESSION['email']);
            $this->loadView("index_student", $data);
        }
    }

    public function view_file_detail($file_id){
        $model_student = new Student();
        $file_detail = $model_student->get_file_detail($file_id);
        $this->loadView("file_detail",$file_detail);
    }

    public function view_file_detail_arrange($file_id){
        $model_student = new Student();
        $file_detail = $model_student->view_file_detail_arrange($file_id);
        $this->loadView("file_detail",$file_detail);
    }
}
?>