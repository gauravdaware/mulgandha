<?php
/*
	Author: Gaurav Daware
	Created on:13:07:2018
	Purpose:To to add sub-categories
*/
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}
extract($_POST);
require_once "includes/dbconnect.php";
require_once "includes/validate_str.php";
if(isset($add)){
	/*Checking for duplicate category name*/
	$sql_qry="select sub_category_name from fk_sub_categories_tbl where sub_category_name='$scname' and category_id='$category'";
	$res=mysqli_query($con,$sql_qry);
	$count=mysqli_num_rows($res);
	if($count>0)
		$err_msg="This Subcategory already exists";
	else
	{
		$date=date('Y-m-d');
		/*if category not available store into fk_categories_tbl*/
		$sql_insert="insert into fk_sub_categories_tbl(category_id,sub_category_name,sub_category_priority,created_on,sub_category_status) values($category,'".format_str($scname)."',$priority,'$date',$scstatus)";
		$resp=mysqli_query($con,$sql_insert);
		if($resp)
			$suc_msg="Sub Category is added";
		else
		  $suc_msg="Sub Category is not added";
	}
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
    <title>Add Subcategory</title>
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
<?php require_once "includes/menu.php";?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
		<?php require_once "includes/header.php";?>
       <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Subcategory</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Subcategory</a></li>
                            <li class="active">Add Subcategory</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                      <form action="" method="post" class="form-horizontal" onsubmit="return validate_subcategory_form()">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-header">
                        <strong>Add Subcategory</strong> 
                      </div>
                      <div class="card-body card-block">
					  <?php
							  if(!empty($err_msg))
							  {
							  ?>
								<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Failed</span>
													<?php echo $err_msg;?>
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
								 
								<?php
							  }
							  ?>
								<?php
							  if(!empty($suc_msg))
							  {
							  ?>
							  <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                            <span class="badge badge-pill badge-primary">Success</span>
												<?php echo $suc_msg;?>               
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
								
								<?php
							  }
							  ?>
					  <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Category</label></div>
                            <div class="col-12 col-md-9">
							 <select name="category" id="category" class="form-control">
                                <option value="0">-- Select category--</option>
                                <?php
								$sql_categories="select category_id,category_name from fk_categories_tbl where category_status=1 order by category_name asc";
								$res_categories=mysqli_query($con,$sql_categories);
								while($row=mysqli_fetch_assoc($res_categories))
								{
									?>
								<option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
									<?php
								}
								
								?>
                               
                              </select>
							
							<span class="help-block" id="cat_err"></span></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="scname" class=" form-control-label">Sub Category Name</label></div>
                            <div class="col-12 col-md-9">
								<input type="text" id="scname" name="scname" placeholder="Enter Sub-Category" class="form-control">
								<span class="help-block" id="sc_err"></span>
							</div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="priority" class=" form-control-label">Priority</label></div>
                            <div class="col-12 col-md-9">
								<input type="text" id="priority" name="priority" placeholder="Enter Priority" class="form-control">
								<span class="help-block" id='p_err'></span>
							</div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Status</label></div>
                            
							<div class="col-12 col-md-9">
                              <select name="scstatus" id="scstatus" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                               
                              </select>
                            </div>
                          </div>
                        
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" name="add" value="Add now">
                          <i class="fa fa-dot-circle-o" ></i> Add now
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
                    </div>
                 </div>
           </form>
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


<!-- Client Side validation-->
<script>
function validate_subcategory_form(){
	var str=true;
	var scname=document.getElementById('scname').value;
	var category = document.getElementById('category').value;
	var priority=document.getElementById('priority').value;
	if(scname==""){
		str=false;
		document.getElementById('sc_err').innerHTML="Please enter subcategory";
		document.getElementById('scname').style.border="1px solid red";
	}
	else{
		document.getElementById('sc_err').innerHTML="";
		document.getElementById('scname').style.border="";
	}
	if(category == 0){
		str=false;
		document.getElementById('cat_err').innerHTML="Please Select Category";
		document.getElementById('category').style.border="1px solid red";
	}
	else{
		document.getElementById('cat_err').innerHTML="";
		document.getElementById('category').style.border="";
	}
	if(priority=="")
	{
		str=false;
		document.getElementById('p_err').innerHTML="Please enter priority";
		document.getElementById('priority').style.border="1px solid red";
	}
	else{
		document.getElementById('p_err').innerHTML="";
		document.getElementById('priority').style.border="";
	}
	return str;
	
}
</script>
