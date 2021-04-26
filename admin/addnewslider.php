<?php
/*
	Author: Gaurav Daware
	Created on:13:07:2018
	Purpose: To add slider
*/
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}
extract($_POST);
if(isset($_FILES['simage'])){
	require_once "includes/dbconnect.php";
	//echo "infile uplode fun";
	require_once "includes/validate_str.php";
	$file_tmp=$_FILES['simage']['tmp_name'];//random name
	$file_name=$_FILES['simage']['name'];//test.JPG
	$file_size=$_FILES['simage']['size']; 
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
			$resp=move_uploaded_file($file_tmp,"../uploads/slider/".$file_name);
			if($resp){
				
			
				//insert query
				
				//mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
				$sql_qry="select slider_title from fk_slider_tbl where slider_title='$sname'";
				$res=mysqli_query($con,$sql_qry);
				$count=mysqli_num_rows($res);
				if($count>0)
					$err_msg="This Slider title already exists";
				else
				{
				$date = date('Y-m-d H:i:s');
				/*if slider not available store into fk_slider_tbl*/
				$sql_insert="insert into fk_slider_tbl(slider_title,slider_url,slider_image,slider_discription,slider_status,created_on) values('".ucwords(format_str($sname))."','".format_str($url)."','".ucwords(format_str($file_name))."','".ucwords(format_str($description))."',$s_status,'$date')";
				
				$resp=mysqli_query($con,$sql_insert);
				if($resp)
					$suc_msg="Slider data is added";
				else
					$err_msg="Slider data is not added";
				}
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
    <title>Add Slider</title>
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
                        <h1>Add Slider</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Slider</a></li>
                            <li class="active">Add Slider</li>
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
								<strong>Add Slider</strong>
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
						 
								<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validate_slider_form()">
							<div class="row form-group">
                            <div class="col col-md-3"><label for="cname" class=" form-control-label">Slider Title</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="sname" name="sname" placeholder="Enter Slider Title" class="form-control" value="<?php if(!empty($cname)){ echo $cname;} ?>"/><span class="help-block" id="c_err"></span></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="priority" class=" form-control-label">Slider URL</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="url" name="url" placeholder="Enter Slider URL" class="form-control" value="<?php if(!empty($priority)){ echo $priority;} ?>"/><span class="help-block" id="p_err"></span></div>
                          </div>
  						  <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Slider Image</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="simage" name="simage" class="form-control-file"><span class="help-block" id='image_err'></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Discription</label></div>
                            <div class="col-12 col-md-9"><textarea name="description" id="description" rows="9" placeholder="Slider Discription..." class="form-control"></textarea></div>
                          </div>
						  <div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Slider Status</label></div>
							<div class="col-12 col-md-9">
							  <select name="s_status" id="s_status" class="form-control">
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
function validate_category_form(){
	var str=true;
	var cname=document.getElementById('cname').value;
	var priority=document.getElementById('priority').value;
	if(cname==""){
		str=false;
		document.getElementById('c_err').innerHTML="Please enter category";
		document.getElementById('cname').style.border="1px solid red";
	}
	else{
		document.getElementById('c_err').innerHTML="";
		document.getElementById('cname').style.border="";
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
