<?php
include_once('../#config.php');
if(!isset($_SESSION)){
    session_start();
}
//fake sender id; session 'id' = sender id
$sender_id = $_SESSION['user_id'];
$name = trim(htmlspecialchars($_POST['name']));
$message = trim(htmlspecialchars($_POST['message']));
$receiver_id = trim(htmlspecialchars($_POST['receiver_id']));
if(!$name || !$message){
    die;
}

$db = Database::getInstance()->connect;
try{
    $stmt = $db->prepare("INSERT INTO message (name, message, time) values (?, ?, ?)");
    $time = time();
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $message);
    $stmt->bindParam(3, $time);
    $stmt->execute();
}
catch(Exception $ex){
    die($ex->getMessage());
}


$ch = curl_init('http://localhost:8888');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:8888");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36');

$json_data = json_encode([
    'name' => $name,
    'message' => $message,
    'sender_id' => $sender_id,
    'receiver_id' => $receiver_id
]);

$query = http_build_query(['data' => $json_data]);

curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
echo(print_r($info));
echo(curl_error($ch));
curl_close($ch);
?>