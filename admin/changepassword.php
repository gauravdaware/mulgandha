<?php
session_start();
if(empty($_SESSION['email'])){
	header('location:index.php');
}
extract($_POST);
if(isset($update))
{
	$email=$_SESSION['email'];
	require_once "includes/dbconnect.php";
	require_once "includes/validate_str.php";
	$o_pass=md5(format_str($o_pass));
	$sql_chk="select admin_password from fk_admin_tbl where admin_email='".format_str($email)."' and admin_password='$o_pass'";
	$res=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($res);
	if($count==1)
	{
		if($n_pass==$c_pass)
		{
			$n_pass=md5($n_pass);
			$sql_update="update fk_admin_tbl set admin_password='".format_str($n_pass)."' where admin_email='".format_str($email)."'";
			$msg=mysqli_query($con,$sql_update);
			if($msg)
			$suc_msg="Password has been changed";
			else
			$err_msg="Password not changed";
		}
		else
		$err_msg="Confirm password doesn't match";
	}
	else
	$err_msg="Old password not matching";
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
    <title>Change Password</title>
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
   <?php require_once "includes/menu.php"; ?>
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
                        <h1>Change Password</h1>
                    </div>
                </div>
            </div>
			<div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            
                            <li><a href="#">Setting</a></li>
                            <li class="active">Change Password</li>
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
								<strong>Change Password</strong>
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
						<form action="" method="post" class="form-horizontal" onsubmit="return validate_change_password()">
							<div class="row form-group">
                            <div class="col col-md-3"><label for="o_pass" class=" form-control-label">Old Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="o_pass" name="o_pass" placeholder="Enter old password" class="form-control" value="<?php if(!empty($cname)){ echo $cname;} ?>"/><span class="help-block" id="o_err"></span></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="n_pass" class=" form-control-label">Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="n_pass" name="n_pass" placeholder="Enter Password" class="form-control" value="<?php if(!empty($priority)){ echo $priority;} ?>"/><span class="help-block" id="n_err"></span></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="n_pass" class=" form-control-label">Confirm Password</label></div>
                            <div class="col-12 col-md-9">
							<input type="password" id="c_pass" name="c_pass" placeholder="Confirm Password" class="form-control" value="<?php if(!empty($priority)){ echo $priority;} ?>"/><span class="help-block" id="c_err"></span></div>
                          </div>
  						  
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" name="update" value="change">
                          <i class="fa fa-dot-circle-o" ></i> Update
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
<script>
function validate_change_password(){
	var str=true;
	var oldPass=document.getElementById('o_pass').value;
	var newPass=document.getElementById('n_pass').value;
	var confirmPass= document.getElementById('c_pass').value;
	if(oldPass==""){
		str=false;
		document.getElementById('o_err').innerHTML="Please enter Old Password";
		document.getElementById('o_pass').style.border="1px solid red";
	}
	else{
		document.getElementById('o_err').innerHTML="";
		document.getElementById('o_pass').style.border="";
	}
	if(newPass=="")
	{
		str=false;
		document.getElementById('n_err').innerHTML="Cannot Be Blank";
		document.getElementById('n_pass').style.border="1px solid red";
	}
	else{
		document.getElementById('n_err').innerHTML="";
		document.getElementById('n_pass').style.border="";
	}
	if(confirmPass=="")
	{
		str=false;
		document.getElementById('c_err').innerHTML="Cannot Be Blank";
		document.getElementById('c_pass').style.border="1px solid red";
	}
	else{
		document.getElementById('c_err').innerHTML="";
		document.getElementById('c_pass').style.border="";
	}
	return str;
	
}
</script>