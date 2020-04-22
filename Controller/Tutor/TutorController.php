<?php
include("../model/tutor.php");
class TutorController{
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
}
?>