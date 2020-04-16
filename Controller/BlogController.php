<?php
include("../#config.php");
include("../Model/Blog.php");
include("Layout.php");
//include("../login.php");

class BlogController extends LayoutController{
    public function index(){
        $this->loadView('layout');
    }
    public function viewAllBlog(){
        $vieB = new Blog();
        $list = $vieB->view_all_blog($_SESSION['id']);
        return $list;
    }
    
    public function viewBlogDetail($id){
        $vieB = new Blog();
        $detail = $vieB->view_blog_detail($_SESSION['id'], $id);
        return $detail;
    }

    public function createBlog($user, $title, $abstraction, $content, $url, $create_time){
        $addB = new Blog();
        $result = $addB->create_blog($user, $title, $abstraction, $content, $url, $create_time);
        if($result){
            echo 'Add Successful!';
        } else{
            echo 'Add Fail!';
        }
    }

    public function updateBlog($user, $id, $title, $abstraction, $content, $url, $create_time){
        $updB = new Blog();
        $result = $updB->update_blog($user, $id, $title, $abstraction, $content, $url, $create_time);
        if($result){
            echo 'Update Successful!';
        } else{
            echo 'Update Fail!';
        }
    }

    public function deleteBlog($user, $id){

    }
}

?>