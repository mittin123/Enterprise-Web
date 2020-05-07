<?php
include_once("./Model/Tutor.php");
include_once("./Controller/Layout.php");
class TutorController extends LayoutController{
    public function getTutorInfo($email){
        $model_tutor = new Tutor();
        return $model_tutor->getTutorInfo($email);
    }
    public function uploadFile($tutor_email, $file_name, $folder_id, $type){
        $model_tutor = new Tutor();
        $result = $model_tutor->uploadFile($tutor_email, $file_name, $folder_id, $type);
        return $result;
    }
    public function view_all_folder($email){
        $model_tutor = new Tutor();
        $data = $model_tutor->view_all_folder($email);
        $this->loadView("folder_list",$data);
    }

    public function view_folder($folder_id){
        $model_tutor = new Tutor();
        $file_list = $model_tutor->get_file_list($folder_id);
        $folder_info = $model_tutor->get_folder_info($folder_id);
        $data['file_list'] = $file_list;
        $data['folder_info'] = $folder_info;
        $this->loadView("folder_detail",$data);
    }
    
    public function view_file_detail($file_id){
        $model_tutor = new Tutor();
        $file_detail = $model_tutor->get_file_detail($file_id);
        $this->loadView("file_detail",$file_detail);
    }

    public function view_file_detail_arrange($file_id){
        $model_tutor = new Tutor();
        $file_detail = $model_tutor->view_file_detail_arrange($file_id);
        $this->loadView("file_detail",$file_detail);
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
 public function getStudentListA_Z($tutor_email){
        $model_tutor = new Tutor();
        $result = $model_tutor->getStudentListA_Z($tutor_email);
        $this->loadView("student_list_for_tutor",$result);
    }
    public function getStudentListLastInteraction($tutor_email){
        $model_tutor = new Tutor();
        $result = $model_tutor->getStudentListLastInteraction($tutor_email);
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
        $data['file'] = $viewD->view_file_list($id);
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