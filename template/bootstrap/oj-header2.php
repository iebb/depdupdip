
    <link href="./bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <link href="./bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="./template/classic/style.css" rel="stylesheet" type="text/css" />

<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<div id="leftnav" tabindex="-1">
<nav>

<div class="profile">
    <div class="profile_wrap">
         <?php
		$user=$_SESSION['user_id'];
       require_once('./include/db_info.inc.php');
	require_once("./include/const.inc.php");
	require_once("./include/my_func.inc.php");
if (!isset($_SESSION['user_id'])) echo '

	<div id="mModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="false">
	 <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="mModalLabel">Login</h3>
	  </div>
	  <form class="form" action=login method=post>
	  <div class="modal-body">
	  <div>
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="input" class="input-normal" placeholder="username" name="user_id" />
				<span class="add-on"><i class="icon-lock"></i></span>
				<input type="password" class="input-normal" placeholder="password" name="password" onkeydown="if(event.keyCode==13){lg.click()}"/>
	</div>
	<div><a href="./login_qq"><img src="./qq_login.gif" /></a>
		<a href="./login_weibo"><img src="./loginbtn_03.png" /></a>
		<a href="./login_renren"><img src="./loginrr.png" /></a>	
	</div>
	  </div>
	 
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" id="lg">Login</button>
	  </div>
	  </form>
	</div>';
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
            <!----script src="include/avatar?<?php echo rand();?>" ></script---->
            
            <span class="avatar_mask"></span>
        </div>
    </div>
</div>
<script type="text/javascript">
function newPopup(url) {
	popupWindow = window.open(url)
}
</script>
  <ul class="nav nav-list">
  <li class="nav-header">
        Online Judge
    </li>
    <li>
        <a href="./">
            <i class="icon-home icon-white"></i>
            &#39318;&#39029;
        </a>
    </li>
    <li>
        <a href="problemset?page=1">
            <i class="icon-question-sign icon-white"></i>
            &#38382;&#39064;
        </a>
    </li>
    <li>
        <a href="contest">
            <i class="icon-fire icon-white"></i>
            &#27604;&#36187;
        </a>
    </li>
    <li>
        <a href="status">
            <i class="icon-th-large icon-white"></i>
            &#29366;&#24577;
        </a>
    </li>
    <li>
        <a href="bbs">
            <i class="icon-comment icon-white"></i>
            &#35752;&#35770;
        </a>
    </li>
    <li>
        <a href="ranklist">
    <i class="icon-list icon-white"></i>
            &#25490;&#21517;
        </a>
        </li>
    <li>
        <a href=http://www.wetta.in:9090/?<?php if(isset($_SESSION['user_id'])) echo "nick=".$_SESSION['user_id']; else echo "randomnick=1" ?>&channels=chat&uio=d4 target="_blank">
    <i class="icon-comment icon-white"></i>
            在线 IRC
        </a>
    </li>
	<li>
        <a href="customtest" target="_blank">
    <i class="icon-road icon-white"></i>
            自定义测试
        </a>
    </li>
    <script src="include/profile?<?php echo rand();?>" ></script>   

</ul>

<div class="sep"></div>
<div class="copyright">
    &copy; 2012 <a href="./">OrzALC OJ</a><br>

    <a href="faqlist">FAQ</a>
	<a href="http://www.chipin.com/contribute/id/234f44aed860e0d1">&#25424;&#36192;</a>
	Based On <a href="https://code.google.com/p/hustoj/">HUSTOJ</a>
	<!--[if lt IE 10]><![endif]-->
	<a href="csstest.htm">CSS3TEST</a>
	
</div>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20909424-1']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</nav>
</div>

<div class="navbar navbar-inverse" style="position: static;">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".subnav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="#">Wetta OJ</a>
                  <div class="nav-collapse subnav-collapse">
                    <ul class="nav">
                      <li class="active"><a href="index">Home</a></li>
                      <li><a href="problemset?page=1">ProblemSet</a></li>
                      <li><a href="ranklist">Ranking</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">More...<b class="caret"></b></a>
                        <ul class="dropdown-menu">
		      
                          <li><a href=http://www.wetta.in:9090/?<?php if(isset($_SESSION['user_id'])) echo "nick=".$_SESSION['user_id']; else echo "randomnick=1" ?>&channels=chat&uio=d4" target="_blank">Chat</a></li>
                          <li><a href="status">Status</a></li>
						  <li><a href="customtest">Custom Test</a></li>
                          <li><span id="dict_status"></span><script src="include/underlineTranslation.js" type="text/javascript"></script>
					  <script type="text/javascript">dictInit();</script></li>
                          <li class="divider"></li>
                          <li class="nav-header">SETTINGS</li>
                          <li><a href="modifypage">Profile</a></li>
                          <li><a href="preferences">Preferences</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="navbar-search pull-left" action="problemset">
                      <input type="text" action="problemset" name="search" class="search-query span2" id="Searchbar" placeholder="Search">
                    </form>
                    <ul class="nav pull-right">
                      <li><?php if(isset($_SESSION['user_id'])) echo'<div class="btn-group">
  <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> '.$_SESSION['user_id'].'</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="modifypage"><i class="icon-pencil"></i> Edit</a></li>
    <li><a href="mail"><i class="icon-envelope"></i> Inbox</a></li>
    <li><a href="status?user_id=jebwizoscar"><i class="icon-info-sign"></i> Status</a></li>
    <li class="divider"></li>
    <li><a href="logout"><i class="icon-off"></i> Logout</a></li>
  </ul>
</div>'; else echo '<a href="#mModal" data-toggle="modal" data-backdrop="">Login</a>' ;?></li>
                     
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div><!-- /navbar -->
          </div>
 <script src="./bootstrap/assets/js/bootstrap.min.js"></script>
 <script src="./bootstrap/assets/js/jquery.js"></script>
    <script src="./bootstrap/assets/js/prettify.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-transition.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-alert.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-modal.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-scrollspy.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-tab.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-tooltip.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-popover.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-button.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-collapse.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-carousel.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-typeahead.js"></script>
    <script src="./bootstrap/assets/js/bootstrap-affix.js"></script>
    <script src="./bootstrap/assets/js/application.js"></script>