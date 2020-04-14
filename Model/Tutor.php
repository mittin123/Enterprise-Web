<?php
include("../#config.php");
include("student.php");
class Tutor{

    public function __construct(){
        
    }
    public function getAllStudent(){
        $model_student = Student::getInstance();
        return $model_student->getAllStudent();
    }
    
    public function getAllTutor(){
        $tutor_list = [];
        $db = Database::getInstance();
        $query = $db->query("Select * from Tutor");
        foreach($db->fetchAll($query) as $item){
            $tutor_list [] = new Tutor();
        }
    }
}