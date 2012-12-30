<?php  
    require("../include/db_info.inc.php");
	
	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
	}
?>

<?php if(isset($_GET['cid']))
	$cid=intval($_GET['cid']);
if (isset($_GET['pid']))
	$pid=intval($_GET['pid']);
?>
<link href="../template/classic/style.css" rel="stylesheet" type="text/css" />
<nav>
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

    <a href=setlang.php?lang=ko>KO</a>
		<a href=setlang.php?lang=cn>CN</a>
		<a href=setlang.php?lang=fa>FA</a>
		<a href=setlang.php?lang=en>EN</a>
		<a href=setlang.php?lang=th>TH</a>
</div>
</nav>

