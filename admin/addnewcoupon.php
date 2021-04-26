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
if(isset($add)){
	require_once "includes/dbconnect.php";
	require_once "includes/validate_str.php";

	/*Checking for duplicate category name*/
	$sql_qry="select coupon_code from fk_coupons_tbl where coupon_code='".format_str($ccode)."'";
	$res=mysqli_query($con,$sql_qry);
	$count=mysqli_num_rows($res);
	if($count>0)
		$err_msg="This Coupon Code Already exists";
	else
	{
		$date=date('Y-m-d');
		/*if Coupon Code not available store into fk_coupons_tbl*/
		$sql_insert="insert into fk_coupons_tbl(coupon_code, coupon_valid_from, coupon_valid_till,coupon_worth, coupon_type, coupon_status, added_on) values('".strtoupper(format_str($ccode))."','$vfrom','$vtill',".format_str($cworth).",'".ucfirst($ctype)."',$cstatus,'$date')";
		$resp=mysqli_query($con,$sql_insert) or die(mysqli_error($con));
		if($resp)
			$suc_msg="Coupon is added";
		else
		  $suc_msg="Coupon is not added";
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
    <title>Add Coupon</title>
    <meta name="description" content="Add Category">
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
                        <h1>Add Coupon</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Coupon</a></li>
                            <li class="active">Add Coupon</li>
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
								<strong>Add Coupon</strong>
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
						 
							
							
								<form action="" method="post" class="form-horizontal" onsubmit="return validate_coupons_form()">
							<div class="row form-group">
                            <div class="col col-md-3"><label for="cname" class=" form-control-label">Coupon Code</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="ccode" name="ccode" placeholder="Enter Coupon Code" class="form-control" value="<?php if(!empty($cname)){ echo $cname;} ?>"/><span class="help-block" id="c_err"></span></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="priority" class=" form-control-label">Valid From</label></div>
                            <div class="col-12 col-md-9"><input type="date" id="vfrom" name="vfrom" placeholder="Coupon Valid From" class="form-control" value="<?php if(!empty($priority)){ echo $priority;} ?>"/><span class="help-block" id="f_err"></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="priority" class=" form-control-label">Valid till</label></div>
                            <div class="col-12 col-md-9"><input type="date" id="vtill" name="vtill" placeholder="Coupon Valid till" class="form-control" value="<?php if(!empty($priority)){ echo $priority;} ?>"/><span class="help-block" id="t_err"></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="cname" class=" form-control-label">Coupon Worth</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="cworth" name="cworth" placeholder="Coupon Worth" class="form-control" value="<?php if(!empty($cname)){ echo $cname;} ?>"/><span class="help-block" id="cw_err"></span></div>
                          </div>
						  <div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Coupon Type</label></div>
							<div class="col-12 col-md-9">
							  <select name="ctype" id="ctype" class="form-control">
								<option value="0">Select Type</option>
								<option value="percentage">Percentage</option>
								<option value="rupees">Rupees</option>
							  </select>
							  <span class="help-block" id="ct_err"></span>
							</div>
						  </div>
  						  <div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Coupon Status</label></div>
							<div class="col-12 col-md-9">
							  <select name="cstatus" id="cstatus" class="form-control">
								<option value="1">Active</option>
								<option value="0">In-Active</option>
							  </select>
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
						</form>
                      </div>
                      
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
function validate_coupons_form(){
	var str=true;
	var ccode=document.getElementById('ccode').value;
	var vfrom=document.getElementById('vfrom').value;
	var vtill=document.getElementById('vtill').value;
	var cworth=document.getElementById('cworth').value;
	var ctype=document.getElementById('ctype').value;
	if(ccode==""){
		str=false;
		document.getElementById('c_err').innerHTML="Please Enter Coupon Code";
		document.getElementById('ccode').style.border="1px solid red";
	}
	else{
		document.getElementById('c_err').innerHTML="";
		document.getElementById('ccode').style.border="";
	}
	if(vfrom=="")
	{
		str=false;
		document.getElementById('f_err').innerHTML="Enter Coupon Valid From Date";
		document.getElementById('vfrom').style.border="1px solid red";
	}
	else{
		document.getElementById('f_err').innerHTML="";
		document.getElementById('vfrom').style.border="";
	}
	if(vtill=="")
	{
		str=false;
		document.getElementById('t_err').innerHTML="Enter Coupon Valid Till Date";
		document.getElementById('vtill').style.border="1px solid red";
	}
	else{
		document.getElementById('t_err').innerHTML="";
		document.getElementById('vtill').style.border="";
	}
	if(cworth=="")
	{
		str=false;
		document.getElementById('cw_err').innerHTML="Please Enter Coupon Worth";
		document.getElementById('cworth').style.border="1px solid red";
	}
	else{
		document.getElementById('cw_err').innerHTML="";
		document.getElementById('cworth').style.border="";
	}
	if(ctype=="0")
	{
		str=false;
		document.getElementById('ct_err').innerHTML="Please Select Type of Coupon";
		document.getElementById('ctype').style.border="1px solid red";
	}
	else{
		document.getElementById('ct_err').innerHTML="";
		document.getElementById('ctype').style.border="";
	}
	return str;
	
}
</script>
