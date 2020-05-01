<?php
include_once('../function.php');
include_once('../#config.php');
$func = new Func();
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['email'])){
	$func->redir("login.php");
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
else{
	$id = 0;
}
$db = Database::getInstance()->connect;
$stmt = $db->prepare("SELECT * from (Select name, message, time from message order by time desc limit 20 where stu_tu_id = ?) tmp order by time asc");
$stmt->bindParam(1, $id);
$stmt->execute();
$result = $stmt->fetchAll();
if(!isset($_SESSION)){
	session_start();
}
$sender_id = $_SESSION['user_id'];
//fake sender id;
include_once('../#config.php');
$db = Database::getInstance()->connect;
$result = $db->query("select * from (Select name, message, time from message order by time desc limit 20) tmp order by time asc");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat App by Hyvor Developer?</title>

<style type="text/css">
	* {
		box-sizing:border-box;
	}
	#content {
		width:600px;
		max-width:100%;
		margin:30px auto;
		background-color:#fafafa;
		padding:20px;
	}
	#message-box {
		min-height:400px;
		overflow:auto;
	}
	.author {
		margin-right:5px;
		font-weight:600;
	}
	.text-box {
		width:100%;
		border:1px solid #eee;
		padding:10px;
		margin-bottom:10px;
	}
</style>

</head>
<body>
<div id="content">
	<div id="message-box">
		<?php foreach ($result as $row) { ?>
			<div>
				<span class="author"><?= $row['name'] ?>:</span>
				<span class="messsage"><?= $row['message'] ?></span>
			</div>	
		<?php } ?>	
	</div>
	<div id="connecting">Connecting to web sockets server...</div>
	<input type="text" class="text-box" id="sender" placeholder="Your Name">
	<input type="text" class="text-box" id="message" placeholder="Your Message" onkeyup="handleKeyUp(event)">
	<p>Press enter to send message</p>
</div>
<script type="text/javascript">
	var receiver_id = <?php echo $_GET['id'];?>;
	var sender_id = <?php echo $sender_id;?>;
</script>
<script type="text/javascript" src="index.js"></script>
</body>
</html>