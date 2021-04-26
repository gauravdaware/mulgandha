<?php
/*  Author: Gaurav Daware
	Purpose: updating	Created on: 30-07-2018
	Updated on: 
*/
use Razorpay\Api\Api;
require_once("includes/constants.php");
	session_start();
	
	if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
	extract($_POST);
	
	//require_once "includes/validate_str.php";
	$order_id = $_SESSION['order_id'];
	$user_id = $_SESSION['user_id'];
	$name = $_SESSION['name'];
	$amount = $_SESSION['amount'] * 100;
	if(isset($place_order)){
		require_once DB_PATH;
		if($payment_type == "cod"){
			//Code for Cash on Delivery payment.
			$sql_update_cart = "update fk_cart_tbl set cart_status = 1, order_id = $order_id where user_id = $user_id and cart_status = 0";
			$cart_result=mysqli_query($con, $sql_update_cart) or die(mysqli_error($con));
			if($cart_result){
				$sql_order_update="update fk_orders_tbl set order_status = 1, payment_type = '$payment_type' where user_id = $user_id and order_status = 0 and order_id = $order_id";
				$order_result=mysqli_query($con, $sql_order_update) or die(mysqli_error($con));
				if($order_result)
					header('location:success.php');
				}
		}
		else if($payment_type == "online"){
			require_once 'razorpay-php/Razorpay.php';

			$api_key	= 'rzp_test_QGRwxgRuHyqTN1';
			$api_secret = 'JgUvUttXYdBZ0RJC3zeMKkr7';
			$api = new Api($api_key, $api_secret);
			
			//Code for online payment.
			header('location:pay.php');
		}
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
<style type="text/css">
	table{
		width: 400px;
	}
	td{
		/*border: 1px solid;*/
		width: 400px;
		text-align: left;
		padding: 10px;
	}
</style>
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
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Payment Type</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<!--<div class="col-sm-3">
						
					</div>-->
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							
							<div class="form-one">
							
									
							</div>
				<div class="form-two">
					<form method="post" action="" style="padding-bottom: 100px;">
					<table>
						<tr>
							<td><input type="radio" name="payment_type" value="cod" checked="true">Cash On Delivery(COD)</td>
							<td><input type="radio" name="payment_type" value="online">Online Payment</td>
						</tr>
						<tr>
							<td><input class="btn btn-default get" type="submit" name="place_order" value="Place Order"/></td>
						</tr>	
					</table>
				</form>
				</div>
															
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

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
