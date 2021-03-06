<?php
include_once("./#config.php");
include_once("Staff.php");

class AuthStaff{
    public function __construct(){
        
    }
    public function getAllStudent(){
        $stu_list = [];
        $db = Database::getInstance()->connect;
        $query = "select *, account.last_login FROM `student` 
        inner join account 
        on student.email = account.email";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $tutor_list[] = $item;
        }
        return $tutor_list;
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

    public function getStatisticReport(){
        $db = Database::getInstance()->connect;
        $time = time() - (7*24*60*60);
        $query = "select count(message.message) as Total_message, 
        (Select count(message) from message where time >= ?) as 7_days_message, message.name from message 
                join tutor on message.name = tutor.email 
                group by message.`name`";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $time);
        $stmt->execute();
        $message_statistic = [];
        $student_count_statistic = [];
        $arrange_statistic = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $message_statistic [] = $item;
        }
        $query = "select '0' as Total_message, '0' as 7_days_message, tutor.email as name from tutor where tutor.email not in (Select name from message)";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $message_statistic [] = $item;
        }
        $query = "Select count(student_tutor.student_code) as Total_student, tutor_code, email from student_tutor join tutor on tutor.code = student_tutor.tutor_code group by tutor_code";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $student_count_statistic [] = $item;
        }
        $query = "Select '0' as Total_student, tutor.email from tutor where code not in (Select tutor_code from student_tutor)";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $student_count_statistic [] = $item;
        }
        $data['message_stat'] = $message_statistic;
        $data['student_stat'] = $student_count_statistic;

        $query = "Select count(*) as Total_arrangement, email from student_arrange join student_tutor on student_tutor.id = std_tutor_id join tutor on tutor.`code` = tutor_code where arrange_date >= ? group by code";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $time);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $arrange_statistic [] = $item;
        }
        
        $query = "Select '0' as Total_arrangement, email from tutor where code not in(Select tutor_code from student_tutor where id in(Select std_tutor_id from student_arrange))";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $arrange_statistic [] = $item;
        }
        $data['arrange_stat'] = $arrange_statistic;
        return $data;
    }

}
?>