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
if(isset($submit)){
	$_SESSION['bill_name'] = $name;
	$_SESSION['bill_email'] = $email;
	$_SESSION['bill_mobile'] = $mobile;
	require_once DB_PATH;
	require_once VALIDATE;
	$cart_info_sql = "select sum(quantity) as qty, sum(total) as total from fk_cart_tbl where user_id = $uid and cart_status=0";
	$cart_info_result = mysqli_query($con,$cart_info_sql) or die(mysqli_error($con));
	$cart_info_row = mysqli_fetch_assoc($cart_info_result);
	$qty = $cart_info_row['qty'];
	$subtotal = $cart_info_row['total'];
	if(isset($_SESSION['coupon_discount'])){
		$disc_amt = $_SESSION['coupon_discount'];
	}
	else{
		$disc_amt = 0;
	}
	$total_amt = $subtotal - $disc_amt;
	$_SESSION['amount'] = $total_amt;
	$order_date = date('Y-m-d H:i:s');
	$insert_order_info_sql = "insert into fk_orders_tbl (user_id, total_quantity, subtotal_amount, discount_amount, total_amount, order_date) values ($uid,$qty,$subtotal,$disc_amt,$total_amt,'$order_date')";
	$order_info_res = mysqli_query($con,$insert_order_info_sql) or die(mysqli_error($con));
	if ($order_info_res){
		$order_id = mysqli_insert_id($con);
		$shipping_info_sql = "insert into fk_shipping_tbl (order_id,ship_name,ship_email,ship_mobile,ship_alter_mobile,ship_address,ship_landmark,ship_pincode) values ('$order_id','$name','$email','$mobile','$alter_mobile','$address','$landmark',$pincode)";
		$result_ship_info = mysqli_query($con,$shipping_info_sql) or die(mysqli_error($con));
		if($result_ship_info){
			$_SESSION['order_id'] = $order_id;
			header('location:payment.php');
		}
		else
			echo "order failed";
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
				<h2 class="heading">Shipping Details</h2>
			</div>
			
			<div class="shopper-informations">
				<div class="row">
					<!--<div class="col-sm-3">
						
					</div>-->
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Billing Details</p>
							<div class="form-one">
							<form method="post" action="" style="padding-bottom: 100px;" onsubmit="return validate_billing()">
									<input type="text" placeholder="Name" name="name" value="<?php if(isset($_COOKIE['name'])){echo $_COOKIE['name'];}?>">
									<input type="text" placeholder="Email*" name="email" value="<?php if(isset($_COOKIE['user_email'])){echo $_COOKIE['user_email'];}?>">
									<input type="text" placeholder="Mobile*" name="mobile" value="<?php if(isset($_COOKIE['mobile'])){echo $_COOKIE['mobile'];}?>">
									<input type="text" placeholder="Alternate Mobile" name="alter_mobile">
							</div>
							<div class="form-two">
									<textarea name="address"  placeholder="Address*" name="address" rows="4"></textarea>
									<p></p>
									<input type="text" placeholder="Landmark" name="landmark" style="background: #F0F0E9; border: 0 none; margin-bottom: 10px; padding: 10px; width: 100%; font-weight: 300;">
									<input type="text" placeholder="Zip / Postal Code *" name="pincode" style="background: #F0F0E9; border: 0 none; margin-bottom: 10px; padding: 10px; width: 100%; font-weight: 300;">
									<input class="btn btn-default get" type="submit" name="submit" value="Proceed For Payment"/>
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