<?php
include("../model/tutor.php");
include_once("./Controller/Layout.php");
class TutorController extends LayoutController{
    public function uploadFile($tutor, $file, $folder_id){

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
}
?>