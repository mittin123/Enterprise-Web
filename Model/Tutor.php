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
        $db = Database::getInstance()->connect;
        $query = "Select * from tutor";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $tutor_list[] = $item;
        }
        return $tutor_list;
    }

    public function getStudentList($email){
        $tutor_info = self::getTutorInfo($email);
        $student_list = self::getListOfStudent($tutor_info['id']);
        return $student_list;
    }
    
    public function getTutorInfo($email){
        $db = Database::getInstance()->connect;
        $query = "Select * from tutor where email = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        $tutor = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tutor;
    }

    public function getTutor($id){
        $db = Database::getInstance()->connect;
        $query = "Select A.*, COUNT(B.student_code) as student_count from tutor as A join student_tutor as B on A.code = B.tutor_code where A.id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $tutor_detail = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tutor_detail;
    }

    public function getListOfStudent($tutor_id){
        $db = Database::getInstance()->connect;
        $student_list = [];
        $tutor = self::getTutor($tutor_id);
        $tutor_code = $tutor['code'];
        $query = "Select * from student_tutor as A join student as B on A.student_code = B.code where tutor_code = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$tutor_code);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $student_list[] = $item;
        }
        return $student_list;
    }

    public function assignStudent($student_id, $tutor_id){
        $result = true;
        $db = Database::getInstance()->connect;
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