<?php
/*
Author: Gaurav Daware
created on :20-07-2018
*/
require_once("includes/constants.php");
session_start();

//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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
	<?php require_once HEAD; 
			
	      require_once FUNCTIONS;
	?>
	<!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
				<?php 
                $slider_qry= get_slider();
                if(mysqli_num_rows($slider_qry))
                {  
					$count=mysqli_num_rows($slider_qry);
				?>
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					
						<ol class="carousel-indicators">
						<?php
                     for($i=0;$i<$count;$i++){
                     	if($i==0){
							?>
                     		<li data-target="#slider-carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
							<?php
                     	}
                     		else{
								?>
                     		<li data-target="#slider-carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
							<?php
                     	}
                     }
					?>	
							
						</ol>
						
						<div class="carousel-inner">
						<?php
						$check=0	;
						while($slider_row=mysqli_fetch_assoc($slider_qry)){
						$check=$check+1;
					    if($check==1){
							?>
					    	<div class="item active">
					    <?php
						}
					    else{
							?>
					    	<div class="item">
							<?php
					    }
						?>
							
								<div class="col-sm-6">
								<h1><?php echo $slider_row['slider_title'];?></h1>
								<h2><?php echo $slider_row['slider_title'];?></h2>
                                <p> <?php echo $slider_row['slider_discription'];?></p>
								</div>
								
									<img style="height:420px;width:480px" src="uploads/slider/<?php echo $slider_row['slider_image'];?>" class="girl img-responsive" />
								
							</div>
							<?php } ?>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				<?php
				}	 
				?> 	
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<!--left-sidebar-->
				<?php require_once(SIDEBAR);?>
				<!--/left-sidebar-->
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Best Offer Products</h2>
						<?php 
						$bop_prod_result = get_products();
						$count = mysqli_num_rows($bop_prod_result);
						if($count>0){
							
							while($prow=mysqli_fetch_assoc($bop_prod_result)){
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img style="height:230px;width:226px;" src="uploads/products/<?php echo $prow['prod_image'];?>" alt="" />
											<h2>Rs.<?php echo $prow['prod_sp']?></h2>
											<p><?php echo ucwords($prow['prod_name'])?></p>
											<a href="product_details.php?pid=<?php echo base64_encode($prow['prod_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<!--<div class="product-overlay">
											<div class="overlay-content">
												<h2>Rs.<?php// echo $prow['prod_sp']?></h2>
												<p><?php //echo ucwords($prow['prod_name'])?></p>
												<a href="product_details.php?pid=<?php //echo base64_encode($prow['prod_id']);?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>-->
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
									
										<li><a href="addtowishlist.php?pid=<?php echo base64_encode($prow['prod_id']);?>"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										
									
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
							}
						}
						?>
						
					</div><!--features_items-->
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="">
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="">
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="">
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="">
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="">
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="">
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div>
					
				</div>

					
					<!--/recommended_items-->
					
					
				</div>
			</div>
		</div>
	</section>
	
	
	<!--Footer-->
	<?php require_once FOOTER; ?>
	<!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>