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
switch($_SESSION['type']){
    case 1:
        $student_info = $student_page->getStudentInfo($_SESSION['email']);
        $student_page->view_folder($student_info['std_tutor_id']);
    break;
    case 2:
        $tutor_info = $tutor_page->getTutorInfo($_SESSION['email']);
        $tutor_page->view_folder($tutor_info['std_tutor_id']);
    break;
    default:
        $func->alert("Only student and tutor can access this function");
        $func->redir("index.php");
};
if(isset($_GET)){
    switch($_GET['action']){
        case 'upload':
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
            $file = $_FILES['upload'];
            if($file['error'] == 0){
                $folder_id = $_POST['folder_id'];
                $uploader = $_SESSION['email'];
                if($_SESSION['type'] == 1){
                    $student_page->upload($uploader, $file, $folder_id);
                }
                else if($_SESSION['type'] == 2){
                    $tutor_page->upload($uploader, $file, $folder_id);
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
                    $func->redir("view_folder.php");
                }
            }
            else if($_SESSION['type'] == 2){
                $tutor_page->view_create_folder();
                if(isset($_POST['submit'])){
                    $name = $_POST['folder_name'];
                    $tutor_info = $tutor_page->getTutorInfo($_SESSION['email']);
                    $std_tutor_id = $tutor_info['std_tutor_id'];
                    $tutor_page->create_folder($name,$std_tutor_id);
                    $func->alert("Create folder ".$name." success");
                    $func->redir("view_folder.php");
                }
            }
            
        break;
    }
}
?>

