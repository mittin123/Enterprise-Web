<?php
include("student.php");
include("tutor.php");
class Staff{

    public function getAllStudent(){
        $model_student = Student::getInstance();
        return $model_student->getAllStudent();
    }

    public function getAllTutor(){
        $model_tutor = Tutor::getInstance();
        return $model_tutor->getAllTutor();
    }
}
?>