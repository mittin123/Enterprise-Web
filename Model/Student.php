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

    public function view_all_folder($stu_email){
        $stu_info = self::getStudentInfo($stu_email);
        $std_tutor_code = $stu_info['code'];
        $db = Database::getInstance()->connect;
        $folder_list = [];
        $query = "Select A.*, count(B.id) as number_of_files from folder as A join file_detail as B on A.id = B.folder_id where std_tutor_id in (select * from student_tutor where student_code =  ?) group by A.id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $std_tutor_code);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $folder_list[] = $item;
        }
        return $folder_list;
    }

    public function getUnallocatedStudent(){
        $student_list = [];
        $db = Database::getInstance()->connect;
        $query = "Select * from student where code not in (Select student_code from student_tutor)";
        foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
            $student_list[] = $item;
        }
        return $student_list;
    }

    public function findStudent($student_id){
        $db = Database::getInstance()->connect;
        $query = "Select * from student where id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$student_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getStudentInfo($email){
        $db = Database::getInstance()->connect;
        $query = "Select A.email,B.code,C.id as std_tutor_id from student as A join account as B on A.email = B.email join student_tutor as C on C.id = B.id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function upload($student, $file){

    }

    public function check_allocate(){
        $db = Database::getInstance()->connect;
        $query = "select count(*) as check_allocate FROM `student_tutor` 
        WHERE student_code = (
        SELECT student.code from student
            INNER JOIN account
            ON student.email = account.email
            WHERE student.email = ?
        )";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$_SESSION['email']);
        $stmt->execute();
        $result = $stmt->rowCount();
        if($result > 0){
            return true;
        }else{
            return false;
        }
    }

    public function arranging_meeting_student($name, $create_time, $arrange_date, $note){
        $db = Database::getInstance()->connect;

        $query = "select * from student
        where email = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$_SESSION['email']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $s_name = $result['name'];

        $query = "Select * from student_tutor 
        where student_code = 
        (select student.code from student 
        inner join account 
        on student.email = account.email 
        where student.email = ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$_SESSION['email']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $st_id = $result['id'];

        $query = "insert into student_arrange(std_tutor_id, title, name, create_date, arrange_date, note) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$st_id);
        $stmt->bindParam(2,$name);
        $stmt->bindParam(3,$s_name);
        $stmt->bindParam(4,$create_time);
        $stmt->bindParam(5,$arrange_date);
        $stmt->bindParam(6,$note);
        $stmt->execute();
    }

    public function view_arrange_list(){
        $db = Database::getInstance()->connect;
        $arrange_list = [];
        $query="select * from student_arrange where std_tutor_id = (
            Select id from student_tutor 
        where student_code = 
        (select student.code from student 
        inner join account 
        on student.email = account.email 
        where student.email = ?))";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$_SESSION['email']);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $arrange_list[] = $item;
          }
          return $arrange_list;
    }

    public function view_arrange_detail($id){
        $db = Database::getInstance()->connect;
        $query="select * from student_arrange where id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_message_number($id){
        $today = time();
        $lastWeek = time() - (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "select COUNT(*) as count_message from message
        where name = (
        select username from account
            where email = (
            select email from tutor
                where code = (
                select student_tutor.tutor_code from student_tutor
                    LEFT join student
                    on student_tutor.student_code = student.code
                    where student.email = ?
                )
            )
        )
        and stu_tu_id = (
                select student_tutor.id from student_tutor
                    LEFT join student
                    on student_tutor.student_code = student.code
                    where student.email = ?
                )
        and time between ? and ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$id);
        $stmt->bindParam(3,$lastWeek);
        $stmt->bindParam(4,$today);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                     
    }
    public function get_document_number($id){
        $db = Database::getInstance()->connect;
        $query = "select count(*) as count_document FROM `file_detail` 
        WHERE uploader = (
        select email from tutor
            where code = (
            select tutor_code from student_tutor
                where id = (
                select id from student_tutor
                where student_code = (
                select code from student
                    where email = ?
                )
                )
            )
        )
        and folder_id in (
        select id from folder
            where std_tutor_id = (
            select id from student_tutor
                where student_code = (
                select code from student
                    where email = ?
                )
            )
        )";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$id);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                       
    }
    public function get_meeting_number($id){
        $today = time();
        $nextWeek = time() + (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "select COUNT(*) as count_meeting FROM `student_arrange` 
        where std_tutor_id = 
        ( select id FROM student_tutor 
         where student_code = ( 
             select student.code from student 
             LEFT join account 
             on student.email = account.email 
             WHERE account.email = ? ) 
        )
        and arrange_date BETWEEN ? and ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$today);
        $stmt->bindParam(3,$nextWeek);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                       
    }
}