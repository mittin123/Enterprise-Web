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
    else if(isset($_GET['update_id'])){
        $id = $_GET['update_id'];
        $page->loadBlogDetail($id);
    }
    else if(isset($_GET['add_id'])){
        $page->loadAdd();
    }
    else if(isset($_POST['editSubmit'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $abstraction = $_POST['gDes'];
        $content = $_POST['content'];
        $t_url = preg_replace('~[^\pL\d]+~u', '-', strtolower($_POST['title']));
        $url = 'https://eLearning.com/Blog/' . $t_url;
        $create_time = time();
        $page->updateBlog($id, $title, $abstraction, $content, $url, $create_time);
    }
    else if(isset($_POST['add'])){
        $user = $_SESSION['id'];
        $title = $_POST['title'];
        $abstraction = $_POST['gDes'];
        $content = $_POST['description'];
        $t_url = preg_replace('~[^\pL\d]+~u', '-', strtolower($_POST['title']));
        $url = 'https://eLearning.com/Blog/' . $t_url;
        $create_time = time();
        $page->createBlog($user, $title, $abstraction, $content, $url, $create_time);
    }
    else if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $blog = new BlogController();
        $result = $blog->deleteBlog($id);
    }
    else{
        $page->viewAllBlog();
    } 
    
}
else{
    die("You have no access - your level: ".$_SESSION['type']);
}

?>

