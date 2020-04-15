<?php
include('../#config.php');
class Blog
{
  public $user;
  public $id;
  public $title;
  public $abstraction;
  public $content;
  public $url;
  public $create_time;

  function __construct($user, $id, $title, $abstraction, $content, $url, $create_time)
  {
    $this->user = $user;
    $this->id = $id;
    $this->title = $title;
    $this->abstraction = $abstraction;
    $this->content = $content;
    $this->url = $url;
    $this->create_time = $create_time;
  }

  public function view_all_blog($user)
  {
    //DB -> Database
    $db = Database::getInstance();
    $req = $db->query("SELECT * FROM blog WHERE user = ?");
    $stmt = $db->prepare($req);
    $stmt->bindParam(1,$user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
  }

  public function view_blog_detail($user, $id)
  {
    //DB -> Database
    $db = Database::getInstance();
    $req = $db->query("SELECT * FROM blog WHERE user = ? and id = ?");
    $stmt = $db->prepare($req);
    $stmt->bindParam(1,$user);
    $stmt->bindParam(2,$id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
  }

  public function create_blog($user, $title, $abstraction, $content, $url, $create_time)
  {
    $db = Database::getInstance();
      $query = $db->query("INSERT into blog(user, title, abstraction, content, url, create_time) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt = $db->prepare($query);
      $stmt->bindParam(1,$user);
      $stmt->bindParam(2,$title);
      $stmt->bindParam(3,$abstraction);
      $stmt->bindParam(4,$content);
      $stmt->bindParam(5,$url);
      $stmt->bindParam(6,$create_time);
      $stmt->execute();
      return $stmt->execute();
  }

  public function update_blog($user, $id, $title, $abstraction, $content, $url, $create_time)
  {
    $db = Database::getInstance();
      $query = $db->query("UPDATE blog set title = ?, abstraction = ?, content = ?, url = ?, create_time = ? WHERE id = ? and user = ?" );
      $stmt = $db->prepare($query);
      $stmt->bindParam(1,$title);
      $stmt->bindParam(2,$abstraction);
      $stmt->bindParam(3,$content);
      $stmt->bindParam(4,$url);
      $stmt->bindParam(5,$create_time);
      $stmt->bindParam(6,$id);
      $stmt->bindParam(7,$user);
      $stmt->execute();
      return $stmt->execute();
  }

  public function delete_blog($user, $id)
  {
    $db = Database::getInstance();
      $query = $db->query("DELETE from blog WHERE id = ? and user = ?");
      $stmt = $db->prepare($query);
      $stmt->bindParam(1,$id);
      $stmt->bindParam(2,$user);
      $stmt->execute();
      return $stmt->execute();
  }
}