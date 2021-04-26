<?php
/*  Author: Gaurav Daware
	Purpose: Displaying User's all Orders
	Created on: 27-08-2018
	Updated on: 
*/
require_once("includes/constants.php");
session_start();
if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
extract($_POST);
$uid = $_SESSION['user_id'];
if(isset($cancel)){
	if(!empty($reason)){
		require_once DB_PATH;
		require_once VALIDATE;
		$oid = $_GET['oid'];
		$sql_reason_update = "update fk_orders_tbl set order_status = 2, order_cancel_reason = '".format_str($reason)."' where order_id = $oid";
		$res_update = mysqli_query($con,$sql_reason_update);
		if($res_update)
			$succ_msg = "Requested For Cancelation";
		else
			$err_msg = "Somthing Went Wrong";
	}
	else
		$err_msg = "Please Provide Cancelation Reason.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cancel Order</title>
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
				  <li class="active">Cancel Order</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Cancel Reason</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<!--<div class="col-sm-3">
						
					</div>-->
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>How can we improve service</p>
							<div class="form">
							<form method="post" action="" style="padding-bottom: 100px;" onsubmit="return validate_reason()">
								<p style="color:green"><?php if(isset($succ_msg)){echo $succ_msg;} ?></p>
								<p style="color:red"><?php if(isset($err_msg)){echo $err_msg;} ?></p>
								<textarea  placeholder="Reason*" name="reason" rows="4"></textarea>
									<p></p>
								<input class="btn btn-default get" type="submit" name="cancel" value="Requested For Cancelation"/>
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