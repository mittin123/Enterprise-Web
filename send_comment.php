<?php
include("#config.php");
$from = $_POST['from'];
$comment = $_POST['comment'];
$file_id = $_POST['file_id'];
$time = time();
$db = Database::getInstance()->connect;
$query = "Insert into comment (email, comment, file_id, create_time) values (?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $from);
$stmt->bindParam(2, $comment);
$stmt->bindParam(3, $file_id);
$stmt->bindParam(4, $time);
$stmt->execute();
$response =
"
<div>
    <div class=\"comment reply clearfix\">
        <div class=\"comment-details\">
        <span class=\"comment-name\">".$from."</span>
        <span class=\"comment-date\">".date('d/m/yy',$time)."</span>
            <p>".$comment."</p>
            <hr>
        </div>
    </div>
</div>
";
echo $response;
?>