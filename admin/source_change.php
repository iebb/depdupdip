<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit Problem</title>
</head>
<body>
<center>
<script language="Javascript" type="text/javascript" src="../edit_area/edit_area_full.js"></script>
<script language="Javascript" type="text/javascript">

editAreaLoader.init({
	        id: "source"            
	        ,start_highlight: true 
	        ,allow_resize: "both"
	        ,allow_toggle: true
	        ,word_wrap: true
	        ,language: "en"
	        ,syntax: "cpp"  
			,font_size: "8"
	        ,syntax_selection_allow: "basic,c,cpp,java,pas,perl,php,python,ruby"
			,toolbar: "search, go_to_line, fullscreen, |, undo, redo, |, select_font,syntax_selection,|, change_smooth_selection, highlight, reset_highlight, word_wrap, |, help"          
	});
</script>
<?php require_once("../include/db_info.inc.php");?>
<?php require_once("admin-header.php");

/*if (!(isset($_SESSION['administrator'])
      ||isset($_SESSION['problem_editor'])
     )){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}*/
?>
<td width="100"></td>
</center>
<hr>

<h1>Edit submission</h1>
<form method=POST action=source_change.php>
<p>Submission Id: </p>
<p>
  <input name=problem_id value=''>
  <input type=submit value=Submit name=submit>
</p>
<p>Code:</p>
<textarea cols=80 rows=20 id="source" name="source"> </textarea>
<p>&nbsp; </p>
<div align=center>

<input type=submit value=Submit name=submit>
</div></form>
<p>


<?php
$source=$_POST['source'];
if (!empty($source))
{
$id=intval($_POST['problem_id']);
$source=mysql_real_escape_string($source);
$sql="UPDATE `source_code` set `source`='$source' WHERE `solution_id`=$id";
echo $sql;
@mysql_query($sql) or die(mysql_error());
echo "Edit OK!";
echo "<a href='../status.php?top=$id'>See It!</a>";
$rjsid=$id;
$sql="UPDATE `solution` SET `result`=1 WHERE `solution_id`=".$rjsid;
mysql_query($sql) or die(mysql_error());
$sql="delete from `sim` WHERE `s_id`=".$rjsid;
mysql_query($sql) or die(mysql_error());
$url="../status.php?top=".($rjsid+1);
echo "Rejudged Runid ".$rjsid;
echo "<script>location.href='$url';</script>";
}
?>

</body>
</html>

