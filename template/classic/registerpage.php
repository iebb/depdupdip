
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
	<form action="register.php" method="post">
	<br><br>
	<center><table>
		<tr><td colspan=2 height=40 width=500>&nbsp;&nbsp;&nbsp;<?php echo $MSG_REG_INFO?></td></tr>
		<tr><td width=25%><?php echo $MSG_USER_ID?>:</td>
			<td width=75%><div class="control-group info" id="check">
			  <div class="controls">
				<input type="text" id="inputUID" name="user_id">
				<span class="help-inline" id="helpin">Enter Username</span>
			  </div>
			</div>
		</td>
		</tr>
		<script language="javascript">
		function checkConfirm(){ 
		$("#inputUID").blur(function(){
		var gradename = $(this).val(); 
		var changeUrl = "checkid.php?name="+gradename; 
		$.get(changeUrl,function(str){ 
		if(str == '1'){ 
		$("#helpin").html("Username is taken >_< "); 
		changecss("control-group error");
		}else{ 
		$("#helpin").html("Good name ^_^ "); 
		changecss("control-group success");
		}
		return false; 
		})
		})}
		
		function checkMail(){ 
		$("#inputEML").blur(function(){
		var gradename = $(this).val(); 
		if($("#inputEML").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){ 
		$("#helpml").html("Good ^_^"); 
		changecss("control-group success");
		}else{ 
		$("#helpml").html("That's not an e-mail >_< "); 
		changecss("control-group error");
		}
		return false; 
		})
		}
		
		function changecss(classname){
        var obj = $("#check");
        obj.removeClass();
        obj.addClass(classname);
		}
		
		$(document).ready(function(){checkConfirm();checkMail();});
		
		</script>
		<tr><td><?php echo $MSG_NICK?>:</td>
			<td><input name="nick" size=50 type=text></td>
		</tr>
		<tr><td><?php echo $MSG_PASSWORD?>:</td>
			<td><input name="password" size=20 type=password>*</td>
		</tr>
		<tr><td><?php echo $MSG_REPEAT_PASSWORD?>:</td>
			<td><input name="rptpassword" size=20 type=password>*</td>
		</tr>
		<tr><td><?php echo $MSG_SCHOOL?>:</td>
			<td><input name="school" size=30 type=text></td>
		</tr>
		<tr><td><?php echo $MSG_EMAIL?>:</td>
			<td><div class="control-group info" id="check">
			  <div class="controls">
				<input type="text" id="inputEML" name="email">
				<span class="help-inline" id="helpml">Enter Your E-Mail</span>
			  </div>
			</div></td>
		</tr>
		<?php if($OJ_VCODE){?>
		<tr><td><?php echo $MSG_VCODE?>:</td>
			<td><input name="vcode" size=4 type=text><img alt="click to change" src="vcode.php" onclick="this.src='vcode.php#'+Math.random()">*</td>
		</tr>
		<?php }?>
		<tr><td></td>
			<td><input value="Submit" name="submit" type="submit">
				&nbsp; &nbsp;
				<input value="Reset" name="reset" type="reset"></td>
		</tr>
	</table></center>
	<br><br>
</form>

<div id=foot>
	<?php require_once("oj-footer.php");?>

</div><!--end foot-->
</div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
