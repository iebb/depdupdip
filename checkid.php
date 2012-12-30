<?php

$user_id = $_GET['name']; 
require_once("./include/db_info.inc.php");
$sql="SELECT `user_id` FROM `users` WHERE `user_id`='".mysql_real_escape_string($user_id)."'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);

echo $count;

exit(); 

?>