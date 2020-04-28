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

    public function upload($student, $file){
        
    }

    public function arranging_meeting_student($name, $create_date, $arrange_date, $note){
        $db = Database::getInstance()->connect;
        $query = "Select * from student_tutor where student_code = ?";
        $req = $db->prepare($query);
    
        $req->bindParam(1,$_SESSION['id']);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $st_id = $result['id'];

        $query = "insert into student_arrange(std_tutor_id, name, create_date, arrange_date, note) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$st_id);
        $stmt->bindParam(2,$name);
        $stmt->bindParam(3,$create_date);
        $stmt->bindParam(4,$arrange_date);
        $stmt->bindParam(5,$note);
        $stmt->execute();
        return $stmt->execute();
    }

    public function get_message_number($id){
        $db = Database::getInstance()->connect;
        $query = "Select COUNT(*) as count_message from message where name = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;                                                                                     
    }
    public function get_document_number($id){
        $db = Database::getInstance()->connect;
        $query = "Select COUNT(*) as count_document from file_detail where uploader = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$id);
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
             INNER join account 
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