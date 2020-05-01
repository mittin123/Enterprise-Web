<?php
include_once("./Model/Tutor.php");
include_once("./Controller/Layout.php");
class TutorController extends LayoutController{
    public function getTutorInfo($email){
        $model_tutor = new Tutor();
        return $model_tutor->getTutorInfo($email);
    }
    public function uploadFile($tutor_email, $file_name, $folder_id){
        $model_tutor = new Tutor();
        $result = $model_tutor->uploadFile($tutor_email, $file_name, $folder_id);
        return $result;
    }
    public function view_all_folder($email){
        $model_tutor = new Tutor();
        $data = $model_tutor->view_all_folder($email);
        $this->loadView("folder_list",$data);
    }

    public function view_folder(){
        $this->loadView("folder_detail");
    }
    
    public function view_create_folder(){
        $this->loadView("create_folder");
    }
    
    public function create_folder($email, $folder_name, $std_tutor_id){
        $model_tutor = new Tutor();
        $result = $model_tutor->create_folder($email, $std_tutor_id, $folder_name);
        return $result;
    }
    
    public function assignStudent($student_id, $tutor_id){
        $model_tutor = new Tutor();
        $result = $model_tutor->assignStudent($student_id, $tutor_id);
        if($result){
            return true;
        }
        else{
            return $result;
        }
    }

    public function getStudentList($tutor_email){
        $model_tutor = new Tutor();
        $result = $model_tutor->getStudentList($tutor_email);
        $this->loadView("student_list_for_tutor",$result);
    }

    public function viewArrangeList(){
        $view = new Tutor();
        $data = $view->view_arrange_list();
        $this->loadView("Tutor_Arrange",$data);
    }

    public function viewArrangeDetail($id){
        $viewD = new Tutor();
        $data['detail'] = $viewD->view_arrange_detail($id);
        //$data['file'] = $viewD->view_file_list($id);
        $this->loadView("Tutor_Arrange_Detail",$data);
    }

    public function loadAddArrange($stu_id){
        $viewD = new Tutor();
        $data['student_code'] = $stu_id;
        $this->loadView("Arranging-With-Tutor",$data);
    }

    public function createArrange($std_code, $title, $create_date, $arrange_date, $note){
        $viewD = new Tutor();
        $result = $viewD->arranging_meeting_tutor($std_code, $title, $create_date, $arrange_date, $note);
        $data = $viewD->view_arrange_list();
        $this->loadView("Tutor_Arrange",$data);
    }
}
?>