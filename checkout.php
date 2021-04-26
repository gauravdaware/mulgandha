<?php
/*  Author: Gaurav Daware
	Purpose: calculating total cart price and coupons discount
	Created on: 26-07-2018
	Updated on: 29-07-2018
*/
require_once("includes/constants.php");
session_start();
if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
$uid = $_SESSION['user_id'];
//print_r($_SESSION);
extract($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Check Out</title>
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
<!--Header-->
<?php require_once(HEAD);
	  require_once(VALIDATE);	
 ?>
<?php
if(isset($apply)){
	$sql_coupon_chk="select coupon_code,coupon_worth,coupon_type,coupon_status from fk_coupons_tbl where coupon_code='".format_str($coupon)."' and coupon_status=1";
	$result_coupon = mysqli_query($con,$sql_coupon_chk) or die(mysqli_error($con));
	$coupon_count = mysqli_num_rows($result_coupon);
	if($coupon_count==1){
		$coupon_row = mysqli_fetch_assoc($result_coupon);
		if($coupon_row['coupon_type'] == "Rupees"){
			$_SESSION['coupon_discount']= $coupon_row['coupon_worth'];
			$_SESSION['coupon_code'] = $coupon_row['coupon_code'];
		}
		else{
			//getting total of all items bought by user
			$sql_total = "select sum(total) as subtotal from fk_cart_tbl where cart_status = 0 and user_id = $uid";
			$result_total = mysqli_query($con,$sql_total) or die(mysqli_error($con));;
			$row_total = mysqli_fetch_assoc($result_total);
			$subtotal = $row_total['subtotal'];
			$_SESSION['coupon_discount'] = ($subtotal * $coupon_row['coupon_worth'])/100;
			$_SESSION['coupon_code'] = $coupon_row['coupon_code'];
		}
	}
	else
		$err_coupon = "Invalid Coupon Code";
}
?>

<!--Header-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php

						$sql_cart_info="select c.prod_id, p.prod_image,p.prod_name,p.prod_code,c.cart_id,c.quantity,c.selling_price,c.shipping_charge,c.total from fk_products_tbl p inner join fk_cart_tbl c on c.prod_id=p.prod_id where user_id = $uid and cart_status = 0";
						
						$cartres=mysqli_query($con,$sql_cart_info);
						
						$count=mysqli_num_rows($cartres);
						if($count>0){
							$total=0;
							$ship=0;
							$sellingPrice=0;
						while($prow=mysqli_fetch_assoc($cartres)){
							$total = $total+$prow['total'];
							$sellingPrice =$sellingPrice + ($prow['quantity'] * $prow['selling_price']); 
							$ship = $ship + ($prow['quantity'] * $prow['shipping_charge']);
						?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="uploads/products/<?php echo $prow['prod_image'];?>" alt="" style="width:110px; height:110px; border-radius:10px"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo ucwords($prow['prod_name']);?></a></h4>
								<p>Product Code: <?php echo strtoupper($prow['prod_code']);?></p>
							</td>
							<td class="cart_price">
								<p>Rs.<?php echo $prow['selling_price'];?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="increase_cart_qty.php?cart_id=<?php echo $prow['cart_id'];?>&prod_id=<?php echo $prow['prod_id'];?>"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $prow['quantity'];?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="decrease_cart_qty.php?cart_id=<?php echo $prow['cart_id'];?>"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rs.<?php echo $prow['total'];?></p>
								
								
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" onclick="return confirm('Are you sure to delete?')" href="delete_cart.php?cid=<?php echo $prow['cart_id'];?>"><i class="fa fa-times"></i> </a>
							</td>
						</tr>
						<?php
							}
						}
						else{	
						?>
						<tr><td colspan="5" align="center" style="color:red;"><strong>Your cart is empty</strong></td></tr>
						<?php
						}
											
					?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
<?php if ($count> 0) {?>
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option" style="list-style-type:circle">
						<?php 
						$sql_coupon = "select coupon_code from fk_coupons_tbl where coupon_status=1 and trash=0";
						$result_coupon = mysqli_query($con,$sql_coupon);
						$count = mysqli_num_rows($result_coupon);
						if($count>0){
							while($crow = mysqli_fetch_assoc($result_coupon)){
						?>
							<li><strong style="font-size:18px;">*</strong><label><?php echo $crow['coupon_code']; ?></label></li>
							<?php
							}
						}
						?>
						</ul>
						<form action="" method="post">
						<span><?php if(isset($err_coupon)){echo $err_coupon;} ?></span>
						<ul class="user_info">
							<p style="color:red;"><?php if(isset($err_coupon)){echo $err_coupon;}?></p>
							<li class="single_field zip-field">
								<label>Coupon:</label>
								
								<input type="text" name="coupon" value="<?php if(isset($_SESSION['coupon_code'])){echo $_SESSION['coupon_code'];}?>">
							</li>
						<li><br/><button type="submit" name="apply" class="btn btn-default pull-right" style="margin-top:8px;padding-left:15px;padding-right:15px;color:#fff;background-color:#fe980f;border:0;">Apply</button></li>
						</ul>
						</form>
						<!--<a class="btn btn-default update" href="">Apply</a>
						<a style="margin-left:130px;" class="btn btn-default check_out" href="">Apply</a>
						-->
					
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					
						<ul>
							<li>Total Selling Price<span>Rs. <?php if(!empty($sellingPrice)){echo $sellingPrice;}else{echo "0";} ?></span></li>
							<li>GST <span>Rs. 0</span></li>
							<li>Total Shipping Cost <span>Rs. <?php if(!empty($ship)){echo $ship;}else{echo "0";} ?></span></li>
							<li>Total <span>Rs. <?php if(!empty($total)){echo $total;}else{echo "0";} ?></span></li>
							<li>Coupon Discount <span>Rs. <?php if(isset($_SESSION['coupon_discount'])){echo $_SESSION['coupon_discount'];}else{echo "0";}?></span></li>
							<li>Payable Amount <span>Rs. <?php if((!empty($total))&&(!empty($_SESSION['coupon_discount']))){echo ($_SESSION['amount'] =$total - $_SESSION['coupon_discount']);}else if(!empty($total)){echo $total;}else{echo "0";} ?></span></li>
							<a style="margin-left:0;margin-top:30px;" class="btn btn-default check_out" href="shipping.php">Proceed</a>
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</section>!--/#do_action-->
<?php  }?>
<!--footer-->
<?php
require_once("includes/footer.php");
print_r($_SESSION);

?>
<!--/footer-->


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	
</body>
</html>