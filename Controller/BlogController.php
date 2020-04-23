<?php
include_once("../Model/Blog.php");
include("Layout.php");
if(!isset($_SESSION)){
    session_start();
}

class BlogController extends LayoutController{

    public function viewAllBlog(){
        $vieB = new Blog();
        $data = $vieB->view_all_blog($_SESSION['id']);
        $this->loadView('Personal-Blog-Student', $data);
    }
    
    public function viewBlogDetail($id){
        $vieB = new Blog();
        $detail = $vieB->view_blog_detail($id);
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

    public function updateBlog($id, $title, $abstraction, $content, $url, $create_time){
        $updB = new Blog();
        $result = $updB->update_blog($id, $title, $abstraction, $content, $url, $create_time);
        if($result){
            echo 'Update Successful!';
        } else{
            echo 'Update Fail!';
        }
    }

    public function deleteBlog($id){
        $delBlog = new Blog();
        $result = $delBlog->delete_blog($id);
        if($result){
            echo 'Delete Successful!';
        }
    }
}

?>