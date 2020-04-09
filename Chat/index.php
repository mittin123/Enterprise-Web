<?php
include_once '../#config.php';
$db = new Connect();
$result = $db->query('SELECT * from (Select name, message, time from messages order by time desc limit by 20) tmp order by time asc');
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
		<?php foreach ($result as $row) : ?>
			<div>
				<span class="author"><?= $row['name'] ?>:</span>
				<span class="messsage-text"><?= $row['message'] ?></span>
			</div>	
		<?php endforeach; ?>	
	</div>
	<div id="connecting">Connecting to web sockets server...</div>
	<input type="text" class="text-box" id="name-input" placeholder="Your Name">
	<input type="text" class="text-box" id="message-input" placeholder="Your Message" onkeyup="handleKeyUp(event)">
	<p>Press enter to send message</p>
</div>
<script type="text/javascript" src="index.js"></script>
</body>
</html>