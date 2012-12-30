<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<body>
<div id="wrapper">
	<?php
	if(isset($_GET['id']))
		require_once("oj-header.php");
	else
		require_once("contest-header.php");
	
	?>
<div class="span12">
	
	<?php
	
	if ($pr_flag){
		echo "<title>$MSG_PROBLEM $row->problem_id. -- $row->title</title>";
		echo "<center><h2>$id: $row->title</h2>";
	}else{
		$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		echo "<title>$MSG_PROBLEM $PID[$pid]: $row->title </title>";
		echo "<center><h2>$MSG_PROBLEM $PID[$pid]: $row->title</h2>";
	}
	echo "<span class=green>$MSG_Time_Limit: </span>$row->time_limit Sec&nbsp;&nbsp;";
	echo "<span class=green>$MSG_Memory_Limit: </span>".$row->memory_limit." MB";
	if ($row->spj) echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
	echo "<br><span class=green>$MSG_SUBMIT: </span>".$row->submit."&nbsp;&nbsp;";
	echo "<span class=green>$MSG_SOVLED: </span>".$row->accepted."<br>"; 
	
	if ($pr_flag){
		echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
	}else{
		echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
	}
	echo "[<a href='problemstatus.php?id=".$row->problem_id."'>$MSG_STATUS</a>]";
	echo "[<a href='bbs.php?pid=".$row->problem_id."$ucid'>$MSG_BBS</a>]";
	?>
	[<a href="#myModal" role="button" data-toggle="modal">QR&amp;Shrink</a>]
<div class="modal" id="myModal" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
    <h3 id="myModalLabel">Link: http://wa.vg/<?php echo $id; ?></h3>
  </div>
  <div class="modal-body">
    <img src="http://api.qrserver.com/v1/create-qr-code/?data=http%3A%2F%2Fwa.vg/<?php echo $id; ?>&size=150x150"> </img>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>

	<?php
	echo "</center>";
	
	echo "<h2>$MSG_Description</h2><div class='well'>".$row->description."</div>";
	echo "<h2>$MSG_Input</h2><div class='well'>".$row->input."</div>";
	echo "<h2>$MSG_Output</h2><div class='well'>".$row->output."</div>";
	echo "<h4><a href='view_testcase.php?pid=$id.'>Show Testcases</a></h4>";
	$ie6s="";
	$ie6e="";
	if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	{
		$ie6s="<pre>";
		$ie6e="</pre>";
	}
	
	echo "<h2>$MSG_Sample_Input</h2>
			<pre>".$ie6s.($row->sample_input).$ie6e."</pre>";
	echo "<h2>$MSG_Sample_Output</h2>
			<pre>".$ie6s.($row->sample_output).$ie6e."</pre>";
	if ($pr_flag||true) 
		echo "<h2>$MSG_HINT</h2>
			<div class='well'><p>".nl2br($row->hint)."</p></div>";
	if ($pr_flag) 
		echo "<h2>$MSG_Source</h2>
			<div class='well'><p><a href='problemset.php?search=$row->source'>".nl2br($row->source)."</a></p></div>";
	echo "<center>";
	if ($pr_flag){
		echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
	}else{
		echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
	}
	echo "[<a href='problemstatus.php?id=".$row->problem_id."'>$MSG_STATUS</a>]";

	echo "[<a href='bbs.php?pid=".$row->problem_id."$ucid'>$MSG_BBS</a>]";
	echo "</center>";
	
	
	?>
<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
