<?php
// view blog list for staff
include("Controller/BlogController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$page = new BlogController();
$func = new Func();
if(!isset($_SESSION['email'])){
    $func->redir("login.php");
}
else if ($_SESSION['type'] == 3){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $page->viewBlogDetail($id);
    }
    else{
        $page->viewAllBlog();
    }
    
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

