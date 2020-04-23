<?php
include("Layout.php");
class IndexController extends LayoutController{
    public function index($type){
        switch($type){
            case 1:
                $this->loadView("index_student");
            break;
            case 2:
                $this->loadView("index_tutor");
            break;
            case 3:
                $this->loadView("index_staff");
            break;
            default:
                $this->loadView("index_default");
            break;
        }
    }
} 
?>