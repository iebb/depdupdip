<?php

function http_request($url,$is_post=False){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($is_post){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"");
    }
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}

require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");

if(array_key_exists('code',$_GET)){
    $code = $_GET['code'];
    $GURL = "https://api.weibo.com/oauth2/access_token?";
    $vars = array(
        'client_id'=>$OJ_WEIBO_AKEY,
        'client_secret'=>$OJ_WEIBO_ASEC,
        'grant_type'=>'authorization_code',
        'redirect_uri'=>$OJ_WEIBO_CBURL,
        'code'=>$code);
	
    $GURL = $GURL.http_build_query($vars);
    $ret = http_request($GURL,True);
    $data = json_decode($ret);
    if (array_key_exists('uid',$data)){
        $token = $data->access_token;
        $uid = $data->uid;
        $vars = array(
            "access_token"=>$token,
            "uid"=>$uid
        );
        $UURL = "https://api.weibo.com/2/users/show.json?".http_build_query($vars);
        $user = json_decode(http_request($UURL,False));
#        var_dump($user);
#        exit(0);
        // register this user and login it
        $user_id = "wb_".$uid;
        // check first
         $sql = "SELECT `user_id` FROM `users` where `wb`='".$user_id."'";
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
				$sql = "UPDATE `users` SET `wb`='".$user_id."' WHERE `user_id` = '".$_SESSION['user_id']."'";
				echo $sql;
				$res = mysql_query($sql);
				header("Location: ./"); 
			}else{
				$_SESSION['wb']=$row[0];
				header("Location: ./loginpage.php");
			}
		}
    }else{
        echo "Login Expire!";
    }
}
else{
    $CBURL="https://api.weibo.com/oauth2/authorize?client_id={$OJ_WEIBO_AKEY}&response_type=code&redirect_uri=$OJ_WEIBO_CBURL";
    header("Location: ".$CBURL);
}
?>
