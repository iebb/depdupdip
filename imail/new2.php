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
//send mail page 
//send mail
if(isset($_POST['to_user'])){
	$to_user = $_POST ['to_user'];
	$title = $_POST ['title'];
	$content = $_POST ['content'];
	$from_user=$_SESSION['user_id'];
	if (get_magic_quotes_gpc ()) {
		$to_user = stripslashes ( $to_user);
		$title = stripslashes ( $title);
		$content = stripslashes ( $content );
	}
	$to_user=mysql_real_escape_string($to_user);
	$title=mysql_real_escape_string($title);
	$content=mysql_real_escape_string($content);
	$from_user=mysql_real_escape_string($from_user);
	$sql="select 1 from users where user_id='$to_user' ";
	$res=mysql_query($sql);
	if ($res&&mysql_num_rows($res)<1){
			mysql_free_result($res);
			$view_title= "No Such User!";
			
	}else{
		if($res)mysql_free_result($res);
		$sql="insert into mail(to_user,from_user,title,content,in_date)
						values('$to_user','$from_user','$title','$content',now())";
		
		if(!mysql_query($sql)){
			$view_title=  "Not Mailed!";
		}else{
			$view_title=  "Mailed!";
		}
	}
}
//list mail
	$sql="SELECT * FROM `mail` WHERE to_user='".$_SESSION['user_id']."'
					order by mail_id desc";
	$result=mysql_query($sql) or die(mysql_error());
$view_mail=Array();
$i=0;

?>
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

<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新邮件</title>
<link rel="stylesheet" type="text/css" href="mail/styles.css">
<link rel="stylesheet" type="text/css" href="mail/mail.css">


<script type="text/javascript" src="mail/jquery.ui.datepicker-zh-CN.js"></script>
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
	<a class="button-mail button-selected" id="rcmbtn102" href="inbox.php"><span class="button-inner">邮件</span></a>
	<a class="button-addressbook" id="rcmbtn103" href="index.php"><span class="button-inner">Online Judge</span></a>
	
	<a class="button-settings" id="rcmbtn104" href="logout.php"><span class="button-inner">退出</span></a>
	</div>
</div>

</div>




<div id="mainscreen">

<div id="composeview-left">

<div id="folderlist-header"></div>
<div id="mailboxcontainer" class="uibox listbox">
<div id="folderlist-content" class="scroller withfooter">
<ul id="mailboxlist" class="listing">
<li class="mailbox inbox unread selected">
<a href="inbox.php" rel="INBOX">收件箱<span class="unreadcount"><?php echo checkmail(); ?></span></a>
</li>
<li class="mailbox inbox unread selected">
<a href="new.php" rel="INBOX">新邮件</a>
</li>
<li class="mailbox inbox unread selected">
<a href="inbox.php" rel="INBOX">刷新</a>
</li>
<li class="mailbox inbox unread selected">
<a href="status.php" rel="INBOX">状态</a>
</li>
<li class="mailbox inbox unread selected">
<a href="problemset.php" rel="INBOX">问题</a>
</li>
</ul>

</div>
</div>


</div>

<div id="composeview-right">


<form name="form" action="new.php" method="post" id="compose-content" class="uibox">

<!-- message headers -->
<div id="composeheaders">

<table class="headers-table compose-headers">
<tbody>
	<tr>
		<td class="title"><label for="_from">发件人</label></td>
		<td class="editfield">
			<?php echo $_SESSION['user_id']; ?>
		</td>
	</tr><tr>
		<td class="title top"><label for="_to">收件人</label></td>
		<td class="editfield"><textarea name="to_user" spellcheck="false" cols="70" rows="1" tabindex="2"></textarea></td>
	</tr><tr>
		<td class="title"><label for="compose-subject">主题</label></td>
		<td class="editfield"><input name="title" tabindex="8" spellcheck="true" value="" type="text"></td>
	</tr>
</tbody>
</table>

<div id="composebuttons" class="formbuttons">
	<input type="submit" class="button mainaction" onclick="submit" value="立即发送">
</div>

</div>

<div id="composeview-bottom">
		<textarea name="content" id="composebody" cols="100%" rows="100%"></textarea>
</div>

</form>


</div><!-- end mailview-right -->

</div><!-- end mainscreen -->

</div><!-- end minwidth -->

</body>
<!-- end version 5 -->
</html>