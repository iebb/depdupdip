<?php 
if (!isset($_SESSION['user_id'])){
	$view_errors= "<a href=./loginpage.php>Please LogIn First!</a>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}
require_once('./include/db_info.inc.php');
$sql="select distinct source,problem_id from source_code right join 
		(select solution_id,problem_id from solution where user_id='".$_SESSION['user_id']."' and result=4) S 
		on source_code.solution_id=S.solution_id order by problem_id";

$result=mysql_query($sql);
while($row=mysql_fetch_object($result)){
	echo "Problem".$row->problem_id.":";
	echo "$row->source;
	echo "------------------------------------------------------";
}
mysql_free_result($result);
?>
