<?php
require_once("./#config.php");
class Student{

    private $name;
    private $email;

    public function __construct(){
        
    }
    public function create($name, $email){
        $this->name = $name;
        $this->email = $email;
    }
    public function getAllStudent(){
        $student_list = [];
        $db = Database::getInstance()->connect;
        $query = "Select * from student";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $student_list[] = $item;
        }
        return $student_list;
    }

    public function upload($student, $file){
        
    }
}