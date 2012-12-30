<?php	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	
	if (!isset($_SESSION['user_id'])){
		$view_errors= "<a href=./loginpage.php>Please LogIn First!</a>";
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}

$sql="SELECT `poj_uid`,`poj_pwd`,`i1_uid`,`i1_pwd`,`bz_uid`,`bz_pwd`,`template` FROM `users` WHERE `user_id`='".$_SESSION['user_id']."'";
$result=mysql_query($sql);
$rowsx=mysql_fetch_array($result);
$uid=$rowsx[0];
$pwd=$rowsx[1];
$uid2=$rowsx[2];
$pwd2=$rowsx[3];
$uid1=$rowsx[4];
$pwd1=$rowsx[5];
$sl=$rowsx[6];
unset($_SESSION['tmpl']);
$sql="SELECT `ppp`,`customhtml` FROM `preferences` WHERE `user_id`='".$_SESSION['user_id']."'";
$result=mysql_query($sql);
$rowsx=mysql_fetch_array($result);

$dv=$rowsx[0];
$html=$rowsx[1];
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/prefpage.php");
/////////////////////////Common foot
mysql_free_result($result);
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

