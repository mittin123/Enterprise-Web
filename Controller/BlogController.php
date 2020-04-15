<?php
include("#config.php");
include("Model/Blog.php");
include("Model/Layout.php");
class BlogController extends LayoutController{
    public function index(){
        $this->loadView('layout');
    }

}
if(!isset($_SESSION)){
    session_start();

}
?>