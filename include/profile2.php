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
	$profile="";
		if (isset($_SESSION['user_id'])){
				$sid=$_SESSION['user_id'];
				$profile.= "<li><a href='./customtest.php'><i class='icon-print icon-white'></i> &#33258;&#23450;&#20041;&#27979;&#35797;</a></li><li><a href=./modifypage.php><i class='icon-user icon-white'></i> &#20462;&#25913;&#29992;&#25143;&#36164;&#26009;</a></li><li><a href='./userinfo.php?user=$sid'><i class='icon-user icon-white'></i> <span id=red>$sid</span></a></li>";
				$mail=checkmail();
				if ($mail)
					$profile.= "<li><a href=./mail.php><i class='icon-envelope icon-white'></i> &#26410;&#35835;$mail</a></li>";
        $profile.="<li><a href='status.php?user_id=$sid'><i class='icon-th-large icon-white'></i> &#25105;&#30340;&#29366;&#24577;</a></li>";
                                
				$profile.= "<li><a href=./logout.php><i class='icon-off icon-white'></i> $MSG_LOGOUT</a></li>";
			}else{
                if ($OJ_WEIBO_AUTH){
				    $profile.= "<a href=./login_weibo.php>$MSG_LOGIN(WEIBO)</a>&nbsp;";
                }
                if ($OJ_RR_AUTH){
				    $profile.= "<a href=./login_renren.php>$MSG_LOGIN(RENREN)</a>&nbsp;";
                }
                if ($OJ_QQ_AUTH){
            $profile.= "<a href=./login_qq.php>$MSG_LOGIN(QQ)</a>&nbsp;";
                }
				$profile.= "<li><a href='loginpage.php'><i class='icon-user icon-white'></i> &#30331;&#24405;</a></li><li><a href='registerpage.php'><i class='icon-flag icon-white'></i> &#27880;&#20876;</a></li>";
				
			}
			if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
				$profile.= "<li><a href=./admin><i class='icon-off icon-white'></i> $MSG_ADMIN</a></li>";
			
			}
		?>
document.write("<?php echo ( $profile);?>");
