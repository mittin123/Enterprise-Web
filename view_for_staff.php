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
    if(isset($_GET['auth_id'])){
        if($_GET['auth_id'] == 1){
            $page->getAllStudent();
        }
        else if($_GET['auth_id'] == 2){
            $page->getAllTutor();
        }
        else if($_GET['auth_id'] == 3){
            $page->getAllStaff();
        }
    }
    else if(isset($_GET['stu_email'])){
        $page->loadStudentDash($_GET['stu_email']);
    }
    else if(isset($_GET['tu_email'])){
        $page->loadTutorDash($_GET['tu_email']);
    }
    else if(isset($_GET['sta_email'])){
        $page->loadStaffDash();
    }
    else if(isset($_GET['exception_report'])){
        $page->loadExceptionReportPage();
    }
    else if(isset($_GET['statistic_report'])){
        $page->loadStatisticReportPage();
    }
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

