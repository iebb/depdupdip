<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
</head>

<body>
	
<script type="text/javascript" src="include/wz_jsgraphics.js"></script>
<script type="text/javascript" src="include/pie.js"></script>

<div id="wrapper">
	<?php require_once("oj-header.php");?>
<div id=main>

<center>

<caption>
<?php echo '<div class="alert alert-info"> '.$nick."  [".$user.']   '."<a href=new.php?to_user=$user>发送邮件</a>".' </div>'?>

</caption>
<div class="alert alert-success">
<table id=statics width=70%>
<tr>
<td width=15%>
<?php echo $MSG_Number?><td width=25% align=center><?php echo $Rank?><td width=70% align=center>Solved Problems List</tr>
<tr>
<td>
<?php echo $MSG_SOVLED?><td align=center><a href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></a>
<td rowspan=14 align=center>

<?php $sql="SELECT DISTINCT `problem_id` FROM `solution` WHERE `user_id`='$user_mysql' AND `result`=4 ORDER BY `problem_id` ASC";	
if (!($result=mysql_query($sql))) echo mysql_error();
$c=0;
while ($row=mysql_fetch_array($result)){ $c++;
	echo '<a class="nounderline" href="/problem.php?id='.$row[0].' "><span class="label label-info">'.sprintf("P%04d",$row[0]).'</span></a>';
    if ($c%8==0) echo '<br /><br />';
	}
	mysql_free_result($result);
?>

</tr>
<tr><td><?php echo $MSG_SUBMIT?><td align=center><a href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></tr>
<?php 
	foreach($view_userstat as $row){
		
		//i++;
		echo "<tr><td>".$jresult[$row[0]]."<td align=center><a href=status.php?user_id=$user&jresult=".$row[0]." >".$row[1]."</a></tr>";
	}
	
	
//}
echo "<tr id=pie><td>Statistics<td><div id='PieDiv' style='position:relative;height:105px;width:120px;'></div></tr>";

?>



<tr><td>School:<td align=center><?php echo $school?></tr>
<tr><td>Email:<td align=center><?php echo $email?></tr>
</table>

<div class="alert alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>Stat</h4>
  <script language="javascript">
	var y= new Array ();
	var x = new Array ();
	var dt=document.getElementById("statics");
	var data=dt.rows;
	var n;
	for(var i=3;dt.rows[i].id!="pie";i++){
			n=dt.rows[i].cells[0];
			n=n.innerText || n.textContent;
			x.push(n);
			n=dt.rows[i].cells[1].firstChild;
			n=n.innerText || n.textContent;
			//alert(n);
			n=parseInt(n);
			y.push(n);
	}
	var mypie=  new Pie("PieDiv");
	mypie.drawPie(y,x);
	//mypie.clearPie();

</script>
<div class="progress">
<?php 
    $style=array(4=>"success",5=>"PE",0=>"info",6=>"important",2=>"info",1=>"info",3=>"info",7=>"warning",11=>"default",9=>"warning",8=>"warning",10=>"inverse");	
	foreach($view_userstat as $row){
		echo '<div class="bar bar-'.$style[$row[0]].'" style="width: '.sprintf("%.02f",100*($row[1]+0.01)/$Submit).'%;"></div>
		';
	}
	?>
</div>
</div>
</div>
<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
