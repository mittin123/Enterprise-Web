<?php
require_once("./#config.php");
require_once("Student.php");
require_once("Tutor.php");
class Staff{

    public function getAllStaff(){
        $staff_list = [];
        $db = Database::getInstance()->connect;
        $query = "Select * from account where type = 3";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $staff_list[] = $item;
        }
        return $staff_list;
    }

    public function getAllStudent(){
        $model_student = new Student();
        return $model_student->getAllStudent();
    }

    public function getAllTutor(){
        $tutor_list = [];
        $db = Database::getInstance()->connect;
        $query = "select tutor.*, account.last_login, count(student_tutor.id) as cnt FROM `tutor` 
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

    public function getTutor($id){
        $model_tutor = new Tutor();
        return $model_tutor->getTutor($id);
    }

    public function getListOfStudent($tutor_id){
        $model_tutor = new Tutor();
        return $model_tutor->getListOfStudent($tutor_id);
    }

    public function getUnallocatedStudent(){
        $model_student = new Student();
        return $model_student->getUnallocatedStudent();
    }

    public function allocateStudent($tutor_id, $student_id){
        $db = Database::getInstance()->connect;
        $model_student = new Student();
        $student = $model_student->findStudent($student_id);
        $student_code = $student['code'];

        $model_tutor = new Tutor();
        $tutor = $model_tutor->getTutor($tutor_id);
        $tutor_code = $tutor['code'];
        try{
            $query = "Insert into student_tutor (tutor_code, student_code) values (?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$tutor_code);
            $stmt->bindParam(2,$student_code);
            $stmt->execute();
            $result['message'] = "Success";
            $result['email_student'] = $student_code['email'];
            $result['email_tutor'] = $tutor_code['email'];
            return $result;
        }
        catch (Exception $ex){
            $result['message'] = $ex->getMessage();
            return $result;
        } 
    }
    public function deleteStudent($student_id){
        $db = Database::getInstance()->connect;
        $model_student = new Student();
        $student = $model_student->findStudentToDelete($student_id);
        $student_code = $student['code'];
        try{
            $query = "Delete from student_tutor where student_code = (?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$student_code);
            $stmt->execute();
            $result['message'] = "Success";
            $result['email'] = $student_code['email'];
            return $result;
        }
        catch (Exception $ex){
            $result['message'] = $ex->getMessage();
            return $result;
        } 
    }
    public function get_message_number_tutor(){
        $today = time();
        $lastWeek = time() - (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "select count(*) as tu_mess_num FROM message
        WHERE name in
        (SELECT account.username FROM `tutor` 
        INNER JOIN account
        on tutor.email = account.email) 
        and time between ? and ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$lastWeek);
        $stmt->bindParam(2,$today);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                     
    }
    public function get_message_number_stu(){
        $today = time();
        $lastWeek = time() - (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "select count(*) as std_mess_num FROM message
        WHERE name in
        (SELECT account.username FROM `student` 
        INNER JOIN account
        on student.email = account.email) 
        and time between ? and ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$lastWeek);
        $stmt->bindParam(2,$today);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                     
    }
    public function get_available_tutor_num(){
        $db = Database::getInstance()->connect;
        $query = "select count(A.tutor_code) as avai_tutor from (
            SELECT tutor_code, COUNT(student_code) FROM `student_tutor` 
            GROUP BY tutor_code 
            HAVING COUNT(student_code) < 10
        ) as A";
        $stmt = $db->query($query);
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                       
    }
    public function get_unallocate_student_num(){
        $today = time();
        $nextWeek = time() + (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "select count(student.id) as unall_stu FROM `student_tutor` 
        RIGHT JOIN student 
        on student.code = student_tutor.student_code 
        WHERE student.code not in (select student_tutor.student_code from student_tutor)";
        $stmt = $db->query($query);
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                       
    }

    public function getInactiveStudent(){
        $today = time();
        $check_time_7days = $today - (7 * 24 * 60 * 60);
        $check_time_28days = $today - (28 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "Select * from student join account on student.email = account.email where last_login <= ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$check_time_7days);
        $stmt->execute();
        $result['7_days_type'] = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $result['7_days_type'] [] = $item;
        }

        $query = "Select * from student join account on student.email = account.email where last_login <= ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$check_time_28days);
        $stmt->execute();
        $result['28_days_type'] = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $result['28_days_type'] [] = $item;
        }
        return $result;
    }

    public function getInactiveTutor(){
        $today = time();
        $check_time_7days = $today - (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "Select * from tutor join account on tutor.email = account.email where last_login <= ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$check_time_7days);
        $stmt->execute();
        $result = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $result [] = $item;
        }
        return $result;
    }
}
?>