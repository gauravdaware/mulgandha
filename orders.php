<?php
/*  Author: Gaurav Daware
	Purpose: Displaying User's all Orders
	Created on: 01-08-2018
	Updated on: 
*/
session_start();
require_once("includes/constants.php");
if(empty($_SESSION['user_id'])){
	header('location:index.php');
}
$uid = $_SESSION['user_id'];
extract($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>My Orders</title>
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


<!--Header-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">My Orders</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td>Order Date</td>
							
							<td>Order Status</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php

						$sql_order_info = "select o.*, c.prod_id,p.prod_name,p.prod_code,p.prod_sp,p.prod_image from fk_orders_tbl o inner join fk_cart_tbl c on o.order_id = c.order_id inner join fk_products_tbl p on c.prod_id = p.prod_id where o.user_id=$uid and (o.order_status=1 or o.order_status = 2 or o.order_status=3) order by o.order_id desc";
						
						$order_res=mysqli_query($con,$sql_order_info);
						
						$count=mysqli_num_rows($order_res);
						if($count>0){
						while($prow=mysqli_fetch_assoc($order_res)){
						?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="uploads/products/<?php echo $prow['prod_image'];?>" alt="" style="width:110px; height:110px; border-radius:10px"></a>
							</td>
							<td class="cart_description">
								<h4 style="margin-left:100px;"><a href=""><?php echo ucwords($prow['prod_name']);?></a></h4>
								<p style="margin-left:100px;">Product Code: <?php echo strtoupper($prow['prod_code']);?></p>
							</td>
							<td class="">
								<p><?php echo date('d/m/Y h:i A' ,strtotime($prow['order_date'])); ?></p>
							</td>
							
							<td style="color:red;"><?php if((($prow['order_status'] == 2)&&($prow['order_cancel_status'] == 1))||($prow['order_cancel_status'] == 1)){echo "Order Canceled";}else if(($prow['order_status'] == 2)){echo "Requested for Cancel";} else {echo "Pending";} ?></td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $prow['total_quantity'];?>" autocomplete="off" size="2">
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Rs.<?php echo $prow['total_amount'];?></p>
								
								
							</td>
							<td class="cart_delete">
							<?php if($prow['order_status'] == 1 || $prow['order_status'] == 3){?>
								<a class="cart_quantity_delete" onclick="return confirm('Are you sure to delete?')" href="cancel_order.php?oid=<?php echo $prow['order_id']; ?>"><i class="fa fa-times"></i> </a>
							<?php }?>
							</td>
						</tr>
						<?php
							}
						}
						else{	
						?>
						<tr><td colspan="5" align="center" style="color:red;"><strong>You Don't have any Order.</strong></td></tr>
						<?php
						}
											
					?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<!--/#do_action-->
<!--footer-->
<?php
require_once(FOOTER);
?>
<!--/footer-->


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>