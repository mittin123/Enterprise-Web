<?php
require_once("Student.php");
require_once("Tutor.php");
class Staff{

    public function getAllStudent(){
        $model_student = new Student();
        return $model_student->getAllStudent();
    }

    public function getAllTutor(){
        $model_tutor = new Tutor();
        return $model_tutor->getAllTutor();
    }
}
?>