<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title=$MSG_MAIL;
 $to_user="";
$title="";
if (isset($_GET['to_user'])){
	$to_user=htmlspecialchars($_GET['to_user']);
}
if (isset($_GET['title'])){
	$title=htmlspecialchars($_GET['title']);
}
//view mail
$view_content=false;
if (isset($_GET['vid'])){
	$vid=intval($_GET['vid']);
	$sql="SELECT * FROM `mail` WHERE `mail_id`=".$vid."
								and to_user='".$_SESSION['user_id']."'";
	$result=mysql_query($sql);
	$row=mysql_fetch_object($result);
	$to_user=$row->from_user;
	$view_title=$row->title;
	$view_content=$row->content;
    $date=$row->in_date;
	mysql_free_result($result);
	$sql="update `mail` set new_mail=0 WHERE `mail_id`=".$vid;
	mysql_query($sql);
	
}
if (!isset($_SESSION['user_id'])){
	echo "<a href=loginpage.php>Please Login First</a>";
	require_once("oj-footer.php");
	exit(0);
}
require_once("./include/db_info.inc.php");
require_once("./include/const.inc.php");
if(isset($OJ_LANG)){
		require_once("./lang/$OJ_LANG.php");
		if(file_exists("./faqs.$OJ_LANG.php")){
			$OJ_FAQ_LINK="faqs.$OJ_LANG.php";
		}
}
echo "<title>$MSG_MAIL</title>";

//list mail
	$sql="SELECT * FROM `mail` WHERE to_user='".$_SESSION['user_id']."'
					order by mail_id desc";
	$result=mysql_query($sql) or die(mysql_error());
$view_mail=Array();
$i=0;
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>收件箱</title>
<link rel="stylesheet" type="text/css" href="imail/styles.css">
<link rel="stylesheet" type="text/css" href="imail/mail.css">


<script type="text/javascript" src="imail/jquery.ui.datepicker-zh-CN.js"></script>
<style type="text/css"></style></head>
<body>

<div class="minwidth">
<div id="header">
<div id="topline">
	
	<div class="topright">
	<span class="username">@<?php echo $_SESSION['user_id']; ?>
	
	</span>
	</div>
</div>

<div id="topnav">
	<div id="taskbar" class="topright">
	<a class="button-mail button-selected" id="rcmbtn102" href="inbox.php"><span class="button-inner">邮件</span></a>
	<a class="button-addressbook" id="rcmbtn103" href="index.php"><span class="button-inner">Online Judge</span></a>
	
	<a class="button-settings" id="rcmbtn104" href="logout.php"><span class="button-inner">退出</span></a>
	</div>

</div>

<br style="clear:both">
</div>
<?php

 function checkmail(){
		
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg=$row[0];
		mysql_free_result($result);
		return $retmsg;
	}
?>
<div id="mainscreen">
<?php include("mail_left.php"); ?>

<div id="mailview-right" style="left: 232px; ">



<div id="mailview-top">
<div id="messageheader" class="uibox">

<h2 class="subject"><?php echo $view_title;?></h2>
<table class="headers-table"><tbody><tr><td class="header-title">发件人</td>
<td class="header from">@<?php echo $to_user;?></td>
</tr>
<tr><td class="header-title">收件人</td>
<td class="header to">@<?php echo $_SESSION['user_id'];?></td>
</tr>
<tr><td class="header-title">日期</td>
<td class="header date"><?php echo $date;?></td>
</tr>
</tbody>
</table>

<div id="full-headers"><div id="all-headers" class="all" style="display:none"><div id="headers-source"></div></div>
<div class="more-headers show-headers"></div></div>


</div>


<div id="messagecontent" class="uibox" style="top: 116px; ">
<div class="rightcol" style="display: none; ">

</div>
<div class="leftcol" style="margin-right: 0px; ">


<div id="messagebody"><div class="message-part"><pre><?php echo $view_content;?>
</pre>
</div>
</div>

</div>
</div>

</div><!-- end mailview-top -->

<div id="mailview-bottom" class="uibox">

<div id="mailpreviewframe">
<iframe name="messagecontframe" id="messagecontframe" style="width:100%; height:100%" frameborder="0" src="imail/watermark.htm"></iframe>
</div>

</div><!-- end mailview-bottom -->

</div><!-- end mailview-right -->

<div id="mailviewsplitterv"class="splitter splitter-v" style="left: 223px; top: 0px; "></div></div><!-- end mainscreen -->

<div><!-- end minwidth -->

</div></div></body></html>