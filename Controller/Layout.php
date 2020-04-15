<?php
class LayoutController{
    public function loadView($view, $data=array()){
        include('View/layout.php');
    }
}
?>