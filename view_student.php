<?php
//view unallocate student for staff
include("Controller/Staff/StaffController.php");
include("Controller/Tutor/TutorController");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new StaffController();
$tutor = new TutorController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if ($_SESSION['type'] == 2){
    $tutor->getStudentList();
}
else if ($_SESSION['type'] == 3){
    $page->getStudentList();
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

