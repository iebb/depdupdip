<?php @session_start();
	ini_set("display_errors","Off");
static 	$DB_HOST="localhost";
static 	$DB_NAME="[YOUR_DB_NAME]";
static 	$DB_USER="[YOUR_DB_USER]";
static 	$DB_PASS="[YOUR_DB_PASS]";
	// connect db 
static 	$OJ_NAME="[YOUR_OJ_NAME]";
static 	$OJ_HOME="./";
static 	$OJ_ADMIN="[YOUR_EMAIL]";
static 	$OJ_DATA="/home/judge/data";
static 	$OJ_BBS="discuss";//"bbs" for phpBB3 bridge or "discuss" for mini-forum
static  $OJ_ONLINE=false;
static  $OJ_LANG="en";
static  $OJ_SIM=true; 
static  $OJ_DICT=true;
static  $OJ_LANGMASK=0; //1mC 2mCPP 4mPascal 8mJava 16mRuby 32mBash 1008 for security reason to mask all other language
static  $OJ_EDITE_AREA=true;//true: syntax highlighting is active
static  $OJ_AUTO_SHARE=true;//true: One can view all AC submit if he/she has ACed it onece.
static  $OJ_CSS="hoj.css";
static  $OJ_SAE=false; //using sina application engine
static  $OJ_VCODE=false;
static  $OJ_APPENDCODE=false;
static  $OJ_MEMCACHE=false;
static  $OJ_MEMSERVER="127.0.0.1";
static  $OJ_MEMPORT=11211;
static  $SAE_STORAGE_ROOT="http://hustoj-web.stor.sinaapp.com/";
static  $OJ_LOGIN_MOD="hustoj";

static $OJ_OPENID_PWD = '********************************';

/* weibo config here */
static  $OJ_WEIBO_AUTH=true;
static  $OJ_WEIBO_AKEY='**********';
static  $OJ_WEIBO_ASEC='********************************';
static  $OJ_WEIBO_CBURL='http://www.wetta.in/login_weibo.php';

/* renren config here */
static  $OJ_RR_AUTH=true;
static  $OJ_RR_AKEY='********************************';
static  $OJ_RR_ASEC='********************************';
static  $OJ_RR_CBURL='http://www.wetta.in/login_renren.php';
/* qq config here */
static  $OJ_QQ_AUTH=true;
static  $OJ_QQ_AKEY='100296713';
static  $OJ_QQ_ASEC='********************************';
static  $OJ_QQ_CBURL='http://www.wetta.in/login_qq.php';


//if(date('H')<5||date('H')>21||isset($_GET['dark'])) $OJ_CSS="dark.css";
if (isset($_SESSION['OJ_LANG'])) $OJ_LANG=$_SESSION['OJ_LANG'];

	if($OJ_SAE)	{
		$OJ_DATA="saestor://data/";
	//  for sae.sina.com.cn
		mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		$DB_NAME=SAE_MYSQL_DB;
	}else{
		//for normal install
		if(!mysql_pconnect($DB_HOST,$DB_USER,$DB_PASS)) 
			die('Could not connect: ' . mysql_error());
	}
	// use db
	mysql_query("set names utf8");
  //if(!$OJ_SAE)mysql_set_charset("utf8");
	
	if(!mysql_select_db($DB_NAME))
		die('Can\'t use foo : ' . mysql_error());
	//sychronize php and mysql server
	date_default_timezone_set("PRC");
	mysql_query("SET time_zone ='+8:00'");
	
//static  $OJ_TEMPLATE="classic";
	
if (isset($_SESSION['tmpl'])){
	$OJ_TEMPLATE=$_SESSION['tmpl'];
}else{
if (isset($_SESSION['user_id'])){
		$sql="SELECT `template` FROM users WHERE `user_id`='".$_SESSION['user_id']."'";
		$result = mysql_query ( $sql ); 
		$row = mysql_fetch_object ( $result );
		$_SESSION['tmpl']=$OJ_TEMPLATE=$row->template;
		mysql_free_result ( $result );
	}
	else
		$_SESSION['tmpl']=$OJ_TEMPLATE="classic";
}


?>
