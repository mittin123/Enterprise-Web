<?php
include("function.php");
session_start();
session_destroy();
$function = new Func();
$function->redir("index.php");
?>