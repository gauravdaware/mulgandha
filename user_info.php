<?php
/*  Author: Gaurav Daware
	Purpose: Displaying User's information
	Created on: 09-08-2018
	Updated on: 
*/
require_once("includes/constants.php");
session_start();
if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?></title>
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
				  <li class="active"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?></li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?>' Profile<a style="float:right" href="user_info_edit.php">Edit</a></h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<!--<div class="col-sm-3">
						
					</div>-->
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Personal Information</p>
							<div class="form-one">
							<form method="post" action="" style="padding-bottom: 100px;" onsubmit="return validate_billing()">
									<input type="text" disabled placeholder="Name" name="name" value="<?php if(isset($_COOKIE['name'])){echo $_COOKIE['name'];}?>">
									<input type="text" disabled placeholder="Email*" name="email" value="<?php if(isset($_COOKIE['user_email'])){echo $_COOKIE['user_email'];}?>">
									<input type="text" disabled placeholder="Mobile*" name="mobile" value="<?php if(isset($_COOKIE['mobile'])){echo $_COOKIE['mobile'];}?>">
									
							</div>
							<div class="form-two">
									
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
<?php require_once FOOTER;?>
<!--/Footer-->
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>