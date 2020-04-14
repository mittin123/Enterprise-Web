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
  public $status;

  function __construct($user, $id, $title, $abstraction, $content, $url, $create_time, $status)
  {
    $this->user = $user;
    $this->id = $id;
    $this->title = $title;
    $this->abstraction = $abstraction;
    $this->content = $content;
    $this->url = $url;
    $this->create_time = $create_time;
  }

  static function view_blog()
  {
    $list = [];
    //DB -> Database
    $db = Database::getInstance();
    $req = $db->query("SELECT * FROM blog");

    foreach ($req->fetchAll() as $item) {
      $list[] = new Post($item['user'], $item['id'], $item['title'], $item['abstraction'], $item['content'], $item['url'], $item['create_time'], $item['status']);
    }

    return $list;
  }

  static function create_blog()
  {

  }

  static function update_blog()
  {

  }

  static function delete_blog()
  {

  }
}