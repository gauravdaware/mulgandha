<?php
/*  Author: Gaurav Daware
	Purpose: Edit User Information
	Created on: 09-08-2018
	Updated on: 
*/
require_once("includes/constants.php");
session_start();
if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
extract($_POST);
if(isset($update)){
	if((!empty($name))&&(!empty($mobile))){
	require_once DB_PATH;
	require_once VALIDATE;
	$uid = $_SESSION['user_id'];
	$sql_info_update = "update fk_usersignup_tbl set user_name = '".format_str($name)."', user_mobile = '".format_str($mobile)."' where user_id = $uid";
	$res_update = mysqli_query($con,$sql_info_update);
	if($res_update){
		$get_info = "select user_name,user_mobile from fk_usersignup_tbl where user_id = $uid";
		$res_info=mysqli_query($con,$get_info);
		$row_info = mysqli_fetch_assoc($res_info);
		setcookie("name",$row_info['user_name'],time()+(24*3600));
		setcookie("mobile",$row_info['user_mobile'],time()+(24*3600));
		$_SESSION['name'] = $name;
		header('location:user_info.php');
	}
	else
		$err_msg = "Not updated";
	}
	else
		$err_msg = "Data missing";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Profile</title>	
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
	<?php require_once HEAD;?>
	<!--/header-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Edit Profile</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?> Profile</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<!--<div class="col-sm-3">
						
					</div>-->
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Personal Information</p>
							<div class="form-one">
							<p><?php if(isset($err_msg)){echo $err_msg;} ?></p>
							<form method="post" action="" style="padding-bottom: 100px;" onsubmit="return validate_billing()">
									<input type="text" placeholder="Name" name="name" value="">
									<input type="text" disabled placeholder="Email*" name="" value="<?php if(isset($_COOKIE['user_email'])){echo $_COOKIE['user_email'];}?>">
									<input type="text" placeholder="Mobile*" name="mobile" value="">
							</div>
							<div class="form-two">	
									<input style="margin-top:150px;" class="btn btn-default get" type="submit" name="update" value="Update Information"/>
							</form>	
							</div>
							<!--<div class="form-two">
									<input class="btn btn-default get" type="submit" name="submit" value="Proceed For Payment"/>
							</div>-->
													
						</div>
					</div>
					<div class="col-sm-4">
						
					</div>					
				</div>
			</div>
			
	</section> <!--/#cart_items-->

	
<!--Footer-->
<?php require_once FOOTER;?>
<!--/Footer-->
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>