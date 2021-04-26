<?php
/*
	Author: Gaurav Daware
	Created on:13:07:2018
	Purpose: To add categories
*/
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}

extract($_POST);
//if(isset($add))
if(isset($_FILES['pimage']))
{
	//echo "infile uplode fun";
	
	$file_tmp=$_FILES['pimage']['tmp_name'];//random name
	$file_name=$_FILES['pimage']['name'];//test.JPG
	$file_size=$_FILES['pimage']['size']; 
	$allowed_exts=array('jpg','jpeg','png','gif');
	
	$get_ext=explode(".",$file_name);
	$extension = end($get_ext);
	$ext_lower=strtolower($extension);
	
	if(in_array($ext_lower,$allowed_exts))
	{
		if($file_size>1048576)
			$err_msg="File size is should be <=1mb";
		else
		{
			$resp=move_uploaded_file($file_tmp,"../uploads/products/".$file_name);
			if($resp){
				$added_on = date('Y-m-d H:i:s');
				//insert query
				require_once "includes/dbconnect.php";
				require_once "includes/validate_str.php";
				mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
				$sql_qry="insert into fk_products_tbl(prod_code, category_id, sub_category_id,  prod_name, prod_brand, prod_mrp, prod_sp, prod_shipping_charge, prod_stock, prod_features, prod_description, prod_image, added_on, prod_status) values ('".strtoupper(format_str($pcode))."',$category,$scname,'".ucwords(format_str($pname))."','".ucwords(format_str($brand))."',$mrp,$sp,$shipping,$stock,'".ucwords(format_str($features))."','".ucwords(format_str($description))."','$file_name','$added_on',$scstatus)";
				//echo $sql_qry;
				$result=mysqli_query($con,$sql_qry);
				if($result)
					$suc_msg="Product added successfully";
				else
					$err_msg="Product Not added";
				/*end*/
			}
			else
			$err_msg="Not uploaded";
		}
	}
	else
	$err_msg="Invalid";
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
    <title>Add Product</title>
    <meta name="description" content="Add Product">
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
<?php require_once("includes/header.php");	?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Product</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Product</a></li>
                            <li class="active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
				<div class="row">
					<div class="col-lg-6">
						<div class="card">
                      <div class="card-header">
                        <strong>Add Product</strong>
                      </div>
					  
                      <div class="card-body card-block">
	<!--Error Display Code  -->			  
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
							  
	 <!--end Error Display Code  -->
							  
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return validate_products_form()">
						
                         <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Select Category</label></div>
                            <div class="col-12 col-md-9">
                              <select name="category" id="category" class="form-control" onchange="get_sub_list()">
                                <option>Select Category</option>
								<?php
								require_once "includes/dbconnect.php";
								$sql_categories="select category_id, category_name from fk_categories_tbl where category_status = 1 order by category_name asc";
								$res_categories = mysqli_query($con,$sql_categories);
								while($row=mysqli_fetch_assoc($res_categories)){
								?>
                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
								<?php
								}
								?>
							  </select>
                            </div>
                          </div>
						  
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Select Subcategory</label></div>
                            <div class="col-12 col-md-9">
                              <span id="sublist">
							  <select name="scname" id="scname" class="form-control"><span class="help-block" id="c_err"></span>
                                <option value="0">Please select</option>
                              </select>
							  </span>
                            </div>
                          </div>
						  
						  
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Product Code</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="pcode" name="pcode" placeholder="Enter Product code..." class="form-control"><span class="help-block" id='pc_err'></span></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="pname" name="pname" placeholder="Enter Product Name" class="form-control"><span class="help-block" id='pn_err'></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Brand</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="brand" name="brand" placeholder="Enter Brand Name" class="form-control"><span class="help-block" id='b_err'></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Maximum Retail Price</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="mrp" name="mrp" placeholder="MRP"  class="form-control"><span class="help-block" id='mrp_err'></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Selling Price</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="sp" name="sp" placeholder="SP" class="form-control"><span class="help-block" id='sp_err'></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping Charge</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="shipping" name="shipping" placeholder="Shipping Charge" class="form-control"><span class="help-block" id='ship_err'></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Stock</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="stock" name="stock" placeholder="Stock" class="form-control"><span class="help-block" id='stock_err'></span></div>
                          </div>
                        
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Features</label></div>
                            <div class="col-12 col-md-9"><textarea name="features" id="features" rows="9" placeholder="Features..." class="form-control"></textarea></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Discription</label></div>
                            <div class="col-12 col-md-9"><textarea name="description" id="description" rows="9" placeholder="Discription..." class="form-control"></textarea></div>
                          </div>
						  
						  
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Product Main Image</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="pimage" name="pimage" class="form-control-file"><span class="help-block" id='image_err'></span></div>
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
                        <button type="submit" name="add" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Add now
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                      </div>
					  </form>
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
<!-- Client Side validation-->
<script>

function get_sub_list()
{
	var cid=document.getElementById('category').value;
	/*ajax code starts here*/
		var obj;
		if (window.XMLHttpRequest) {
		// code for modern browsers
		obj = new XMLHttpRequest();
		} else {
		// code for IE6, IE5
		obj = new ActiveXObject("Microsoft.XMLHTTP");
		}
		obj.onreadystatechange = function() {
		if (this.readyState == 4) {
		document.getElementById("sublist").innerHTML = 
		this.responseText;
		}
		};
		obj.open("GET", "get_subcategories.php?cid="+cid, true);// true is for asynchronus and false synchronus
		obj.send();
	/*ajax code ends*/
}


function validate_products_form(){
	var str=true;
	var pcode=document.getElementById('pcode').value;
	var pname=document.getElementById('pname').value;
	var brand=document.getElementById('brand').value;
	var mrp=document.getElementById('mrp').value;
	var sp=document.getElementById('sp').value;
	var shipping=document.getElementById('shipping').value;
	var stock=document.getElementById('stock').value;
	var image=document.getElementById('description').value;
	if(pcode==""){
		str=false;
		document.getElementById('pc_err').innerHTML="Please enter Product Code";
		document.getElementById('pcode').style.border="1px solid red";
	}
	else{
		document.getElementById('pc_err').innerHTML="";
		document.getElementById('pcode').style.border="";
	}
	if(pname=="")
	{
		str=false;
		document.getElementById('pn_err').innerHTML="Please enter Product Name";
		document.getElementById('pname').style.border="1px solid red";
	}
	else{
		document.getElementById('pn_err').innerHTML="";
		document.getElementById('pname').style.border="";
	}
	if(brand==""){
		str=false;
		document.getElementById('b_err').innerHTML="Please enter Brand";
		document.getElementById('brand').style.border="1px solid red";
	}
	else{
		document.getElementById('b_err').innerHTML="";
		document.getElementById('brand').style.border="";
	}
	if(mrp=="")
	{
		str=false;
		document.getElementById('mr_err').innerHTML="Please enter MRP";
		document.getElementById('mrp').style.border="1px solid red";
	}
	else{
		document.getElementById('mrp_err').innerHTML="";
		document.getElementById('mrp').style.border="";
	}
	if(sp==""){
		str=false;
		document.getElementById('sp_err').innerHTML="Please enter Selling Price";
		document.getElementById('sp').style.border="1px solid red";
	}
	else{
		document.getElementById('sp_err').innerHTML="";
		document.getElementById('sp').style.border="";
	}
	if(shipping=="")
	{
		str=false;
		document.getElementById('ship_err').innerHTML="Please enter shipping charges";
		document.getElementById('shipping').style.border="1px solid red";
	}
	else{
		document.getElementById('ship_err').innerHTML="";
		document.getElementById('shipping').style.border="";
	}
	if(stock==""){
		str=false;
		document.getElementById('stock_err').innerHTML="Please enter stock";
		document.getElementById('stock').style.border="1px solid red";
	}
	else{
		document.getElementById('stock_err').innerHTML="";
		document.getElementById('stock').style.border="";
	}
	
	if(false)
	{
		str=false;
		document.getElementById('image_err').innerHTML="Please Upload Image";
	}
	else{
		document.getElementById('image_err').innerHTML="";
	}
	
	return str;
	
}
</script>
