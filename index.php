<?php
//Index file
include("Controller/IndexController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$home = new IndexController();
if(!isset($_SESSION['email'])){
    $home->index(0);
}
else{
    $home->index($_SESSION['type']);
}

?>

