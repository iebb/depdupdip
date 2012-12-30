<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
	require_once("./db_info.inc.php");
$user=$_SESSION['user_id'];
?>
<?php echo file_get_contents('http://127.0.0.1/getavatar.php?user='.$user); ?>
