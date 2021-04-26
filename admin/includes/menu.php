<!-- /#left-panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Main Content</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Categories</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="addnewcategory.php">Add Category</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="managecategories.php">Manage Categories</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="trash_managecategories.php">Trash</a></li>
							</ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Subcategories</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="addnewsubcategory.php">Add Subcategory</a></li>
                            <li><i class="fa fa-table"></i><a href="managesubcategories.php">Manage Subcategories</a></li>
							<li><i class="fa fa-table"></i><a href="trash_managesubcategories.php">Trash</a></li>
						</ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Products</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="addnewproduct.php	">Add Product</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="manageproducts.php">Manage Products</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="trash_manageproducts.php">Trash</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Slider</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="addnewslider.php">Add Slider</a></li>
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="manageslider.php">Manage Slider</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i><a href="trash_manageslider.php">Trash</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Coupons</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="addnewcoupon.php">Add Coupon</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="managecoupons.php">Manage Coupons</a></li>
							<li><i class="menu-icon fa fa-pie-chart"></i><a href="trash_managecoupons.php">Trash</a></li>
						</ul>
                    </li>
					<h3 class="menu-title">User Content</h3>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>User Orders</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="neworders.php	">New Orders</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="#">Delivered Orders</a></li>
							<li><i class="menu-icon fa fa-th"></i><a href="#">Cancelled Orders</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Reviews</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="manage_reviews.php	">Manage Reviews</a></li>
                        </ul>
                    </li>
					<h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Setting</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="changepassword.php">Change Password</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
					</ul>
					
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
	<!-- /#left-panel -->