<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
	<?php require_once("oj-header.php");?>
<div id=main>
<ul class="breadcrumb">
    
    
    <li>
        <a href="/">首页</a>
        <span class="divider">/</span>
    </li>
    
    
    
    <li class="active">
        题目
    </li>
    
    
</ul>

<script src="include/sortTable.js"></script>

			
			
	<table  class="table table-striped table-bordered" id='problemset' width='90%'>
		<thead>
			
			
			<tr align=center class='toprow'>
				<td width='8'>STAT</td>
				<td style="cursor:hand" onclick="sortTable('problemset', 1, 'int');" width=10%><A><?php echo $MSG_PROBLEM_ID?></A>
				<td width='60%'><?php echo $MSG_TITLE?></td>
				<td width='10%'><?php echo $MSG_SOURCE?></td>
				<td style="cursor:hand" onclick="sortTable('problemset', 4, 'int');" width='5%'><A><?php echo $MSG_AC?></A></td>
				<td style="cursor:hand" onclick="sortTable('problemset', 5, 'int');" width='5%'><A><?php echo $MSG_SUBMIT?></A></td>
			</tr>
			</thead>
			<tbody>
			<?php 
			$cnt=0;
			foreach($view_problemset as $row){
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
			</table></center>


<div class="pagination"> 
<ul>
        <?php
        {echo  "<li class='disabled'>";
        echo  " <a href='?page=1'> &lt; - </a></li>" ;}
        for ($i=max(1,$page-3);$i<=min($page+3,$view_total_page);$i++){
		if ($i==$page) echo " <li class='active'><a href='?page="  .$i.  " '>"  .$i.  "</a></li>";
		else echo " <li><a href='?page="  .$i.  " '>"  .$i.  "</a></li>";  }
        {
        echo  "<li class='disabled'>";
        echo  " <a href='?page=";
        echo  (int)$view_total_page;
        echo  " '>  - &gt;</a></li>" ;}

        ?>

</ul>
</div>

<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
