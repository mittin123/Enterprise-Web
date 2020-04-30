<?php
// view blog list for staff
include("Controller/StudentController.php");
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

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $page->viewArrangeDetail($id);
        }
        else if(isset($_GET['add_id'])){
            $page->addArrange();
        }
        else if(isset($_POST['add'])){
            $user = $_SESSION['id'];
            $title = $_POST['title'];
            $arrange_date = strtotime($_POST['title']);
            $create_time = time();
            $page->createBlog($user, $title, $arrange_date, $create_time);
        }
        else{
            $page->viewArrangeList();
        }
    
    
}
else if ($_SESSION['type'] == 2){
    
}

?>

