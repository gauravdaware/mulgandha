<?php
/*
	Author: Gaurav Daware
	Date Created:03-08-2018
	Date Updated:08-08-2018
	Purpose: To show product details,rating,user reviews.
*/
require_once("includes/constants.php");
session_start();

?>

<?php

extract($_POST);
if((isset($review))){
	if(empty($_SESSION['user_id'])){
		header('location:login.php');
	}
	require_once DB_PATH;
	require_once VALIDATE;
	$uid=$_SESSION['user_id'];
	$sql_rating_chk = "select * from fk_reviews_tbl where prod_id = $pid and user_id = $uid";
	$result_review_chk = mysqli_query($con,$sql_rating_chk);
	$count = mysqli_num_rows($result_review_chk);
	if($count==0){
		$uid = $_SESSION['user_id'];
		$review_date = date('Y-m-d');
		$review_time = date('H:i:s');
		$review_status = 1;
		$insert_review = "insert into fk_reviews_tbl (user_id,prod_id,review_date,review_time,review_description,ratings,review_status) values ($uid,$pid,'$review_date','$review_time','".format_str($review_disc)."','$rating',$review_status)";
		$result_review = mysqli_query($con,$insert_review);
	}
	else{
		$err_msg = "You already reviewed this product";
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
    <title>Product Details | E-Shopper</title>
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
	<!--/header-->
	<?php require_once HEAD;?>
	<!--/header-->
	
	<section>
		<div class="container">
			<div class="row">
				<!--left-sidebar-->
				<?php require_once(SIDEBAR);?>
				<!--/left-sidebar-->
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
							<?php
						if(isset($_GET['pid'])){
							$pid = base64_decode($_GET['pid']);
							}
							else{
							$pid = $pid;
						}
							//$prod_sql = "select * from fk_products_tbl where prod_id = $pid";
							$prod_sql ="select p.*, avg(r.ratings) as prod_avg_rating from fk_products_tbl p INNER JOIN fk_reviews_tbl r on p.prod_id = r.prod_id where p.prod_id = $pid";
							$prod_result = mysqli_query($con,$prod_sql);
							$pdrow = mysqli_fetch_assoc($prod_result);
							$average_rating = $pdrow['prod_avg_rating'];
							?>
								<img src="uploads/products/<?php echo $pdrow['prod_image']; ?>" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
									<?php 
									$sql_prod_image = "select prod_images from fk_products_images_tbl where prod_id = $pid";
									// $res_image = mysqli_query($con,$);
									?>
										<div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo ucwords($pdrow['prod_name']); ?></h2>
								<p><b>Product Code: </b><?php echo $pdrow['prod_code']; ?></p>
								<p style="color:#fe980f;font-size:20px;">Rating: <b style=""><?php echo round($average_rating,1);?></b></p>
								<span>
									<form action="addtocart.php" method="post">
									<span>Rs. <?php echo $pdrow['prod_sp']; ?></span>
									<label>Quantity:</label>
									<input type="text" value="1" name="qty"/>
									<input type="hidden" value="<?php echo $pdrow["prod_id"];?>" name="pid"/>
									<?php
									if(empty($_SESSION['user_id'])){
										?>
									<a href="login.php"><button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button></a>
									<?php
									}
									else{
									?>
									<button type="submit" name="add" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									<?php
									}
									?>
								</form>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> <?php echo $pdrow['prod_brand']; ?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
							<?php
							$sql_disc = "select prod_description, prod_features from fk_products_tbl where prod_id = $pid";
							$res_disc = mysqli_query($con,$sql_disc);
							$row_disc = mysqli_fetch_assoc($res_disc);
							?>
							<p><b>Features</b></p>
							<p><?php echo $row_disc['prod_features']; ?></p>
							<p><b>Description</b></p>
							<p><?php echo $row_disc['prod_description']; ?></p>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
								<?php 
								$sql_get_reviews = "select r.*, u.user_name from fk_reviews_tbl r inner join fk_usersignup_tbl u on r.user_id = u.user_id where prod_id = $pid and review_status = 1";
								$result_review = mysqli_query($con,$sql_get_reviews);
								$r_count = mysqli_num_rows($result_review);
								if($r_count>0){
								while($rrow = mysqli_fetch_assoc($result_review)){
								?>
									<ul>
										<li><a href=""><i class="fa fa-user"></i><?php echo $rrow['user_name']; ?></a></li>
										<li><a href=""><i class="fa fa-clock-o"></i><?php echo date('h:i A',(strtotime($rrow['review_time'])));?></a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i><?php  echo date('d M Y',(strtotime($rrow['review_date']))); ?></a></li>
										<li><a href=""><?php echo "Rating"." ".$rrow['ratings']; ?>/5</a></li>
									</ul>
									<p><?php echo $rrow['review_description']; ?></p>
									<?php
									
									}
								}
									?>
									<p><b>Write Your Review</b></p>
									<p style="color:red;"><?php if(isset($err_msg))echo $err_msg; ?></p>
									
									<form action="" method = "post">
										<textarea name="review_disc" ></textarea>
										<b>Rating: </b> 
										<select style="width:150px;" name = "rating">
											<option>Select Rating</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<input type="hidden" value="<?php echo $pdrow["prod_id"];?>" name="pid"/> 
										<button type="submit" name="review" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	<!--Footer-->
	<?php require_once "includes/footer.php";?>
	<!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>