<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	require_once("./include/db_info.inc.php");
	require_once("./include/my_func.inc.php"); 
	//Step1£º»ñÈ¡Authorization Code
	session_start();
	$code = $_REQUEST["code"];
	if(empty($code)) 
	{
		 $_SESSION['state'] = md5(uniqid(rand(), TRUE));  
		 $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
			. $OJ_QQ_AKEY . "&redirect_uri=" . urlencode($OJ_QQ_CBURL) . "&state="
			. $_SESSION['state'];
		echo("<script> top.location.href='" . $dialog_url . "'</script>");
	}

  {
     $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
     . "client_id=" . $OJ_QQ_AKEY . "&redirect_uri=" . urlencode($OJ_QQ_CBURL)
     . "&client_secret=" . $OJ_QQ_ASEC . "&code=" . $code;
     $response = file_get_contents($token_url);
     if (strpos($response, "callback") !== false)
     {
        $lpos = strpos($response, "(");
        $rpos = strrpos($response, ")");
        $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
        $msg = json_decode($response);
        if (isset($msg->error))
        {
           echo "<h3>error:</h3>" . $msg->error;
           echo "<h3>msg  :</h3>" . $msg->error_description;
           exit;
        }
     }

     //get OpenID
     $params = array();
     parse_str($response, $params);
     $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" 
     .$params['access_token'];
     $str  = file_get_contents($graph_url);
     if (strpos($str, "callback") !== false)
     {
        $lpos = strpos($str, "(");
        $rpos = strrpos($str, ")");
        $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
     }

     $user = json_decode($str);
     if (isset($user->error))
     {
        echo "<h3>error:</h3>" . $user->error;
        echo "<h3>msg  :</h3>" . $user->error_description;
        exit;
     }

     //get userInfo
     $graph_url="https://graph.qq.com/user/get_user_info?access_token="
     .$params['access_token']."&oauth_consumer_key=".$OJ_QQ_AKEY
     ."&openid=".$user->openid."&format=json";
     $str  = file_get_contents($graph_url);
     $userInfo=json_decode($str);
     
     $user_id="qq_".$user->openid;
     $nick=$userInfo->nickname;
     $password =$OJ_OPENID_PWD;;
     $email ="xx";
     $school = "xx"; 
     
     $sql = "SELECT `user_id` FROM `users` where `qq`='".$user_id."'";
     $res = mysql_query($sql);
     $row = mysql_fetch_array($res);
     $k = mysql_num_rows($res);
	 
    if ($k>0){
		 $_SESSION['user_id']=$row[0];
		$sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`='".mysql_real_escape_string($_SESSION['user_id'])."'";
    		$result=mysql_query($sql);
		while ($result&&$row=mysql_fetch_assoc($result))
			$_SESSION[$row['rightstr']]=true;
		 // redirect it
		 header("Location: ./"); 
    }
	 
    else{
		if(isset($_SESSION['user_id'])){
			$sql = "UPDATE `users` SET `qq`='".$user_id."' WHERE `user_id` = '".$_SESSION['user_id']."'";
			echo $sql;
			$res = mysql_query($sql);
			header("Location: ./"); 
		}else{
			$_SESSION['qq']=$row[0];
			header("Location: ./loginpage.php");
		}
    }
  }
  
?>


