<?php
include_once '../#config.php';

$name = trim(htmlspecialchars($_POST['name'] ?? ''));
$message = trim(htmlspecialchars($_POST['message'] ?? ''));

if(!$name || !$message){
    die;
}
$db = new Connect();
$stmt = $db->prepare('INSERT INTO message (name, message, time) values (?, ?, ?)');
$time = time();
$stmt->bindParam(1, $name, PDO::PARAM_STR);
$stmt->bindParam(2, $message, PDO::PARAM_STR);
$stmt->bindParam(3, $time, PDO::PARAM_INT);
$stmt->execute();

$ch = curl_init('http://localhost:8888');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

$json_data = json_encode([
    'name' => $name,
    'message' => $message
]);

$query = http_build_query(['data' => $json_data]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($ch);
curl_close($ch);
?>