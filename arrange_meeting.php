<?php

include("Controller/Student/StudentController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new StudentController();
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
        else if(isset($_POST['arrangingStundent'])){
            $name = $_POST['mtName'];
            $arrange_date = strtotime($_POST['dateArrange']);
            $create_time = time();
            $note = $_POST['sNote'];
            $page->createArrange($name, $create_date, $arrange_date, $note);
        }
        else{
            $page->viewArrangeList();
        }
    
    
}
else if ($_SESSION['type'] == 2){
    
}

?>

