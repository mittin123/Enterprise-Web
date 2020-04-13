<?php
include("controller/layout.php");
class IndexController extends LayoutController{
    public function index(){
        $this->loadView("index");
    }
} 
?>