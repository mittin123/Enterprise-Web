<?php
include_once("./#config.php");
include_once("Student.php");
class Tutor{

    public function __construct(){

    }

    public function view_all_folder($tutor_email){
        $tutor_info = self::getTutorInfo($tutor_email);
        $std_tutor_code = $tutor_info['code'];
        $db = Database::getInstance()->connect;
        $folder_list = [];
        $query = "Select A.*, count(B.id) as number_of_files from folder as A join file_detail as B on A.id = B.folder_id where std_tutor_id in (select * from student_tutor where tutor_code =  ?) group by A.id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $std_tutor_code);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $folder_list[] = $item;
        }
        return $folder_list;
    }

    public function view_file_list($id){
        $file_list = [];
        $db = Database::getInstance()->connect;
        $query="select * from file_detail 
        where type = 1 and uploader in (
            Select B.email as stu_email from student_tutor as A 
            join student as B 
            on A.student_code = B.code 
            join account as C 
            on C.email = B.email 
            where tutor_code = (
                Select A.code from tutor as A 
                join account as B 
                on A.email = B.email 
                join student_tutor as C 
                on C.tutor_code = A.code 
                where A.email = ? 
                group by A.code
            )
        ) 
        and folder_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $_SESSION['email']);
        $stmt->bindParam(2, $id);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $file_list[] = $item;
        }
        return $file_list;
    }

    public function get_file_list($std_tutor_id){
        $file_list = [];
        $db = Database::getInstance()->connect;
        $query = "Select A.* from file_detail as A join folder as B on A.folder_id = B.id where B.id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$std_tutor_id);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $file_list[] = $item;
        }
        return $file_list;
    }
    
    public function get_file_detail($file_id){
        $db = Database::getInstance()->connect;
        $query = "Select * from file_detail where id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $file_id);
        $stmt->execute();
        $result['file_detail'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $result['comment'] = self::get_file_comment($file_id);
        return $result;
    }

    public function get_file_comment($file_id){
        $db = Database::getInstance()->connect;
        $query = "Select * from comment where file_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $file_id);
        $stmt->execute();
        $comment_list = [];
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $item){
            $comment_list[] = $item;
        }
        return $comment_list;
    }
    public function get_folder_info($std_tutor_id){
        $db = Database::getInstance()->connect;
        $query = "Select * from folder where std_tutor_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$std_tutor_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create_folder($tutor_email, $std_tutor_id, $folder_name){
        $root = $_SERVER["DOCUMENT_ROOT"];
        $time = time();
        if (!file_exists($root.'/upload/'.$std_tutor_id.'/'.$folder_name)) {
            mkdir($root.'/upload/'.$std_tutor_id.'/'.$folder_name, 0755, true);
          
            $db = Database::getInstance()->connect;
            $query = "Insert into folder (std_tutor_id, name, create_time, update_time) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1,$std_tutor_id);
            $stmt->bindParam(2,$folder_name);
            $stmt->bindParam(3,$time);
            $stmt->bindParam(4,$time);
            $stmt->execute();
            return "Create folder ".$folder_name." success";
        }
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
        $query = "Select *,C.id as account_id, B.email as stu_email from student_tutor as A join student as B on A.student_code = B.code join account as C on C.email = B.email where tutor_code = ?";
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

    public function arranging_meeting_tutor($std_code, $title, $create_date, $arrange_date, $note){
        $db = Database::getInstance()->connect;
        $req = $db->prepare("Select * from student_tutor where student_code = ? and tutor_code = (select code from tutor where email = ?)");
        $req->bindParam(1,$std_code);
        $req->bindParam(2,$_SESSION['email']);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $st_id = $result['id'];

        $req = $db->prepare("Select * from student where code = ?");
        $req->bindParam(1,$std_code);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        $stu_name = $result['name'];

        $query = "insert into student_arrange(std_tutor_id, title, name, create_date, arrange_date, note) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$st_id);
        $stmt->bindParam(2,$title);
        $stmt->bindParam(3,$stu_name);
        $stmt->bindParam(4,$create_date);
        $stmt->bindParam(5,$arrange_date);
        $stmt->bindParam(6,$note);
        $stmt->execute();
    }
    public function view_arrange_list(){
        $db = Database::getInstance()->connect;
        $arrange_list = [];
        $query="select * from student_arrange where std_tutor_id in (
            Select id from student_tutor 
        where tutor_code = 
        (select tutor.code from tutor 
        inner join account 
        on tutor.email = account.email 
        where tutor.email = ?))";
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
    public function uploadFile($tutor_email, $file_name, $folder_id){
        try{
            $time = time();
            $comment = "no comment";
            $type = 1;
            $db = Database::getInstance()->connect;
            $query = "Insert into file_detail (uploader, file_name, folder_id, comment, create_time, update_time, type) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $tutor_email);
            $stmt->bindParam(2, $file_name);
            $stmt->bindParam(3, $folder_id);
            $stmt->bindParam(4, $comment);
            $stmt->bindParam(5, $time);
            $stmt->bindParam(6, $time);
            $stmt->bindParam(7, $type);
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
        WHERE uploader in (
        select email from student
            where code in (
            select student_code from student_tutor
                where id in (
                select id from student_tutor
                where tutor_code = (
                select code from tutor
                    where email = ?
                )
                )
            )
        )";
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