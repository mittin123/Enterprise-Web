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

    public function arranging_meeting_tutor($name, $create_date, $arrange_date, $note){
        $db = Database::getInstance();
        $req = $db->prepare("Select * from student_tutor where student_code = ?");
    
        $req->bindParam(1,$_SESSION['id']);
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