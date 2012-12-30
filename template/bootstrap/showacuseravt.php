<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
require_once("./include/const.inc.php");

$id=strval(intval($_GET['id']));
if (isset($_GET['page']))
	$page=strval(intval($_GET['page']));
else $page=0;

?>

<?php 
$view_problem=array();


//for ($i=4;$i<12;$i++){
	$i=3;
	$sql="SELECT result,count(1) FROM solution WHERE problem_id='$id' AND result>=4 group by result order by result";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		
		$view_problem[$i][0] =$jresult[$row[0]];
		$view_problem[$i][1] ="<a href=status.php?problem_id=$id&jresult=".$row[0]." >".$row[1]."</a>";
		$i++;
	}
	mysql_free_result($result);
	
//}

?>


<?php 
$sql=" select * from
(
SELECT solution_id ,user_id,language,10000000000000000000+time *100000000000 + memory *100000 + code_length  score, in_date
FROM solution 
WHERE problem_id =$id 
AND result =4

ORDER BY solution_id
)b
right join
(

SELECT count(*) att ,user_id, min(10000000000000000000+time *100000000000 + memory *100000 + code_length ) score
FROM solution
WHERE problem_id =$id
AND result =4
GROUP BY user_id
ORDER BY solution_id

)c
on b.score=c.score and b.user_id=c.user_id 
order by solution_id
LIMIT 0,3";

$result=mysql_query($sql);
$view_solution="";
$j=0;
for ($i=$start+1;$row=mysql_fetch_object($result);$i++){
	$view_solution.=  "<a href='userinfo.php?user=".$row->user_id."'>".file_get_contents("http://127.0.0.1/getsmallavatar.php?user=".$row->user_id)."</a>";
}

mysql_free_result($result);

/////////////////////////Template
echo $view_solution;
?>

