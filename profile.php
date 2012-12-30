<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
	require_once("./db_info.inc.php");
	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
	}else{
		require_once("./lang/en.php");
	}
    function checkmail(){
		
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg="<span id=red>(".$row[0].")</span>";
		mysql_free_result($result);
		return $retmsg;
	}
	function checkac(){
		$sql="SELECT * FROM `users` WHERE 
				`user_id`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg=$row[3];
		mysql_free_result($result);
		return $retmsg;
	}
	function checksumbit(){
		$sql="SELECT * FROM `users` WHERE 
				`user_id`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg=$row[2];
		mysql_free_result($result);
		return $retmsg;
	}
	$profile="";
		if (isset($_SESSION['user_id'])){
				$sid=$_SESSION['user_id'];
				$profile.= "<div class='sep'></div><p /><li><a href=./modifypage><i class='icon-pencil icon-white'></i> &#20462;&#25913;&#29992;&#25143;&#36164;&#26009;</a></li><li><a href='./userinfo?user=$sid'><i class='icon-user icon-white'></i> <span id=red>$sid</span></a></li>";
				$mail=checkmail();
				if ($mail)
					$profile.= "<li><a href=./mail><i class='icon-envelope icon-white'></i> &#26410;&#35835;$mail</a></li>";
					$profile.="<li><a href='./status?jresult=4&user_id=$sid'><i class='icon-ok-circle icon-white'></i> 通过 ".checkac(). " 题</a></li><li><a href='./status?user_id=$sid'><i class='icon-th-large icon-white'></i> 提交 ".checksumbit()." 题</a></li>";
                    $profile.= "<li><a href=./logout><i class='icon-off icon-white'></i> $MSG_LOGOUT</a></li>";
			}else{
                
				$profile.= "<li><a href='#mModal' data-toggle='modal' data-backdrop=''><i class='icon-user icon-white'></i> &#30331;&#24405;</a></li><li><a href='./signup'><i class='icon-flag icon-white'></i> &#27880;&#20876;</a></li>";
				
			}
			if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
				$profile.= "<li><a href=./admin><i class='icon-off icon-white'></i> $MSG_ADMIN</a></li>";
			
			}
		?>
document.write("<?php echo ( $profile);?>");
