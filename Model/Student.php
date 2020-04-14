<?php
include("../#config.php");
class Student{
    public function __construct(){

    }
    public function getAllStudent(){
        $student_list = [];
        $db = Database::getInstance();
        $query = $db->query("Select * from Student");
        foreach($db->fetchAll($query) as $item){
            $student_list[] = new Student($item);
        }
    }

    public function upload($student, $file){
        
    }
}