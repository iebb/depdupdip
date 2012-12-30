<?php

$user=$_GET['user'];
$rank=$_GET['rank'];
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	require_once("./include/const.inc.php");
	require_once("./include/my_func.inc.php");
 // check user

if (!is_valid_user_name($user)){
	echo "No such User!";
	exit(0);
}
$view_title=$user ."@".$OJ_NAME;
$user_mysql=mysql_real_escape_string($user);
$sql="SELECT `email` FROM `users` WHERE `user_id`='$user_mysql'";
$result=mysql_query($sql);
$row_cnt=mysql_num_rows($result);
if ($row_cnt==0){ 
	$email="";
}
else
{
$row=mysql_fetch_object($result);
$emails=$row->email;
mysql_free_result($result);
}

	/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 100, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}
if ($rank<=5)
 echo '<img src='.get_gravatar( $emails ).' width="72" height="72" />';
 else if ($rank<=10)
 echo '<img src='.get_gravatar( $emails ).' width="54" height="54" />';
 else if ($rank<=20)
 echo '<img src='.get_gravatar( $emails ).' width="36" height="36" />';
 else if ($rank<=40)
 echo '<img src='.get_gravatar( $emails ).' width="24" height="24" />';
 else
 echo '<img src='.get_gravatar( $emails ).' width="18" height="18" />';
 ?>