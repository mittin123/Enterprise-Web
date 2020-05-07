<?php

include("Controller/Student/StudentController.php");
include("Controller/Tutor/TutorController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new StudentController();
$tutor = new TutorController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if ($_SESSION['type'] == 1){
    if(isset($_GET['check'])){
        $page->checkAllocate();
    }
    else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $page->viewArrangeDetail($id);
    }
    else if(isset($_GET['add_id'])){
        $page->loadAddArrange();
    }
    else if(isset($_POST['arrangingStundent']) && $_POST['mtName'] != '' && $_POST['dateArrange'] != '' && $_POST['sNote'] != '') {
        $name = $_POST['mtName'];
        $arrange_date = strtotime($_POST['dateArrange']);
        $create_time = time();
        $note = $_POST['sNote'];
        $page->createArrange($name, $create_time, $arrange_date, $note);
    }
    else{
        $page->viewArrangeList();
    }


}
else if ($_SESSION['type'] == 2){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $tutor->viewArrangeDetail($id);
    }
    else if(isset($_GET['add_id'])){
        $tutor->loadAddArrange($_GET['add_id']);
    }
    else if(isset($_POST['arrangingTutor']) && $_POST['mtName'] != ''){
        $std_code = $_POST['id'];
        $title = $_POST['mtName'];
        $arrange_date = strtotime($_POST['dateArrange']);
        $create_date = time();
        $note = $_POST['tNote'];
        $tutor->createArrange($std_code, $title, $create_date, $arrange_date, $note);
    }
    else{
        $tutor->viewArrangeList();
    }
}

?>

