<?php
include("#config.php");
include("Model/Blog.php");
include("Model/Layout.php");


class BlogController extends LayoutController{
    public function index(){
        $this->loadView('layout');
    }
    public function viewBlog($user){

    }
    
    public function createBlog($user, $title, $abstraction, $content, $url, $create_time){
        $addB = new BlogController();
        $result = $addB->createBlog($user, $title, $abstraction, $content, $url, $create_time)
        if($result){
            echo 'Add Successful!';
        } else{
            echo 'Add Fail!';
        }
    }

    public function updateBlog($user, $id, $title, $abstraction, $content, $url, $create_time){

    }

    public function deleteBlog($user, $id){

    }
}

?>