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
	extract($_POST);
?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manage Products</title>
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
                        <h1>Manage Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Products</a></li>
                            <li class="active">Manage Products</li>
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
						<input type="text" name="searchstr" id="searchstr" placeholder="Search Category" style="width:400px;height:38px;border:1px solid gray;border-radius:10px;margin-left:10px;" />
						<button type="submit" name="search" class="btn btn-primary" value="Search" >Search</button>
						<button type="submit" name="active" value="active" class="btn btn-success" style="margin-left:300px">Active</button>
						<button type="submit" name="in_active" value="in_active" class="btn btn-secondary">In-Active</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-danger">Delete</button>
					</form>
                        <div class="card-header">
                            <strong class="card-title">Manage Products</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col" >Product Code</th>
                                  <th scope="col">Product Name</th>
								  <th scope="col">Product Image</th>
                                  <th scope="col">Brand</th>		
								  <th scope="col">MRP</th>
								  <th scope="col">SP</th>
								  <th scope="col">Ship Charge</th>
								  <th scope="col">Stock</th>
								  <th scope="col">Added On</th>
								  <th scope="col">Status</th>
								  <th scope="col">Add Images</th>
								  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
					<?php
							if(isset($search)){
								$sql_qry="select * from fk_products_tbl where prod_name like '$searchstr%'";
							}
							else if(isset($delete)){
								$sql_qry = "select * from fk_products_tbl where trash = 1";
							}
							else
								$sql_qry="select * from fk_products_tbl where trash = 0";
							
						$result_set = mysqli_query($con,$sql_qry);
						$count = mysqli_num_rows($result_set);
						if($count>0){
                        $i=1;
						while($row = mysqli_fetch_assoc($result_set)){
					?>
						<tr>
							<th scope="row"><?php echo $i;?></th>
							<td><?php echo $row['prod_code'];?> </td>
							<td><?php echo $row['prod_name'];?> </td>
							
							<td>
								<img src="<?php echo '../uploads/products/'.$row['prod_image'];?>" border="1px solid" height="50px" width="90px" style="border-radius:10px; box-shadow: 0 0 5px black;">
							</td>
							
							<td><?php echo $row['prod_brand'];?> </td>
							<td><?php echo $row['prod_mrp'];?> </td>
							<td><?php echo $row['prod_sp'];?> </td>
							<td><?php echo $row['prod_shipping_charge'];?> </td>
							<td><?php echo $row['prod_stock'];?> </td>
							<td><?php echo $row['added_on'];?> </td>
							<td>
							<?php
							  if($row['prod_status']==1)
								  echo "<p style='color:green'>Active</p>";
							  else
								  echo "<p style='color:red'>In-Active</p>";
							  ?>
							</td>
							<td><a style="color:#5a3031;border-bottom:1px solid;" href="add_more_prodimages.php?pid=<?php echo $row['prod_id'];?>">Add Images</a></td>
							<td>
							  <?php
							  if($row['prod_status']==1)
							  {
							  ?>
							  <a style="color:orange;border-bottom:1px solid;" href="prod_action.php?asid=<?php echo $row['prod_id'];?>">In-Active</a>
							  <?php
							  }
							  else
							  {
								  ?>
									<a style="color:blue;border-bottom:1px solid;" href="prod_action.php?sid=<?php echo $row['prod_id'];?>">Active</a>
								  <?php
							  }
							  ?>
							  <a style="color:red;border-bottom:1px solid;" href="delete_products.php?sid=<?php echo $row['prod_id'];?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
							  </td>
                          </tr>							
						<?php
						$i++;
						}
						}
						else{
							
							  ?>
							<tr>
							<td colspan="7"><p style="color:red;text-align:center">No records found..!</p></td></tr>
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
