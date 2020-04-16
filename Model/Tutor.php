<?php
require_once("./#config.php");
require_once("Student.php");
class Tutor{

    public function __construct(){

    }
    public function getAllStudent(){
        $model_student = new Student();
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

    public function assignStudent($student_id, $tutor_id){
        $result = true;
        $db = Database::getInstance();
        try{
            $stmt = $db->prepare("Insert into Student_Tutor (tutor_code, student_code) VALUES (?, ?)");
            $stmt->bindParam(1,$tutor_id);
            $stmt->bindParam(2,$student_id);
        }
        catch (PDOException $ex){
            $result = $ex->getMessage(); 
        }
        
        return $result;
    }
}