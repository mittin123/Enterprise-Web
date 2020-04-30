<?php
include_once("./Model/Tutor.php");
include_once("./Controller/Layout.php");
class TutorController extends LayoutController{
    public function getTutorInfo($email){
        $model_tutor = new Tutor();
        return $model_tutor->getTutorInfo($email);
    }
    public function uploadFile($tutor, $file, $folder_id){
        $model_tutor = new Tutor();
        $result = $model_tutor->uploadFile($tutor_email, $file, $folder_id);
        return $result;
    }

    public function createFolder($tutor, $folder_name){
        $model_tutor = new Tutor();
        $result = $model_tutor->createFolder($tutor, $folder_name);
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
}
?>