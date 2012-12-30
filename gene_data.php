<?
	$OJ_CACHE_SHARE=false;
	$cache_time=60;
	require_once('./include/db_info.inc.php');
	require_once('./include/cache_start.php');
	require_once('./include/setlang.php');
	require_once('./include/problem.php');
if (!(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo $view_title?></title>
	<link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE?>/<?php echo isset($OJ_CSS)?$OJ_CSS:"hoj.css" ?>' type='text/css'>
</head>
<script type="text/javascript">
function toggle()
{
document.all.lang.value = <?php if(!empty($_POST['lang'])) echo $_POST['lang']; else echo('1'); ?>;
}
</script>
<body onload="toggle()">
<script type="text/javascript" src="./jscolor/jscolor.js"></script>
<script language="Javascript" type="text/javascript" src="./edit_area/edit_area_full.js"></script>

<script language="Javascript" type="text/javascript">
		editAreaLoader.init({
	        id: "source"            
	        ,start_highlight: true 
	        ,allow_resize: "both"
	        ,allow_toggle: false
	        ,word_wrap: true
	        ,language: "en"
	        ,syntax: "cpp"  
			,font_size: "12"
			,toolbar: "search, go_to_line, fullscreen, |, undo, redo, |, select_font,syntax_selection,|, change_smooth_selection, highlight, reset_highlight, word_wrap, |, help"          
	});
</script>
<div id="wrapper">
	<?php require_once("./oj-header.php");?>
<div id="main">

<form id="code" action="#" method="POST">

<div class="well"><select name="lang" id="lang">
				    <option value="7">Ada (gnat-4.3.2)</option>
				    <option value="13">Assembler (nasm-2.07)</option>
				    <option value="45">Assembler (gcc-4.3.4)</option>
				    <option value="104">AWK (gawk) (gawk-3.1.6)</option>
				    <option value="105">AWK (mawk) (mawk-1.3.3)</option>
				    <option value="28">Bash (bash 4.0.35)</option>
				    <option value="110">bc (bc-1.06.95)</option>
				    <option value="12">Brainfuck (bff-1.0.3.1)</option>
				    <option value="11">C (gcc-4.3.4)</option>
				    <option value="27">C# (mono-2.8)</option>
				    <option value="1">C++ (gcc-4.3.4)</option>
				    <option value="44">C++0x (gcc-4.5.1)</option>
				    <option value="34">C99 strict (gcc-4.3.4)</option>
				    <option value="14">CLIPS (clips 6.24)</option>
				    <option value="111">Clojure (clojure 1.1.0)</option>
				    <option value="118">COBOL (open-cobol-1.0)</option>
				    <option value="106">COBOL 85 (tinycobol-0.65.9)</option>
				    <option value="32">Common Lisp (clisp) (clisp 2.47)</option>
				    <option value="102">D (dmd) (dmd-2.042)</option>
				    <option value="36">Erlang (erl-5.7.3)</option>
				    <option value="124">F# (fsharp-2.0.0)</option>
				    <option value="123">Factor (factor-0.93)</option>
				    <option value="125">Falcon (falcon-0.9.6.6)</option>
				    <option value="107">Forth (gforth-0.7.0)</option>
				    <option value="5">Fortran (gfortran-4.3.4)</option>
				    <option value="114">Go (gc-2010-07-14)</option>
				    <option value="121">Groovy (groovy-1.7)</option>
				    <option value="21">Haskell (ghc-6.8.2)</option>
				    <option value="16">Icon (iconc 9.4.3)</option>
				    <option value="9">Intercal (c-intercal 28.0-r1)</option>
				    <option value="10">Java (sun-jdk-1.6.0.17)</option>
                    <option value="55">Java7 (sun-jdk-1.7.0_03)</option>
				    <option value="35">JavaScript (rhino) (rhino-1.6.5)</option>
				    <option value="112">JavaScript (spidermonkey) (spidermonkey-1.7)</option>
				    <option value="26">Lua (luac 5.1.4)</option>
				    <option value="30">Nemerle (ncc 0.9.3)</option>
				    <option value="25">Nice (nicec 0.9.6)</option>
				    <option value="122">Nimrod (nimrod-0.8.8)</option>
				    <option value="43">Objective-C (gcc-4.5.1)</option>
				    <option value="8">Ocaml (ocamlopt 3.10.2)</option>
                    <option value="119">Oz (mozart-1.4.0)</option>
				    <option value="22">Pascal (fpc) (fpc 2.2.0)</option>
				    <option value="2">Pascal (gpc) (gpc 20070904)</option>
				    <option value="3">Perl (perl 5.12.1)</option>
				    <option value="54">Perl 6 (rakudo-2010.08)</option>
				    <option value="29">PHP (php 5.2.11)</option>
				    <option value="19">Pike (pike 7.6.86)</option>
				    <option value="108">Prolog (gnu) (gprolog-1.3.1)</option>
				    <option value="15">Prolog (swi) (swipl 5.6.64)</option>
				    <option value="4">Python (python 2.6.4)</option>
				    <option value="116">Python 3 (python-3.1.2)</option>
				    <option value="117">R (R-2.11.1)</option>
				    <option value="17">Ruby (ruby-1.9.2)</option>
				    <option value="39">Scala (scala-2.8.0.final)</option>
				    <option value="33">Scheme (guile) (guile 1.8.5)</option>
				    <option value="23">Smalltalk (gst 3.1)</option>
				    <option value="40">SQL (sqlite3-3.7.3)</option>
				    <option value="38">Tcl (tclsh 8.5.7)</option>
				    <option value="62">Text (text 6.10)</option>
				    <option value="115">Unlambda (unlambda-2.0.0)</option>
				    <option value="101">Visual Basic .NET (mono-2.4.2.3)</option>
				    <option value="6">Whitespace (wspace 0.3)</option>
</select><input name="pid" value="<? echo $_POST['pid'];?>"/>
<input type="submit" name="submit2" value="Compile & Run" /> <?php 
$sql="SELECT `poj_uid`,`poj_pwd` FROM `users` WHERE `user_id`='".$_SESSION['user_id']."'";
$result=mysql_query($sql);
$rowsx=mysql_fetch_array($result);
$uid=$rowsx[0];
$pwd=$rowsx[1];
if ($uid=="!") $uud='关联 <a href="./preferences">Ideone 账户</a> &copy;';
else $uud='使用账户 '.$uid; echo $uud;
?>   </div>
<div class="well">
<textarea class="span12" name="source" rows=18 id="source" style="font-family:Courier New;"><?php if(!empty($_POST['source'])) 
echo $_POST['source'];				  				  
else echo("");
?>
</textarea>
</div>
<div class="row-fluid">
<div class="span4">
<h2>stdin</h2>
<div class="well">
<textarea class="span12" name="input" rows=10 id="input"><?php if(!empty($_POST['input']))echo $_POST['input'];?></textarea>
</div>  
</div>  
<div class="span4">
<h2>stdout</h2>
<div class="well">
<textarea class="span12" name="output" rows=10 id="output" disabled="true">
<?php
if(!empty($_POST['source'])) 
{ 

if($uid=='!')
{
   $user = 'pubwetta'; //--> API username
   $pass = 'openoj'; //--> API password
}
else
{
   $user = $uid; //--> API username
   $pass = $pwd; //--> API password
}
$lang = $_POST['lang']; //--> Source Language Code; Here is 1 => C++
 
$code = $_POST['source']; //--> Source Code
$input = $_POST['input'];

$run = true;
$private = false;
 
//create new SoapClient
$client = new SoapClient( "http://ideone.com/api/1/service.wsdl" );

//create new submission
$result = $client->createSubmission( $user, $pass, $code, $lang, $input, $run, $private );
 
//if submission is OK, POST the status
if ( $result['error'] == 'OK' ) {
 
    $status = $client->getSubmissionStatus( $user, $pass, $result['link'] );
 
    if ( $status['error'] == 'OK' ) {
 
        //check if the status is 0, otherwise getSubmissionStatus again
        while ( $status['status'] != 0 ) {
            sleep( 3 ); //sleep 3 seconds
            $status = $client->getSubmissionStatus( $user, $pass, $result['link'] );
        }
 
        //finally POST the submission results
        $details = $client->getSubmissionDetails( $user, $pass, $result['link'], true, true, true, true, true );
        if ( $details['error'] == 'OK' ) {
            echo $details['output'];
		echo ($details['cmpinfo']); 
        } else {
            //we got some error
            echo($details['output']);
		echo ($details['cmpinfo']);
        }
    } else {
        //we got some error
        var_dump( $status );
    }
} else {
    //we got some error
     var_dump( $result );
}
}
?>
</textarea>
</div>  
</div>  
<div class="span4">
<h2>stderr</h2>
<div class="well">
<textarea class="span12" name="output" rows=10 id="output" disabled="true">
<?php
    echo $details['stderr'];
?>
</textarea>
</div>  
</div>  
</div>  

				<!--input type="submit" name="submit" value="Run it now!" /-->
			
	</div>
  </form>
</body>

</html>

<?php // contest_id

if ($_POST['input']){
$pid = $_POST['pid'];

$basedir = "$OJ_DATA/$pid";
echo $basedir;
$name=substr(md5($_POST['input']),6,6);
echo $name;

$fp=@fopen($basedir."/$name.in","w");
@fputs($fp,str_replace("\r\n","\n",$_POST['input']));
@fclose($fp);
$fp=@fopen($basedir."/$name.out","w");
@fputs($fp,str_replace("\r\n","\n",$details['output']));
@fclose($fp);
}
    require_once ("./oj-footer.php");

    if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
