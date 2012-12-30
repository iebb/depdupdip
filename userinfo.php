<?php
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	require_once("./include/const.inc.php");
	require_once("./include/my_func.inc.php");
 // check user
$user=$_GET['user'];
if (!is_valid_user_name($user)){
	echo "No such User!";
	exit(0);
}
$view_title=$user ."@".$OJ_NAME;
$user_mysql=mysql_real_escape_string($user);
$sql="SELECT `school`,`email`,`nick` FROM `users` WHERE `user_id`='$user_mysql'";
$result=mysql_query($sql);
$row_cnt=mysql_num_rows($result);
if ($row_cnt==0){ 
	$view_errors= "No such User!";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

$row=mysql_fetch_object($result);
$school=$row->school;
$email=$row->email;
$nick=$row->nick;
mysql_free_result($result);
// count solved
$sql="SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `result`=4";
$result=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_object($result);
$AC=$row->ac;
mysql_free_result($result);
	if ($AC>10){
		$sql="select * FROM privilege where `user_id`='".$user_mysql."' and `rightstr`='dataview'";
		$result=mysql_query($sql) or die(mysql_error());
	if (!mysql_num_rows($result)){
		$user_id=$user_mysql;
		$rightstr ='dataview';
		$sql="insert into `privilege` values('$user_id','$rightstr','N')";
		mysql_query($sql);
	}
	mysql_free_result($result);
	
		$sql="select * FROM privilege where `user_id`='".$user_mysql."' and `rightstr`='source_browser'";
		$result=mysql_query($sql) or die(mysql_error());
	if (!mysql_num_rows($result)){
		$user_id=$user_mysql;
		$rightstr ='source_browser';
		$sql="insert into `privilege` values('$user_id','$rightstr','N')";
		mysql_query($sql);
	}
	mysql_free_result($result);
	}
// count submission
$sql="SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`='".$user_mysql."'";
$result=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_object($result);
$Submit=$row->Submit;
mysql_free_result($result);

// update solved 
$sql="UPDATE `users` SET `solved`='".strval($AC)."',`submit`='".strval($Submit)."' WHERE `user_id`='".$user_mysql."'";
$result=mysql_query($sql);
$sql="SELECT count(*) as `Rank` FROM `users` WHERE `solved`>$AC OR (`solved`=$AC AND `submit`<$Submit)";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$Rank=intval($row[0])+1;
mysql_free_result($result);

$sql="SELECT count(*) as `Rank` FROM `users` WHERE `solved`>$AC OR (`solved`=$AC AND `submit`<=$Submit)";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$Ranki=intval($row[0]);
mysql_free_result($result);

 if (isset($_SESSION['administrator'])){
$sql="SELECT * FROM `loginlog` WHERE `user_id`='$user_mysql' order by `time` desc LIMIT 0,10";
$result=mysql_query($sql) or die(mysql_error());
$view_userinfo=array();
$i=0;
for (;$row=mysql_fetch_row($result);){
	$view_userinfo[$i]=$row;
	$i++;
}
mysql_free_result($result);
}

$sql="SELECT result,count(1) FROM solution WHERE `user_id`='$user_mysql'  AND result>=4 group by result order by result";
	$result=mysql_query($sql);
	$view_userstat=array();
	while($row=mysql_fetch_array($result)){
		$view_userstat[$i++]=$row;
	}
	mysql_free_result($result);

		$rank = $Rank-4;
	
		if(isset($OJ_LANG)){
			require_once("./lang/$OJ_LANG.php");
		}
		$page_size=10;
		//$rank = intval ( $_GET ['start'] );
		if ($rank < 0)
			$rank = 0;
			
		$sql = "SELECT `user_id`,`nick`,`solved`,`color`,`submit` FROM `users` ORDER BY `solved` DESC,submit,reg_time  LIMIT  " . strval ( $rank ) . ",$page_size";
		
		if($scope){
			$s="";
			switch ($scope){
				case 'd': 
					$s=date('Y').'-'.date('m').'-'.date('d');
					break;
				case 'w': 
					$monday=mktime(0, 0, 0, date("m"),date("d")-(date("w")+7)%8+1, date("Y"));
					//$monday->subDays(date('w'));
					$s=strftime("%Y-%m-%d",$monday);
					break;
				case 'm': 
					$s=date('Y').'-'.date('m').'-01';
					;break;
				default : 
					$s=date('Y').'-01-01';
			}
			//echo $s."<-------------------------";
			$sql="SELECT users.`user_id`,`color`,s.`solved`,t.`submit` FROM `users` 
					right join 
					(select count(distinct problem_id) solved ,user_id from solution where in_date>'$s' and result=4 group by user_id order by solved desc limit " . strval ( $rank ) . ",$page_size) s on users.user_id=s.user_id
					left join 
					(select count( problem_id) submit ,user_id from solution where in_date>'$s' group by user_id order by submit desc limit " . strval ( $rank ) . ",".($page_size*2).") t on users.user_id=t.user_id
				ORDER BY s.`solved` DESC,t.submit,reg_time  LIMIT  0,50
			 ";
			 //echo $sql;
		}
		
		$sql2="SELECT `solved` FROM `users` WHERE `user_id`='".$user."'";
		$result = mysql_query ( $sql2 ); 
		$row = mysql_fetch_object ( $result );
		$sv= $row->solved;
		mysql_free_result ( $result );
		
		$result = mysql_query ( $sql ); 
		$view_nb=Array();
		$i=0;
		while ( $row = mysql_fetch_object ( $result ) ) {
			$rank ++;
			if (($sv-($row->solved))>0) {$pos='success';$pos2='▼';} else if (($sv-($row->solved))==0) {$pos='info';$pos2='►';} else {$pos='warning';$pos2='▲';}
				$view_nb[$i][0]= $rank;
				if ($flag){
					$flag=false;
					$PRK=$SV-$row->solved;
					$RUD=$row->user_id;
				}
				$view_nb[$i][1]= file_get_contents("http://127.0.0.1/ranklistavatar.php?user=".$row->user_id."&rank=100")."<a href='userinfo.php?user=" . $row->user_id . "'> <span style='color:#" . $row->color . ";'> " . $row->user_id . "</span></a>";

			$view_nb[$i][2]=  "<div class=center><a href='status.php?user_id=" . $row->user_id . "&jresult=4'><span class='label label-default'>" . $row->solved . '</span><span class="label label-'.$pos.'">'.$pos2.abs($sv-($row->solved))."</span></a>" ."</div>";
			$view_nb[$i][3]=  "<div class=center><a href='status.php?user_id=" . $row->user_id . "'>" . $row->submit . "</a>" ."</div>";
			$i++;
			
			
			
			if ($user==$row->user_id){
				if (!isset($PX)) $PX=$row->user_id;
				if (!isset($SX)) $SX=$row->solved;
				$RK=$rank;
				$SV=$row->solved;
				$RUK=-($SX-$row->solved);
				$PRD=$PX;
				$flag=true;
			}
			$PX=$row->user_id;
			$SX=$row->solved;
		}
		if ($flag){
					$flag=false;
					$PRK=$SV;
					$RUD=$row->user_id;
				}
		mysql_free_result ( $result );
		
		$sql2="SELECT `customhtml` FROM `preferences` WHERE `user_id`='".$user."'";
		$result = mysql_query ( $sql2 ); 
		$row = mysql_fetch_object ( $result );
		$html= $row->customhtml;
		mysql_free_result ( $result );
		
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/userinfo.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

