<?php
require_once("./#config.php");

class Index{
    public function getAllBlog(){
    $db = Database::getInstance()->connect;
    $query = "select * from blog WHERE";
    foreach($db->query($query,PDO::FETCH_ASSOC) as $item){
      $blog_list[] = $item;
    }
    return $blog_list;
    }
    public function view_blog_detail($id){
    //DB -> Database
    $db = Database::getInstance()->connect;
    $req = "select * FROM blog WHERE id = ?";
    $stmt = $db->prepare($req);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>