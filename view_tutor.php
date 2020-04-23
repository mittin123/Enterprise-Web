<?php
//Index file
include("Controller/Staff/StaffController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new StaffController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if ($_SESSION['type'] == 3){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $page->getTutorDetail($id);
    }
    else{
        $page->getTutorList();
    }
    
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

