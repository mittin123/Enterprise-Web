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
        $model_tutor = new Tutor();
        return $model_tutor->getAllTutor();
    }

    public function getAllStaff(){
        $model_staff = new Staff();
        return $model_staff->getAllStaff();
    }

    public function getUnallocatedStudentNumber(){
        $db = Database::getInstance()->connect;
        $query = "Select count(*) from student where code not in (Select student_code from student_tutor)";
        $stmt = $db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getMessageNumber(){
        $db = Database::getInstance()->connect;
        $query = "Select count(*) from message";
        $stmt = $db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getInactiveStudentNumber(){
        $db = Database::getInstance()->connect;
        $time = time() - (28 * 24 * 60 * 60);
        $query = "Select count(*) from student where email in (Select email from account where last_login > ?)";
        $stmt = $db->prepare($query);
        $stmt = bindParam(1, $time)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getInactiveTutorNumber(){
        $db = Database::getInstance()->connect;
        $time = time() - (7 * 24 * 60 * 60);
        $query = "Select count(*) from tutor where email in (Select email from account where last_login > ?)";
        $stmt = $db->prepare($query);
        $stmt = bindParam(1, $time)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>