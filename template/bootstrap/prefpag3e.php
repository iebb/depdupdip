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
	<form action="pref.php" method="post">
	<br><br>
	<center><table>
		<tr><td colspan=2 height=40 width=500>&nbsp;&nbsp;&nbsp;Update Information</td></tr>
		<tr><td width=25%>User ID:</td>
			<td width=75%><?php echo $_SESSION['user_id']?></td>
			<?php require_once('./include/set_post_key.php');?>
		</tr>
		<tr><td>Problems Per Page: </td><td>

		<select name="ppp">
		<option value=<?php echo $dv; ?> selected=true><?php echo $dv; ?> [Now]</option>	
		<option value=10>10</option>
		<option value=15>15</option>
		<option value=20>20</option>
		<option value=30>30</option>
		<option value=40>40</option>
		<option value=50>50</option>
		<option value=60>60</option>
		<option value=80>80</option>
		<option value=100>100</option>
		<option value=200>200</option>
		<option value=1000>1000</option>
		</select></td>
		</tr>
		<tr><td>QQ 登录:</td><td>

<?php 
$sql = "SELECT `qq` FROM `users` where `user_id`='".$_SESSION['user_id']."'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
if ($row[0]=="!")
echo('<a href="./login_qq.php"><img src="./qq_login.gif" /></a>');
else
echo('已绑定QQ');
?>
		</td></tr>
		<tr><td>微博登录:</td><td>

<?php 
$sql = "SELECT `wb` FROM `users` where `user_id`='".$_SESSION['user_id']."'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
if ($row[0]=="!")
echo('<a href="./login_weibo.php"><img src="./loginbtn_03.png" /></a>');
else
echo('已绑定微博');
?>
		</td></tr>
		<tr><td>人人登录:</td><td>

<?php 
$sql = "SELECT `rr` FROM `users` where `user_id`='".$_SESSION['user_id']."'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
if ($row[0]=="!")
echo('<a href="./login_renren.php"><img src="./loginrr.png" /></a>');
else
echo('已绑定人人');
?>
		</td></tr>
		<tr><td>IDEONE_UserID:
			<td><input name="uid" size=50 type=text value="<?php echo $uid; ?>" >
		</tr>
		<tr><td>IDEONE_Password:
			<td><input name="pwd" size=20 type=password value="<?php echo $pwd; ?>">
		</tr>
		<tr><td>Custom HTML:
			<td><textarea name="html"><?php echo $html; ?></textarea>
		</tr>			
		<tr><td>

			
<input value="Submit" name="submit" type="submit">
&nbsp; &nbsp;
<input value="Reset" name="reset" type="reset">
		</td></tr>

		</table>
		
		
		
		
</div>
	</table></center>
<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
