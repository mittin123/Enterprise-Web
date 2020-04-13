<?php
//Config file for database and other else
class Database{
    private $host = 'localhost';
    private $db_name = 'eLearning';
    private $user = 'root';
    private $pw = '';
    public $connect;

    public function __construct(){
        $this->connect = null;
        try {
            $this->connect = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$user,$pw);
            $this->connect->exec("set names UTF8");
        } catch (PDOException $ex) {
            echo "Connect to database error. Message: ".$ex->getMessage();
        }
        return $this->connect; 
    }
}
?>    