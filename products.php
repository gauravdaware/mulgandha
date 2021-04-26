<?php
/*
	Author: Gaurav Daware
	Date Created:06-08-2018
	Date Updated:08-08-2018
*/
require_once("includes/constants.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
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
<?php require_once HEAD;?>
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<?php require_once SIDEBAR;?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
					<?php 
					require_once VALIDATE;
					$sid = base64_decode(format_str($_GET['sid']));
					require_once DB_PATH;
					$sql_subcat_prod = "select p.prod_id,p.prod_name,p.prod_image,p.prod_sp,s.sub_category_name,s.sub_category_id from fk_products_tbl p inner join fk_sub_categories_tbl s on s.sub_category_id = p.sub_category_id where s.sub_category_id=$sid";
					$res_subcat_prod = mysqli_query($con,$sql_subcat_prod);
					//$sub_cat = mysqli_fetch_assoc($res_subcat_prod);
					?>
						<h2 class="title text-center"><?php /*echo strtoupper($sub_cat['sub_category_name']);*/?></h2>
						<?php
						while($sub_cat_row = mysqli_fetch_assoc($res_subcat_prod)){
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img style="height:255px;width:237px;" src="uploads/products/<?php echo $sub_cat_row['prod_image'];?>" alt="" />
										<h2>Rs. <?php echo $sub_cat_row['prod_sp']; ?></h2>
										<p><?php echo $sub_cat_row['prod_name']; ?></p>
										<a href="product_details.php?pid=<?php echo base64_encode($sub_cat_row['prod_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<!--<div class="product-overlay">
										<div class="overlay-content">
											<h2>Rs. <?php //echo $sub_cat_row['prod_sp']; ?></h2>
											<p><?php// echo $sub_cat_row['prod_name']; ?></p>
											<a href="product_details.php?pid=<?php //echo base64_encode($sub_cat_row['prod_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>-->
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="addtowishlist.php?pid=<?php echo base64_encode($sub_cat_row['prod_id']);?>"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						
						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	<!--FOOTER-->
	<?php require_once FOOTER; ?>
	<!--FOOTER-->
  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>