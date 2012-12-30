﻿<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
</head>
<?php require_once("oj-header.php");?>
<body>
     
<div>
<ul class="breadcrumb">
    <li class="active">
        首页
    </li>
</ul>
<div class="row-fluid">
    <div class="span8">
        <div class="cell">
            <div class="title">Top 5 AC</div>
            <div class="body">
                
<table class="table table-striped table-bordered"  style="font-size:11;">
    <thead>
        <tr>
            <th style="width:10%;">#</th>
            <th style="text-align:center; width=60%;">Title</th>
            <th style="width:15%;">AC</th><th style="width:15%;">AR</th>
        </tr>
    </thead>
    <tbody>
        
       <?php include("embedlist.php");?>
        
    </tbody>
</table>

     </div>
        </div>
	
	<div class="cell">
            <div class="title">Recent Submit</div>
            <div class="body">
            <table class="table table-striped table-bordered"  style="font-size:11;">
                <thead>
                    <tr>
                        <th style="width:20px; text-align:center; ">#</th>
                        <th>状态</th>
                        <th style="width: 100%">题目</th>
                        <th>用户</th>
                        <th style="white-space:nowrap; ">编程语言</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php include("embedlist2.php");?>
            </table>
            </div>
        </div>
    </div>
<div class="span4">
<div class="cell">
            <div class="title">Search</div>
            <div class="body content">
               <ul class="tagcloud">
                    <form action="problemset.php" class="form-search">
					<span class="text-success">搜索问题</span>
					<div class="input-append">
					<input type="text" class="span6 search-query" name="search">
					<button type="submit" class="btn">搜索</button>
				    </div>
					</form>
					
					<form action="search.php" class="form-search">
					<span class="text-error">全文搜索</span>
					<div class="input-append">
					<input type="text" class="span6 search-query" name="search">
					<button type="submit" class="btn">搜索</button>
					</div>
					</form>
					
					<form action="problem.php" class="form-search">
					<span class="text-info">输入编号</span>
					<div class="input-append">
					<input type="text" class="span6 search-query" name="id">
					<button type="submit" class="btn">进入</button>
					</div>
					</form>

                </ul>
            </div>
        </div>
        <div class="cell" id="count">
            <div class="title">Top Users</div>
            <div class="body">
                <table class="table table-bordered">
    <tbody>
        <tr>
            <th style="width: 43%">ID</th>
            <th>Solved / Failed</th>
        </tr>
        <?php include("embedlist1.php");?>
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
