<?php
/*
	Author: Gaurav Daware
	Created on:13:07:2018
	Purpose: To manage categories
*/
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}
	require_once "includes/dbconnect.php";
	require_once "includes/validate_str.php";
	//$oid = is_numeric(format_str($_GET['oid']));
?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Products</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/flag-icon.min.css">
    <link rel="stylesheet" href="css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<style>
th,td{
	text-align: left;
	
}
</style>
</head>
<body>
        <!-- Left Panel -->
<?php
		require_once("includes/menu.php");
		
?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php require_once("includes/header.php")?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>View Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">User Orders</a></li>
                            <li class="">Orders</li>
							<li class="active">View Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
					<form method="post" action="" style="background-color: #f7f7f7;">
						<input type="text" name="searchstr" id="searchstr" placeholder="Search Products" style="width:400px;height:38px;border:1px solid gray;border-radius:10px;margin-left:10px;" />
						<button type="submit" name="search" class="btn btn-primary" value="Search" >Search</button>
					</form>
                        <div class="card-header">
                            <strong class="card-title">Manage Products</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col" >Product Image</th>
                                  <th scope="col">Product Name</th>
								  <th scope="col">Selling Price</th>
								  <th scope="col">Quantity</th>
								  <th scope="col">Total Amount</th>
                              </tr>
                          </thead>
                          <tbody>
					<?php
							if(isset($search)){
								$sql_qry="select p.prod_image,p.prod_name,c.selling_price,c.quantity,c.total from fk_products_tbl p inner join fk_cart_tbl c on p.prod_id = c.prod_id where p.prod_name like '$searchstr%' and order_id = $oid";
							}
							else{
								$oid = format_str($_GET['oid']);
								$sql_qry="select p.prod_image,p.prod_name,c.selling_price,c.quantity,c.total from fk_products_tbl p inner join fk_cart_tbl c on p.prod_id = c.prod_id where order_id = $oid";
							}
						$result_set = mysqli_query($con,$sql_qry) or die(mysqli_error($con));
						$count = mysqli_num_rows($result_set);
						if($count>0){
                        $i=1;
						while($row = mysqli_fetch_assoc($result_set)){
					?>
						<tr>
							<th scope="row"><?php echo $i;?></th>
							<td>
								<img src="<?php echo '../uploads/products/'.$row['prod_image'];?>" border="1px solid" height="50px" width="90px" style="border-radius:10px; box-shadow: 0 0 5px black;">
							</td>
							<td><?php echo $row['prod_name'];?> </td>
							<td><?php echo $row['selling_price'];?> </td>
							<td><?php echo $row['quantity'];?> </td>
							<td><?php echo $row['total'];?> </td>
                          </tr>							
						<?php
						$i++;
						}
						}
						else{
							
							  ?>
							<tr>
							<td colspan="7"><p style="color:red;text-align:center">No Products found..!</p></td></tr>
							  <?php
						}
						?>
                      </tbody>
                  </table>
                        </div>
                    </div>
                </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="js/vendor/jquery-2.1.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>


</body>
</html>
