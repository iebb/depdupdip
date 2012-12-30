<!DOCTYPE html>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $view_title?></title>
       <link href="http://wetta.in/css.css" rel="stylesheet" type="text/css">   
		    <script src="jquery-1.7.1.min.js"></script><style type="text/css"></style>
    <script src="bootstrap.min.js"></script>
</head>
<?php require_once("oj-header.php");?>


<body class="sign">
<div id="wrapper">
        
<center>
<h2><span style="color:#8888FF"> This Login Form is Deprecated now. </span></h2><br />
<h3><span style="color:#8888FF"> The new one is on the left sidebar >_< . </span></h3><br /></center>
		


    <div id="logo">
        <span class="logo" style="color:#8888FF;" >Wetta</span>
        <div class="subtitle">Online Judge</div>
    </div>
<div class="signform">

<form class="form-inline" action=login.php method=post>
<div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span>
            <input type="input" placeholder="USERNAME" name="user_id" />
        </div>
        <div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
            <input type="password" placeholder="PASSWORD" name="password" />
        </div>
        <div class="input-prepend">
            <button type="submit" class="btn btn-info">Log Me In</button>
        </div>
		
        <div class="input-prepend">
            <a href="signup" class="btn">Sign Up for an Account</a>
        </div>
		
		<div class="input-prepend">
            <a href="lost-pw" class="btn">I've Forgot My Password</a>
        </div>
    </form>
    
</div>
<div id=foot>
        <?php require_once("oj-footer.php");?>

</div>
</div>



</body>
</html>

