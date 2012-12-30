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

<script type="text/javascript">
function Ajax(){
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
	xmlHttp.onreadystatechange=function(){
		document.getElementById('center').innerHTML=xmlHttp.responseText;
		setTimeout('Ajax()',10000);
	}
	xmlHttp.open("GET","http://wetta.in/status_aj.php",true);
	xmlHttp.send(null); 
}
window.onload=function(){
	setTimeout('Ajax()',10000);
}
</script>

<div id=choo>
<?php 
?>
<form id=simform action="status.php" method="get">
PID:<input type=text size=4 name=problem_id value='<?php echo $problem_id?>'>
UID:<input type=text size=4 name=user_id value='<?php echo $user_id?>'>
<?php if (isset($cid)) echo "<input type='hidden' name='cid' value='$cid'>";?>
<?php echo $MSG_LANG?>:<select size="1" name="language">
<?php if (isset($_GET['language'])) $language=$_GET['language'];
else $language=-1;
if ($language<0||$language>9) $language=-1;
if ($language==-1) echo "<option value='-1' selected>All</option>";
else echo "<option value='-1'>All</option>";
for ($i=0;$i<10;$i++){
        if ($i==$language) echo "<option value=$i selected>$language_name[$i]</option>";
        else echo "<option value=$i>$language_name[$i]</option>";
}
?>
</select>
<?php echo $MSG_RESULT?>:<select size="1" name="jresult">
<?php if (isset($_GET['jresult'])) $jresult_get=intval($_GET['jresult']);
else $jresult_get=-1;
if ($jresult_get>=12||$jresult_get<0) $jresult_get=-1;
if ($jresult_get!=-1){
        $sql=$sql."AND `result`='".strval($jresult_get)."' ";
        $str2=$str2."&jresult=".strval($jresult_get);
}
if ($jresult_get==-1) echo "<option value='-1' selected>All</option>";
else echo "<option value='-1'>All</option>";
for ($j=0;$j<12;$j++){
        $i=($j+4)%12;
        if ($i==$jresult_get) echo "<option value='".strval($jresult_get)."' selected>".$jresult[$i]."</option>";
        else echo "<option value='".strval($i)."'>".$jresult[$i]."</option>"; 
}
echo "</select>";
?>
</select>


</div>



<div id="center">
<table class="table table-striped table-bordered" align=center width=80%>
<tr>
<td ><?php echo $MSG_RUNID?>
<td ><?php echo $MSG_USER?>
<td ><?php echo $MSG_PROBLEM?>
<td ><?php echo $MSG_RESULT?>
<td ><?php echo $MSG_MEMORY?>
<td ><?php echo $MSG_TIME?>
<td ><?php echo $MSG_LANG?>
<td ><?php echo $MSG_CODE_LENGTH?>
<td ><?php echo $MSG_SUBMIT_TIME?>
</tr>


<tbody>
			<?php 
			$cnt=0;
			foreach($view_status as $row){
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

<div class="pagination"> 
<ul>
        <?php
        {echo  "<li class='disabled'>";
        echo  " <a href=status.php?".$str2."&top=".$_GET['prevtop'].">&lt; - </a></li>" ;}
        echo  "<a href=status.php?".$str2."&top=".$bottom."&prevtop=$top> - &gt;</a>";
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
