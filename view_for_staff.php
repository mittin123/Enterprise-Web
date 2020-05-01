<?php

include("Controller/AuthStaff/AuthStaffController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new AuthStaffController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if ($_SESSION['type'] == 4){
    if($_GET['auth_id'] == 1){
        $page->getAllStudent();
    }
    else if($_GET['auth_id'] == 2){
        $page->getAllTutor();
    }
    else{
        $page->getAllStaff();
    }
    
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

