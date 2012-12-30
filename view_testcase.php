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
    <li class="active">
        查看数据
    </li>
</ul>
<div class="row-fluid">
    <div class="span12">
        <div class="cell">
            <div class="title">Data List</div>
            <div class="body">
                
<table class="table table-striped table-bordered"  style="font-size:11;">
    <thead>
        <tr>
            <th style="width:10%;">#</th>
            <th style="text-align:center;">Filename</th>
			<th style="width:20%;">Size</th>
        </tr>
    </thead>
    <tbody>
       <?php
	    $i=-1;
		$handler = opendir('/home/judge/data/'.(int)$_GET['pid']);
		if ($handler){
		while(($filename = readdir($handler)) !== false )
		{
	    if($filename != '.' && $filename != '..' && strpos($filename,'.out')===false)//&& 
			  {
			  $str="";
			  $size=filesize('/home/judge/data/'.(int)$_GET['pid'].'/'.$filename);
			  if ($size>=1000) {$size/=1000; $str="K";}
			  if ($size>=1000) {$size/=1000; $str="M";}
			  if ($size>=1000) {$size/=1000; $str="G";}
			  $i++;echo "<tr><td>".$i."</td><td><a href='view_data.php?pid=".(int)$_GET['pid']."&file=".str_replace('.in','',$filename)."'>".str_replace('.in','.in/out',$filename)."</td><td>".sprintf("%3.3f",$size).$str." Bytes</td></tr>";}
		}
		closedir($handler);}
		else echo "
		File Not Found";
		?> 
      
    </tbody>
</table>

     </div>
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
