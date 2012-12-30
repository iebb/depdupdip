<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv='refresh' content='30'>
	<title><?php echo $view_title?></title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
	<?php require_once("oj-header.php");?>
<div id=main>
<script type="text/javascript">
function ajax(sid){
	window.frames['ifr'].location='ajax_info.php?sid='+sid;
}
</script>



<div id=choo>
<?php 
?>
<form id=simform action="status.php" method="get">
<div class="control-group success">
  <div class="controls">
    <span class="help-inline">PID</span>
    <input type="text" name=problem_id id="inputSuccess" value='<?php echo $problem_id?>'>
	<input type="text" name=user_id id="inputSuccess2" value='<?php echo $user_id?>'>
    <span class="help-inline">UID</span>
  </div>
</div>
<?php if (isset($cid)) echo "<input type='hidden' name='cid' value='$cid'>";?>
<select size="1" name="language" style="display:none;">
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
<select size="1" name="jresult" style="display:none;">
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
<script type="text/javascript">
function lan(p)
{
document.all.jresult.value = p;
}
function lan2(p)
{
document.all.language.value = p;
}
</script>
<div>
<div class="btn-group" data-toggle="buttons-radio">
<button type="button" class="btn btn-primary" onclick="lan2(-1)">All</button>
<button type="button" class="btn btn-info" onclick="lan2(1)">C++</button>
<button type="button" class="btn btn-warning" onclick="lan2(2)">Pascal</button>
<button type="button" class="btn btn-info" onclick="lan2(0)">C</button>
</div>
<p />
<div class="btn-group" data-toggle="buttons-radio">
<button type="button" class="btn btn-primary" onclick="lan(-1)">All</button>
<button type="button" class="btn btn-success" onclick="lan(4)">AC</button>
<button type="button" class="btn btn-danger" onclick="lan(6)">WA</button>
<button type="button" class="btn btn-inverse" onclick="lan(10)">RE</button>
<button type="button" class="btn btn-inverse" onclick="lan(11)">CE</button>
<button type="button" class="btn btn-warning" onclick="lan(7)">TLE</button>
<button type="button" class="btn btn-warning" onclick="lan(8)">MLE</button>
<button type="button" class="btn btn-warning" onclick="lan(9)">OLE</button>
<button type="button" class="btn btn-danger" onclick="lan(0)">PD</button>
<button type="submit" class="btn" value="Search">SEARCH</button>   
</div>
</div>
</form>
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

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
  <div class="modal-body" id="ajax_init">
    <iframe name="ifr"  width=100%  height=100% frameBorder="0"/>
  </div>
</div>
</body>
</html>
