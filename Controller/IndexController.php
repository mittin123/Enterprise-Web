<?php
include("Controller/Layout.php");
class IndexController extends LayoutController{
    public function index(){
        $this->loadView("index");
    }
} 
?>