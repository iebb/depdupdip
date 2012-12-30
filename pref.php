<?php 
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	require_once("./include/check_post_key.php");
	require_once("./include/my_func.inc.php");


$err_str="";
$err_cnt=0;
$user_id=$_SESSION['user_id'];
$ppp=$_POST['ppp'];
$uid2=$_POST['uid2'];
$pwd2=$_POST['pwd2'];
$sl=$_POST['sl'];
$html=$_POST['html'];
$sql="UPDATE `preferences` SET"
."`ppp`='".((int)$ppp)."' ,"
."`customhtml`='".mysql_real_escape_string($html)."' "
."WHERE `user_id`='".mysql_real_escape_string($user_id)."'"
;
mysql_query($sql);
unset($_SESSION['tmpl']);
$sql="UPDATE `users` SET"
."`template`='".($sl)."' ,"
."`i1_uid`='".($uid2)."' ,"
."`i1_pwd`='".($pwd2)."' "
."WHERE `user_id`='".mysql_real_escape_string($user_id)."'"
;
mysql_query($sql);
header("Location: ./");
?>
