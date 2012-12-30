<!DOCTYPE html>
	<?php require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>查看数据</title>
</head>
<?php require_once("oj-header.php");?>
<body>
     
<div>
<ul class="breadcrumb">
     <li>
        <a href="/">首页</a>
        <span class="divider">/</span>
    </li>
    <li>
        <a href="problemset.php">题目</a>
        <span class="divider">/</span>
    </li>
    <li>
        <a href="problem.php?id=<?php echo (int)$_GET['pid']; ?>">P<?php echo (int)$_GET['pid']; ?></a>
        <span class="divider">/</span>
    </li>
	<li>
        <a href="view_testcase.php?pid=<?php echo (int)$_GET['pid']; ?>">查看数据</a>
        <span class="divider">/</span>
    </li>
    <li class="active">
        <?php echo $_GET['file']; ?>.in/out
    </li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="cell">
            <div class="title">File : <?php echo $_GET['file']; ?></div>
            <div class="body">
             </div>
        </div>
    </div>
</div>
<div class="row-fluid">
<div class="span6">
<h2>input</h2>
<div class="well">
<textarea class="span12" name="input" rows=30 id="input" style="font-family:Courier New"><?php
		if (isset($_SESSION['user_id']))
		{
		$i=-1;
		$handler = '/home/judge/data/'.(int)$_GET['pid'].'/'.$_GET['file'].'.in';
		if (filesize($handler)<524288)	
		echo file_get_contents($handler);
		else
		echo '>_< Too Large [>1 MB] = =';
		}
		else
		echo 'Log In First';
		?></textarea>
</div>  
</div>  
<div class="span6">
<h2>output</h2>
<div class="well">
<textarea class="span12" name="output" rows=30 id="output" style="font-family:Courier New"><?php
		if (isset($_SESSION['user_id']))
		{
		$i=-1;
		$handler = '/home/judge/data/'.(int)$_GET['pid'].'/'.$_GET['file'].'.out';
		if (filesize($handler)<524288)		
		echo file_get_contents($handler);
		else
		echo '>_< Too Large [>1 MB] = =';
		}
		else
		echo 'Log In First';
		?></textarea>
</textarea>
</div>  
</div>
</div>  


    
<div id="foot">
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end wrapper-->

</body>
</html>
<?php require_once('./include/cache_end.php'); ?>
