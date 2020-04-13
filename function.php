<?php
class func
{
	public function alert($text) 
	{
		echo '<script type="text/javascript">alert("'.$text.'");</script>';
	}
	public function redir($link) 
	{
		echo '<script type="text/javascript">window.location="'.$link.'";</script>';
	}
}
?>