<?php
/*
	Author: Gaurav Daware
	updated on: 20-07-2018
	purpose: creating dynamic header
*/
date_default_timezone_set('asia/kolkata');
require_once "includes/dbconnect.php";

?>
<script type="text/javascript" src="js/search.js"></script>
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +91 97667 60670</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> gaurav@mulgandha.in</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									INDIA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									INR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">							
								
								
								<?php
					if(empty($_SESSION['user_id']))
					{
					?>
					<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
					<?php					
					}
					else
					{
						?>
					<li><a href="user_info.php"><i class="fa fa-user"></i> <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];} ?></a></li>
					<li><a href="orders.php"><i class="fa fa-star"></i> My Orders</a></li>
					<li><a href="wishlist.php"><i class="fa fa-star"></i> My Wishlist</a></li>
					<li><a href="change_user_password.php"><i class="fa fa-star"></i> Change Password</a></li>
					<li><a href="checkout.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
					<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
						<?php
					}
					?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="#" class="active"></a></li>
								<li><a href="index.php" class="active">Home</a></li>
		<!-- while loop start-->
		<?php
		require_once "includes/functions.php";
		$result_category = get_categories();
		while($row=mysqli_fetch_assoc($result_category)){
		?>
								<li class="dropdown"><a href="#"><?php echo ucfirst(strtolower($row['category_name']));?><i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
									<!-- while loop start-->
									<?php
										
									$category_id=$row['category_id'];	
									$result_subcat = get_subcategories($category_id);
									
									while($scrow = mysqli_fetch_assoc($result_subcat)){
									?>
                                        <li><a href="products.php?sid=<?php echo base64_encode($scrow['sub_category_id']); ?>"><?php echo ucwords(strtolower($scrow['sub_category_name']))?></a></li>
									
									<?php
									}
									?><!-- while loop end-->
									</ul>
                                </li> 
			<?php
			}
			?>
							</ul>
		<!-- while loop end-->
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search" id="search" onkeyup="get_search_list(this.value);"/>
							<div style="border:1px solid white; width:152px;padding-top:1px;" id="result" style="background-color:white;"></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header>
		