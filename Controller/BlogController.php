<?php
include_once("./Model/Blog.php");
include_once("./Model/Home.php");
include_once("Layout.php");


class BlogController extends LayoutController{

    public function viewAllBlog(){
        $vieB = new Blog();
        $data = $vieB->view_all_blog($_SESSION['id']);
        $this->loadView("Personal-Blog-Student", $data);
    }
    
    public function viewBlogDetail($id){
        $vieB = new Blog();
        $data = $vieB->view_blog_detail($id);
        $this->loadView("Blog-Detail-Student", $data);
    }

    public function loadBlogDetail($id){
        $vieB = new Blog();
        $data = $vieB->view_blog_detail($id);
        $this->loadView("Edit-Blog", $data);
    }

    public function loadAdd(){
        $vieB = new Blog();
        $data = '';
        $this->loadView("Add-Blog", $data);
    }

    public function createBlog($user, $title, $abstraction, $content, $url, $create_time){
        $addB = new Blog();
        $result = $addB->create_blog($user, $title, $abstraction, $content, $url, $create_time);
        $data = $addB->view_all_blog($_SESSION['id']);
        $this->loadView("Personal-Blog-Student", $data);
    }


    public function updateBlog($id, $title, $abstraction, $content, $url, $create_time){
        $updB = new Blog();
        $result = $updB->update_blog($id, $title, $abstraction, $content, $url, $create_time);
        $data = $updB->view_all_blog($_SESSION['id']);
        $this->loadView("Personal-Blog-Student", $data);
    }

    public function deleteBlog($id){
        $delBlog = new Blog();
        $result = $delBlog->delete_blog($id);
        $data = $delBlog->view_all_blog($_SESSION['id']);
        $this->loadView("Personal-Blog-Student", $data);
    }

    public function getAllBlog(){
        $blog = new Home();
        $data = $blog->getAllBlog();
        $this->loadView("index_default",$data);
    }
}

?>