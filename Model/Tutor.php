<?php
include_once("./#config.php");
include_once("Student.php");
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
        $query = "Select A.*,C.id as std_tutor_id from tutor as A join account as B on A.email = B.email join student_tutor as C on C.tutor_code = A.code where A.email = ?";
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
        $db = Database::getInstance()->connect;
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
    /*
        code for upload file @ view
        $func = new Func();
        if(isset($_POST['submit]) && isset($_FILES['uploadFile'])){
            if($_FILES['uploadFile']['error'] == 0){
                
                $tutor_controller = new TutorController();
                $result = $tutor_controller->uploadFile($_SESSION['email'],$_FILES['uploadFile'],$upload_folder);
                $func->alert($result);
            }
            else{
                $func->alert("Error. Error code: ".$_FILES['uploadFile']['error']);
            }
        }
    */
    public function uploadFile($tutor_email, $file, $folder_id){
        move_uploaded_file($file['tmp_name'],'../upload/'.substr($tutor_email,0,strlen($tutor_email)-9).'/'.$folder_id.'/'.$file['name']);
        try{
            $db = Database::getInstance()->connect;
            $query = "Insert into file_detail (uploader, file_name, folder_id, comment, create_time, update_time, type) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $tutor_email);
            $stmt->bindParam(2, $file['name']);
            $stmt->bindParam(3, $folder_id);
            $stmt->bindParam(4, '');
            $stmt->bindParam(5, 'getdate()');
            $stmt->bindParam(6, 'getdate()');
            $stmt->bindParam(7, 1);
            $stmt->execute();
            return "Upload file success";
        }
        catch (Exception $ex){
            return $ex->getMessage();
        }
    }
    public function get_message_number($id){
        $today = time();
        $lastWeek = time() - (7 * 24 * 60 * 60);
        $db = Database::getInstance()->connect;
        $query = "select COUNT(*) as count_message from message
        where name in (
        select username from account
            where email in (
            select email from student
                where code in (
                select student_tutor.student_code from student_tutor
                    LEFT join tutor
                    on student_tutor.tutor_code = tutor.code
                    where tutor.email = ?
                )
            )
        )
        and stu_tu_id in (
                select student_tutor.id from student_tutor
                    LEFT join tutor
                    on student_tutor.tutor_code = tutor.code
                    where tutor.email = ?
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
        select email from student
            where code in (
            select student_code from student_tutor
                where id in (
                select id from student_tutor
                where tutor_code = (
                select code from tutor
                    where email = 'tutor@gmail.com'
                )
                )
            )
        )
        and folder_id in (
        select id from folder
            where std_tutor_id in (
            select id from student_tutor
                where tutor_code = (
                select code from tutor
                    where email = 'tutor@gmail.com'
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
        where std_tutor_id in  
        ( select id FROM student_tutor 
         where tutor_code = ( 
             select tutor.code from tutor 
             LEFT join account 
             on tutor.email = account.email 
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