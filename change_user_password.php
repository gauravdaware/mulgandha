<?php
/*  Author: Gaurav Daware
	Purpose: Displaying User's all Orders
	Created on: 01-08-2018
	Updated on: 
*/
require_once("includes/constants.php");
session_start();
if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
extract($_POST);
if(isset($update))
{
	$uid=$_SESSION['user_id'];
	require_once DB_PATH;
	require_once VALIDATE;
	$o_pass=md5(format_str($o_pass));
	$sql_chk="select user_password from fk_usersignup_tbl where user_id='$uid' and user_password='$o_pass'";
	$res=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		if($n_pass==$c_pass)
		{
			$n_pass=md5($n_pass);
			$sql_update="update fk_usersignup_tbl set user_password='$n_pass' where user_id='$uid'";
			$msg=mysqli_query($con,$sql_update);
			if($msg)
			$suc_msg="Password has been changed";
			else
			$err_msg="Password not changed";
		}
		else
		$err_msg="Confirm password doesn't match";
	}
	else
	$err_msg="Old password not matching";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shipping</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<!--header-->
	<?php require_once "includes/header.php";?>
	<!--/header-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Change Password</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<!--<div class="col-sm-3">
						
					</div>-->
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p style="color:green;"><?php if(isset($suc_msg)){echo $suc_msg;}?></p>
							<p style="color:red;"><?php if(isset($err_msg)){echo $err_msg;}?></p>
							<form method="post" action="" onsubmit="return validate_change_password()">
							<div class="form-one" style="width:20px;height:400px;">
							</div>
							<div class="form-two">
									<input type="password" placeholder="Old Password" id="o_pass" name="o_pass" style="background: #F0F0E9; border: 0 none; margin-bottom: 10px; padding: 10px; width: 100%; font-weight: 300;">
									<span id="o_err"></span>
									<p></p>
									<p></p>
									<input type="password" placeholder="New Password" id="n_pass" name="n_pass" style="background: #F0F0E9; border: 0 none; margin-bottom: 10px; padding: 10px; width: 100%; font-weight: 300;">
									<span id="n_err"></span>
									<input type="password" placeholder="Confirm Password" id="c_pass" name="c_pass" style="background: #F0F0E9; border: 0 none; margin-bottom: 10px; padding: 10px; width: 100%; font-weight: 300;">
									<span id="c_err"></span>
									<p></p>
									<input class="btn btn-default get" type="submit" name="update" value="Update"/>
							</div>
							</form>							
						</div>
					</div>
					
					<div class="col-sm-4">
						
					</div>		
					
				</div>
				
			</div>
			
	</section> <!--/#cart_items-->

	
<!--Footer-->
<?php require_once "includes/footer.php";?>
<!--/Footer-->
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<script>
function validate_change_password(){
	var str=true;
	var oldPass=document.getElementById('o_pass').value;
	var newPass=document.getElementById('n_pass').value;
	var confirmPass= document.getElementById('c_pass').value;
	if(oldPass==""){
		str=false;
		document.getElementById('o_err').innerHTML="Please enter Old Password";
		document.getElementById('o_pass').style.border="1px solid red";
	}
	else{
		document.getElementById('o_err').innerHTML="";
		document.getElementById('o_pass').style.border="";
	}
	if(newPass=="")
	{
		str=false;
		document.getElementById('n_err').innerHTML="Cannot Be Blank";
		document.getElementById('n_pass').style.border="1px solid red";
	}
	else{
		document.getElementById('n_err').innerHTML="";
		document.getElementById('n_pass').style.border="";
	}
	if(confirmPass=="")
	{
		str=false;
		document.getElementById('c_err').innerHTML="Cannot Be Blank";
		document.getElementById('c_pass').style.border="1px solid red";
	}
	else{
		document.getElementById('c_err').innerHTML="";
		document.getElementById('c_pass').style.border="";
	}
	return str;
	
}
</script>