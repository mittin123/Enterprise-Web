<?php
// view folder + create folder
include("Controller/Tutor/TutorController.php");
include("Controller/Student/StudentController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$tutor_page = new TutorController();
$student_page = new StudentController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if (isset($_SESSION['email'])){
    if(isset($_GET['stu_id'])){
        $student_page->view_all_folder($_SESSION['email']); 
    }
    else if(!isset($_GET['id']) && !isset($_GET['action'])){
        $tutor_page->view_all_folder($_SESSION['email']);
    }
    else if(!isset($_GET['action'])){
        switch($_SESSION['type']){
            case 1:
                $folder_id = $_GET['id'];
                $student_info = $student_page->getStudentInfo($_SESSION['email']);
                $_SESSION['std_tutor_id'] = $student_info['std_tutor_id'];
                $student_page->view_folder($folder_id);
            break;
            case 2:
                $folder_id = $_GET['id'];
                $tutor_info = $tutor_page->getTutorInfo($_SESSION['email']);
                $_SESSION['std_tutor_id'] = $tutor_info['std_tutor_id'];
                $tutor_page->view_folder($folder_id);
            break;
            default:
                $func->alert("Only student and tutor can access this function");
                $func->redir("index.php");
        };
    }
    else if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'upload':
                if(isset($_POST['upload'])){
                    print_r($_POST);
                }
                if($file['error'] == 0){
                    $folder_id = $_GET['folder_id'];
                    $uploader = $_SESSION['email'];
                    if($_SESSION['type'] == 1){
                        $file = $_GET['fileUpload'];
                        $student_page->upload($uploader, $file, $folder_id);
                    }
                    else if($_SESSION['type'] == 2){
                        $file = $_POST['fileUpload'];
                        $tutor_page->uploadFile($uploader, $file, $folder_id);
                    }
                }
                else{
                    $func->alert("Error. Error code: ".$file['error']);
                }
            break;
            case 'create_folder':
                if($_SESSION['type'] == 1){
                    $student_page->view_create_folder();
                    if(isset($_POST['submit'])){
                        $name = $_POST['folder_name'];
                        $student_info = $student_page->getStudentInfo($_SESSION['email']);
                        $std_tutor_id = $student_info['std_tutor_id'];
                        $student_page->create_folder($name,$std_tutor_id);
                        $func->alert("Create folder ".$name." success");
                        $func->redir("view_folder.php?stu_id=".$std_tutor_id);
                    }
                }
                else if($_SESSION['type'] == 2){
                    if(isset($_POST['submit'])){
                        $name = $_POST['folder_name'];
                        $email = $_SESSION['email'];
                        $tutor_info = $tutor_page->getTutorInfo($_SESSION['email']);
                        if(isset($_POST['std_tutor_id'])){
                            $std_tutor_id = $_POST['std_tutor_id'];
                        }
                        else{
                            $std_tutor_id = $tutor_info['std_tutor_id'];
                        }
                        
                        $tutor_page->create_folder($email,$name,$std_tutor_id);
                        $func->alert("Create folder ".$name." success");
                        $func->redir("view_folder.php");
                    }
                    $tutor_page->view_create_folder();

                    
                }
                
            break;
            case 'view_file':
                if($_SESSION['type'] == 2){
                    $file_id = $_GET['file_id'];
                $tutor_page->view_file_detail($file_id);
                }
                else if($_SESSION['type'] == 1) {
                    $file_id = $_GET['file_id'];
                $student_page->view_file_detail($file_id);
                }
                
            break;
            case 'view_file_arange':
                if($_SESSION['type'] == 2){
                    $file_id = $_GET['file_id'];
                $tutor_page->view_file_detail_arrange($file_id);
                }
                else if($_SESSION['type'] == 1) {
                    $file_id = $_GET['file_id'];
                $student_page->view_file_detail_arrange($file_id);
                }
                
            break;
        }
    }
}
?>

