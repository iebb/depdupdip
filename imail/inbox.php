﻿<?php
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

if (!isset($_SESSION['user_id'])){
	echo "<a href=loginpage>Please Login First</a>";
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
	<span class="username">@
	<?php echo $_SESSION['user_id']; ?>
	
	</span>
	</div>
</div>

<div id="topnav">
	<div id="taskbar" class="topright">
	<a class="button-mail button-selected" id="rcmbtn102" href="inbox"><span class="button-inner">邮件</span></a>
	<a class="button-addressbook" id="rcmbtn103" href="index"><span class="button-inner">Online Judge</span></a>
	
	<a class="button-settings" id="rcmbtn104" href="logout"><span class="button-inner">退出</span></a>
	</div>
</div>
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



<div id="mailview-top" class="uibox fullheight">

<!-- messagelist -->
<div id="messagelistcontainer" class="boxlistcontent">
<table id="messagelist" class="records-table sortheader"><thead><tr><td class="threads" id="rcmthreads">
<div class="listmenu" id="listmenulink" title="List options..."></div></td>
<td class="subject" id="rcmsubject">主题</a></td>
<td class="status" id="rcmstatus"><span class="status">状态</span></td>
<td class="fromto" id="rcmfromto">发件人</a></td>
<td class="date" id="rcmdate">日期</a></td>
<td class="size" id="rcmsize">ID</a></td>
</tr>
</thead>
<tbody>
	
	
	<?php
	
for (;$row=mysql_fetch_object($result);){
echo '
<tr id="rcmrow1" class="message">
<td class="threads"></td>
<td class="subject">
<span id="msgicn1" class="msgicon">&nbsp;</span>
<a href="viewmail?vid='.$row->mail_id.'">';
	echo $row->title;
	echo '</a>
</td>

<td class="status">
<span id="statusicn1"';
if ((bool)($row->new_mail)) echo 'style="color:#FF0000;">新'; else echo '>';
echo '</span>
</td>';
echo '
<td class="fromto"><span title="@'.$row->from_user.'" class="rcmContactAddress" ><a href="userinfo?user='.$row->from_user.'">@'.$row->from_user.'</a></span></td>
';
echo '
<td class="date">'.$row->in_date.'</td>
';
echo '<td class="size">'.$row->mail_id.'</td>
</tr>';
}
mysql_free_result($result);


?>

</tbody></table>

</div>


</div><!-- end mailview-top -->

<div id="mailview-bottom" class="uibox">

<div id="mailpreviewframe">
<iframe name="messagecontframe" id="messagecontframe" style="width:100%; height:100%" frameborder="0" src="imail/watermark.htm"></iframe>
</div>

</div><!-- end mailview-bottom -->

</div><!-- end mailview-right -->

<div id="mailviewsplitterv" unselectable="on" class="splitter splitter-v" style="left: 223px; top: 0px; "></div></div><!-- end mainscreen -->

<div><!-- end minwidth -->

</div></div></body></html>