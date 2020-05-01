<?php
include_once("./#config.php");
include_once("Student.php");
include_once("Tutor.php");
include_once("Staff.php");

class AuthStaff{
    public function __construct(){
        
    }
    public function getAllStudent(){
        $model_student = new Student();
        return $model_student->getAllStudent();
    }
    public function getAllTutor(){
        $tutor_list = [];
        $db = Database::getInstance()->connect;
        $query = "select *, count(student_tutor.id) as cnt FROM `tutor` 
        inner join student_tutor 
        on tutor.code = student_tutor.tutor_code 
        inner join account 
        on tutor.email = account.email 
        group by student_tutor.tutor_code";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $tutor_list[] = $item;
        }
        return $tutor_list;
    }

    public function getAllStaff(){
        $model_staff = new Staff();
        return $model_staff->getAllStaff();
    }

    public function getUnallocatedStudentNumber(){
        $db = Database::getInstance()->connect;
        $query = "Select count(*) as unallocated from student where code not in (Select student_code from student_tutor)";
        $stmt = $db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getMessageNumber(){
        $db = Database::getInstance()->connect;
        $today = time();
        $lastWeek = time() - (7 * 24 * 60 * 60);
        $query = "Select count(*) as mess_num from message where time between ? and ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $lastWeek);
        $stmt->bindParam(2, $today);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getInactiveStudentNumber(){
        $db = Database::getInstance()->connect;
        $time = time() - (28 * 24 * 60 * 60);
        $query = "Select count(*) as inactive_student from student where email in (Select email from account where last_login < ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $time);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getInactiveTutorNumber(){
        $db = Database::getInstance()->connect;
        $time = time() - (7 * 24 * 60 * 60);
        $query = "Select count(*) as inactive_tu from tutor where email in (Select email from account where last_login < ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $time);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>