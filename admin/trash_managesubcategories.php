<?php
/*
	Author: Gaurav Daware
	Created on:13:07:2018
	Purpose:To manage subcategories
*/
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}
	require_once "includes/dbconnect.php";
	extract($_POST);
	if(isset($search))
{
	$sql_qry="select s.*,c.category_name from fk_sub_categories_tbl s inner join fk_categories_tbl c on s.category_id=c.category_id  where s.sub_category_name like '$searchstr%' and s.trash=1";
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Remove Subcategories</title>
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
                        <h1>Remove Subcategories</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Subcategories</a></li>
                            <li class="active">Remove Subcategories</li>
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
						<input type="text" name="searchstr" id="searchstr" placeholder="Search Subcategory" style="width:400px;height:38px;border:1px solid gray;border-radius:10px;margin-left:10px;" />
						<button type="submit" name="search" class="btn btn-primary" value="Search" >Search</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-success" style="margin-left:300px">Active</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-secondary">In-Active</button>
						<button type="submit" name="delete" value="Delete" class="btn btn-danger">Delete</button>
					</form>
					
                        <div class="card-header">
                            <strong class="card-title">Trash Subcategories</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">#</th>
								  <th scope="col">Subcategory</th>
                                  <th scope="col">Category</th>
                                  <th scope="col">Priority</th>
                                  <th scope="col">Status</th>		
								  <th scope="col">Created on</th>
								  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
					<?php
						  /*getting subcategories*/
						 if(empty($searchstr))
						  {
						  $sql_qry="select s.*,c.category_name from fk_sub_categories_tbl s inner join fk_categories_tbl c on s.category_id=c.category_id where s.trash=1";
						  
						  }
						  $res=mysqli_query($con,$sql_qry);
						  $count=mysqli_num_rows($res);
						  if($count>0){
						  $i=1;
						  while($row=mysqli_fetch_assoc($res))
						  {
						  ?>
                            <tr>
                              <th scope="row"><?php echo $i;?></th>
							  <td><?php echo $row['sub_category_name'];?> </td>
                              <td><?php echo $row['category_name'];?></td>
                              <td><?php echo $row['sub_category_priority'];?></td>
                              <td>
							  <?php
							  if($row['sub_category_status']==1)
								  echo "<p style='color:green'>Active</p>";
							  else
								  echo "<p style='color:red'>In-Active</p>";
							  ?>
							  </td>
							  <td><?php echo $row['created_on'];?></td>
                               <td>
								  <a style="color:red; border-bottom:1px solid;" href="db_delete_subcategories.php?sid=<?php echo $row['sub_category_id'];?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
								  <a style="color:blue; border-bottom:1px solid;" href="restore_subcategories.php?sid=<?php echo $row['sub_category_id'];?>" onclick="return confirm('Are you sure to Re-store?')">Re-store</a>
							   </td>
                          </tr>
						  <?php
						  $i++;
						  }
						  }
						   else
						  {
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
