<?php
//Index file
include("Controller/IndexController.php");
include("function.php");
if(!isset($_SESSION)){
    session_start();
}
$home = new IndexController();
$home->index();
?>

