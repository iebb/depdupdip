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

<?php echo '<div class="alert alert-info"> '.$nick."  [".$_GET['user'].']   '."<a href='new?to_user=$user'>发送邮件</a>".' </div>'?>

<?php echo '<div class="alert alert-success">'.$html.'</div>' ?>

<div class="alert alert-info">
<h4>Statistics</h4><p />
<table class="table table-striped table-bordered" style="font-size:11;" id="statics"><tr>
<td>
Prev Place
</td>
<td>
<?php echo ' <a class="nounderline" href="userinfo?user='.$PRD.'"><span class="label label-info">PREV</span><span class="label label-warning">'.$PRD.'</span><span class="label label-success">▲'.$RUK. "AC</span></a>"; ?>
</td></tr><tr>
<td>
Rank
</td>
<td><span class="label label-info">
<?php if ($Ranki==$Rank )echo $Rank; else echo $Rank.'-'.$Ranki; ?></span>
</td></tr><tr>
<td>
Next Place
</td>
<td>
<?php echo ' <a class="nounderline" href="userinfo?user='.$RUD.'"><span class="label label-info">NEXT</span><span class="label label-warning">'.$RUD.'</span><span class="label label-success">▼'.$PRK. "AC</span></a>"; ?>
</td></tr>
<tr>
<td>
<?php echo $MSG_SOVLED?></td><td align=center><a href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></a></td>
</tr>
<tr><td><?php echo $MSG_SUBMIT?></td><td align=center><a href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></td></tr>
<?php 
$stat=array(4=>"Accepted",5=>"Pres. Error",0=>"Pending",6=>"Wrong Answer",2=>"Compiling",1=>"Pending ReJudge",3=>"ReJudging",7=>"Time Limit Exceeded",11=>"Compile Error",9=>"Output Limit Exceeded",8=>"Memory Limit Exceeded",10=>"Runtime Error");
$style=array(4=>"success",5=>"important",0=>"info",6=>"important",2=>"info",1=>"info",3=>"info",7=>"warning",11=>"default",9=>"warning",8=>"warning",10=>"inverse");
	foreach($view_userstat as $row){
		
		//i++;
		echo '<tr><td><a class="nounderline"><span class="label label-'.$style[$row[0]].'">'.$stat[$row[0]].'</span></a></td><td align=center><a href=status?user_id='.$_GET['user'].'&jresult='.$row[0]." >".$row[1]."</a></td></tr>";
	}
	
	
//}
echo "<tr id=pie><td>Statistics</td><td><div id='PieDiv' style='position:relative;height:105px;width:120px;'></div></td></tr>";

?>


<tr><td>School:</td><td align=center><?php echo $school?></td></tr>
<tr><td>Email:</td><td align=center><?php echo $email?></td></tr>

</table>

</div>

<div class="alert alert-info"> 
<h4>Solved Problem</h4><p />
<?php $sql="SELECT DISTINCT `problem_id` FROM `solution` WHERE `user_id`='$user_mysql' AND `result`=4 ORDER BY `problem_id` ASC";	
if (!($result=mysql_query($sql))) echo mysql_error();
$c=0;
while ($row=mysql_fetch_array($result)){ $c++;
	echo '<a class="nounderline" href="/problem.php?id='.$row[0].' "><span class="label label-info">'.sprintf("P%04d",$row[0]).'</span></a>';
    if ($c%12==0) echo '<br /><br />';
	}
	mysql_free_result($result);
?>
</div>

<div class="alert alert-info">
  <h4>Chart</h4><p />
	  <script language="javascript">
		var y= new Array ();
		var x = new Array ();
		var dt=document.getElementById("statics");
		var data=dt.rows;
		var n;
		for(var i=5;dt.rows[i].id!="pie";i++){
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
		<div class="progress progress-striped active">
		<?php 
			$style=array(4=>"success",5=>"info",0=>"info",6=>"danger",2=>"info",1=>"info",3=>"info",7=>"warning",11=>"danger",9=>"warning",8=>"warning",10=>"danger");	
			foreach($view_userstat as $row){
				echo '<div class="bar bar-'.$style[$row[0]].'" style="width: '.sprintf("%.02f",99.9*($row[1])/$Submit).'%;">'.$jresult[$row[0]].'</div>
				';
			}
			?>
		</div>
</div>
<div class="alert alert-info">
<div class="cell" id="submit">
            <div class="title">邻居</div>
            <div class="body">
            <table class="table table-striped table-bordered" style="font-size:11;" id="problemstatus">
                <thead>
                    <tr>
                        <th style="width:20px; text-align:center; ">#</th>
                        <th onclick="sortTable('problemstatus', 1, 'int');">ID</th>
                        <th style="white-space:nowrap; ">通过数</th>
						<th style="white-space:nowrap;cursor:hand">提交数</th>
                    </tr>
                </thead>
                <tbody>
                    
                   <?php 
						foreach($view_nb as $row){
							
							echo "<tr>";
						
							
							foreach($row as $table_cell){
								echo "<td>\n";
								echo $table_cell;
								echo "</td>\n";
							}
							echo "</tr>";
							
						}
						
					?>

				</tbody>
				</table>
            </div>
        </div>
		
</div>
</div>
</center>
<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
