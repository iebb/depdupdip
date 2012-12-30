<link href="./template/classic/style.css" rel="stylesheet" type="text/css" />
<nav>
<div class="profile">
    <div class="profile_wrap">
         <?php

$user=$_SESSION['user_id'];
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
	require_once('../include/cache_start.php');
    require_once('../include/db_info.inc.php');
	require_once('../include/setlang.php');
	require_once("../include/const.inc.php");
	require_once("../include/my_func.inc.php");
 // check user

if (!is_valid_user_name($user)){
	$email="";
	$user="Guest";
}
$view_title=$user ."@".$OJ_NAME;
$user_mysql=mysql_real_escape_string($user);
$sql="SELECT `email` FROM `users` WHERE `user_id`='$user_mysql'";
$result=mysql_query($sql);
$row_cnt=mysql_num_rows($result);
if ($row_cnt==0){ 
	$email="";
	$user="Guest";
}
else
{
$row=mysql_fetch_object($result);
$school=$row->school;
$emails=$row->email;
$nick=$row->nick;
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
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
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
?>
        <span class="username"><?php echo $user;?></span>
        <span class="tagline"></span>
        
     	 <div class="avatar">
           
<?php echo '<img src='.get_gravatar( $emails ).' width="45" height="45">';?>
            <!----script src="include/avatar.php?<?php echo rand();?>" ></script---->
            
            <span class="avatar_mask"></span>
        </div>
    </div>
</div>
  <ul class="nav nav-list">
  <li class="nav-header">
        Online Judge
    </li>
    <li>
        <a href="<?php echo $OJ_HOME?>">
            <i class="icon-home icon-white"></i>
            &#39318;&#39029;
        </a>
    </li>
    <li>
        <a href="../problemset.php">
            <i class="icon-question-sign icon-white"></i>
            &#38382;&#39064;
        </a>
    </li>
    <li>
        <a href="../contest.php">
            <i class="icon-fire icon-white"></i>
            &#27604;&#36187;
        </a>
    </li>
    <li>
        <a href="../status.php">
            <i class="icon-th-large icon-white"></i>
            &#29366;&#24577;
        </a>
    </li>
    <li>
        <a href="../bbs.php">
            <i class="icon-comment icon-white"></i>
            &#35752;&#35770;
        </a>
    </li>
    <li>
        <a href="../contestrank.php?cid=<?php echo $cid?>">
    <i class="icon-list icon-white"></i>
            &#25490;&#21517;
        </a>
        </li>
    <script src="../include/profile.php?<?php echo rand();?>" ></script>   

</ul>
<div class="sep"></div>
<div class="copyright">
    &copy; 2012 <a href="http://www.wetta.in">OrzALC OJ</a><br>


</div>
</nav>

 
<div id=main>
