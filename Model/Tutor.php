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

    public function arranging_meeting_tutor($std_code, $name, $create_date, $arrange_date, $note){
        $db = Database::getInstance();
        $req = $db->prepare("Select * from student_tutor where student_code = ? and tutor_code = ?");
        $req->bindParam(1,$std_code);
        $req->bindParam(2,$_SESSION['id']);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $st_id = $result['id'];

        $query = "INSERT into student_arrange(std_tutor_id, name, create_date, arrange_date, note) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$st_id);
        $stmt->bindParam(2,$name);
        $stmt->bindParam(3,$create_date);
        $stmt->bindParam(4,$arrange_date);
        $stmt->bindParam(5,$note);
        $stmt->execute();
        return $stmt->execute();
    }
}