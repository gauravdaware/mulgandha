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


<!--Header-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">My Wishlist</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Selling Price</td>
							<td class="total">MRP</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
						
						$sql_wish_info="select w.wishlist_id,p.prod_name,p.prod_mrp,p.prod_image,p.prod_sp,p.prod_code,p.prod_id from fk_products_tbl p inner join fk_wishlist_tbl w on p.prod_id = w.prod_id where w.user_id = $uid";
						
						$wishres=mysqli_query($con,$sql_wish_info);
						
						$count=mysqli_num_rows($wishres);
						if($count>0){
						while($wrow=mysqli_fetch_assoc($wishres)){
						
						?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="uploads/products/<?php echo $wrow['prod_image'];?>" alt="" style="width:110px; height:110px; border-radius:10px"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo ucwords($wrow['prod_name']);?></a></h4>
								<p>Product Code: <?php echo strtoupper($wrow['prod_code']);?></p>
							</td>
							<td class="cart_price">
								<p>Rs.<?php echo $wrow['prod_sp'];?></p>
							</td>
							
							<td class="cart_total">
								<p class="cart_total_price">Rs.<?php echo $wrow['prod_mrp'];?></p>
								
								
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" onclick="return confirm('Are you sure to delete?')" href="delete_wishlist.php?wid=<?php echo base64_encode($wrow['wishlist_id']);?>"><i class="fa fa-times"></i> </a>
							</td>
						</tr>
						<?php
							}
						}
						else{	
						?>
						<tr><td colspan="5" align="center" style="color:red;"><strong>You Wishlist is empty...!</strong></td></tr>
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