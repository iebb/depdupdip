<?php require_once("admin-header.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}?>
<?php {
	$from=mysql_real_escape_string($_POST['from']);
	$to=mysql_real_escape_string($_POST['to']);
	$start=intval($_POST['start']);
	$end=intval($_POST['end']);
	$sql="update `problem` set `defunct`='N' where `defunct`='Y'";
	echo $sql;
	mysql_query($sql);
	
}
?>