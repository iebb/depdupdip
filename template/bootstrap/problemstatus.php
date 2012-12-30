<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<script type="text/javascript" src="include/wz_jsgraphics.js"></script>
<script type="text/javascript" src="include/pie.js"></script>
<script src="include/sortTable.js"></script>
 
<div id="wrapper">
	<?php require_once("oj-header.php");?>
<div id=main>
<center><h1>Problem <?php echo $id ?> Status</h1></center>
	<center>
	
	
	<div class="row-fluid">	
	<div class="span4">
	<div class="cell" id="submit">
            <div class="title">Stats</div>
            <div class="body">
            <table class="table table-striped table-bordered" style="font-size:11;" id="statics">
                <tbody>
                    
                  <?php 
					$cnt=0;
					foreach($view_problem as $row){
						if ($cnt) 
							echo "<tr class='oddrow'>";
						else
							echo "<tr class='evenrow'>";
						foreach($row as $table_cell){
							echo "<td>";
							echo "\t".$table_cell;
							echo "</td>";
						}
						
						echo "</tr>";
						
						$cnt=1-$cnt;
					}
					?>
				<tr id=pie bgcolor=white><td colspan=2><div id='PieDiv' style='position:relative;height:150px;width:200px;'></div></tr>
				
				</tbody>
				</table>
            </div>
        </div>
	</div>
	<div class="span8">
	<div class="cell" id="submit">
            <div class="title">Accept List</div>
            <div class="body">
            <table class="table table-striped table-bordered" style="font-size:11;" id="problemstatus">
                <thead>
                    <tr>
                        <th style="width:20px; text-align:center; " onclick="sortTable('problemstatus', 0, 'int');">#</th>
                        <th onclick="sortTable('problemstatus', 1, 'int');">SID</th>
                        <th>用户</th>
                        <th style="cursor:hand" onclick="sortTable('problemstatus', 3, 'int');">内存</th>
						<th style="cursor:hand" onclick="sortTable('problemstatus', 4, 'int');">时间</th>
                        <th style="white-space:nowrap; ">编程语言</th>
						<th style="white-space:nowrap;cursor:hand" onclick="sortTable('problemstatus', 6, 'int'); ">代码长度</th>
						<th style="white-space:nowrap;cursor:hand">提交时间</th>
                    </tr>
                </thead>
                <tbody>
                    
                   <?php 
						$cnt=0;
						foreach($view_solution as $row){
							if ($cnt) 
								echo "<tr class='oddrow'>";
							else
								echo "<tr class='evenrow'>";
							foreach($row as $table_cell){
								echo "<td>";
								echo "\t".$table_cell;
								echo "</td>";
							}
							
							echo "</tr>";
							
							$cnt=1-$cnt;
						}
						
					?>

				</tbody>
				</table>
            </div>
        </div>
		</div>
	</div>
	<?php
	echo "<a href='problemstatus.php?id=$id'>[TOP]</a>";
	echo "&nbsp;&nbsp;<a href='status.php?problem_id=$id'>[STATUS]</a>";
	if ($page>$pagemin){
		$page--;
		echo "&nbsp;&nbsp;<a href='problemstatus.php?id=$id&page=$page'>[PREV]</a>";
		$page++;
	}
	if ($page<$pagemax){
		$page++;
		echo "&nbsp;&nbsp;<a href='problemstatus.php?id=$id&page=$page'>[NEXT]</a>";
		$page--;
	}
	
	?>
	<script language="javascript">
	var y= new Array ();
	var x = new Array ();
	var dt=document.getElementById("statics");
	var data=dt.rows;
	var n;
	for(var i=3;dt.rows[i].id!="pie";i++){
			x.push(dt.rows[i].cells[0].innerHTML);
			n=dt.rows[i].cells[1];
			n=n.innerText || n.textContent;
			//alert(n);
			n=parseInt(n);
			y.push(n);
	}
	var mypie=  new Pie("PieDiv");
	mypie.drawPie(y,x);
	//mypie.clearPie();

</script>
	
<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
