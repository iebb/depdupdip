<?php require_once("admin-header.php");

	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
	}
	

?>
<html>
<head>
<title><?php echo $MSG_ADMIN?></title>
<link href="../template/classic/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<nav>
<div class="profile">
    <div class="profile_wrap">
         <?php
$user=$_SESSION['user_id'];
       require_once('../include/db_info.inc.php');
	require_once("../include/const.inc.php");
	require_once("../include/my_func.inc.php");
 // check user

if (!is_valid_user_name($user)){
	$email="";
	$user="Guest";
}
else
{
$userz_mysql=mysql_real_escape_string($user);
$sqlz="SELECT `email` FROM `users` WHERE `user_id`='$userz_mysql'";
$resultz=mysql_query($sqlz);
$row_cntz=mysql_num_rows($resultz);
$rowz=mysql_fetch_object($resultz);
$emails=$rowz->email;
mysql_free_result($resultz);
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
		<a href="../status.php" target="main"><b><?php echo $MSG_SEEOJ?></b></a>
<?php if (isset($_SESSION['administrator'])){
	?>
	</li>
    <li>
		<a href="news_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_NEWS?></b></a>
	</li>
    <li>
		<a href="news_list.php" target="main"><b><?php echo $MSG_NEWS.$MSG_LIST?></b></a>
		
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['problem_editor'])){
?>
	</li>
    <li>
		<a href="problem_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_PROBLEM?></b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
?>
	</li><li>
		<a href="problem_list.php" target="main"><b><?php echo $MSG_PROBLEM.$MSG_LIST?></b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
?>		
</li><li>
	<a href="contest_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_CONTEST?></b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
?>
</li><li>
	<a href="contest_list.php" target="main"><b><?php echo $MSG_CONTEST.$MSG_LIST?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?>
</li><li>
	<a href="team_generate.php" target="main"><b><?php echo $MSG_TEAMGENERATOR?></b></a>
</li><li>
	<a href="setmsg.php" target="main"><b><?php echo $MSG_SETMESSAGE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="changepass.php" target="main"><b><?php echo $MSG_SETPASSWORD?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="rejudge.php" target="main"><b><?php echo $MSG_REJUDGE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="privilege_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_PRIVILEGE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="privilege_list.php" target="main"><b><?php echo $MSG_PRIVILEGE.$MSG_LIST?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="source_give.php" target="main"><b><?php echo $MSG_GIVESOURCE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="non_ac_give.php" target="main"><b>GiveNonACSource</b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="source_change.php" target="main"><b>ChangeSource</b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="problem_export.php" target="main"><b><?php echo $MSG_EXPORT.$MSG_PROBLEM?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="problem_import.php" target="main"><b><?php echo $MSG_IMPORT.$MSG_PROBLEM?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?></li><li>
	<a href="update_db.php" target="main"><b><?php echo $MSG_UPDATE_DATABASE?></b></a>
<?php }
if (isset($OJ_ONLINE)&&$OJ_ONLINE){
?></li><li>
	<a href="../online.php" target="main"><b><?php echo $MSG_ONLINE?></b></a>
<?php }
?>
</li><li>
	<a href="http://code.google.com/p/hustoj/" target="main"><b>HUSTOJ</b></a>
</li><li>
	<a href="http://code.google.com/p/freeproblemset/" target="main"><b>FreeProblemSet</b></a>
<?php if (isset($_SESSION['administrator'])&&!$OJ_SAE){
?>
</li><li>
	<a href="problem_copy.php" target="main" title="Create your own data"><font color="eeeeee">CopyProblem</font></a>
    </li><li>
	<a href="problem_changeid.php" target="main" title="Danger,Use it on your own risk"><font color="eeeeee">ReOrderProblem</font></a>
<?php }
?>
</li>
</ul>
</nav>
</body>
</html>
