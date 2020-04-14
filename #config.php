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

    private function login($email, $password){
        $db = Database::getInstance();
        $query = $db->query("Select * from Account where Email = ? and Password = ?");
        $stmt = $db->prepare($query);
        $stmt->bindParam(1,$email);
        $stmt->bindParam(2,$password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>    