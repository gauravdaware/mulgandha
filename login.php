<?php
/*
	Author : Gaurav Daware
	Created_on	: 23-07-2018
	Purpose : user login and register
	Update_on : 23-07-2018
*/
require_once("includes/constants.php");
if(!empty($_SESSION['user_id'])){
	header('location:index.php');
}
extract($_POST);
//require_once("includes/dbconnect.php");
require_once(DB_PATH);
require_once(VALIDATE);


if(isset($login)){
	if(isset($remember)){
			setcookie("email",$login_email,time()+(24*3600));	
			setcookie("password",$login_password,time()+(24*3600));	
		}
	$login_qry = "select user_id,user_name,user_mobile,user_email from fk_usersignup_tbl where user_email = '".format_str($login_email)."' and user_password = '".md5(format_str($login_password))."' and user_status=1";
	$result_login = mysqli_query($con,$login_qry) or die(mysqli_error($con));
	$count = mysqli_num_rows($result_login);
	if($count==1){
/* 		$row_details = mysqli_fetch_assoc($result_login);
		 */
		$login_date_time = date("Y-m-d H:i:s");
		$login_ip = $_SERVER['REMOTE_ADDR'];
		$login_update_qry = "update fk_usersignup_tbl set user_last_login = '$login_date_time',user_last_login_ip = '$login_ip' where user_email = '$login_email'";
		mysqli_query($con,$login_update_qry) or die(mysqli_error($con));
		$row = mysqli_fetch_assoc($result_login);
		session_start();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['user_name'];
		$_SESSION['email'] = $row['user_email'];
		$_SESSION['mobile'] = $row['user_mobile'];
		setcookie("user_email",$row['user_email'],time()+(24*3600));	
		setcookie("name",$row['user_name'],time()+(24*3600));
		setcookie("mobile",$row['user_mobile'],time()+(24*3600));
		header("location:index.php");
	}
	else
		$log_err_msg= "Invalid Email or Password..!";
}

if(isset($signup)){
		$sql_qry = "select user_email from fk_usersignup_tbl where user_email = '".format_str($uemail)."'";
		$result = mysqli_query($con,$sql_qry) or die(mysqli_error($con));
		$count = mysqli_num_rows($result);
		if($count==0){
			$date = date("Y-m-d");
			$status = 1;
			$sql_insert = "insert into fk_usersignup_tbl (user_name, user_email, user_mobile, user_password, user_signup_date, user_status) values ('".ucwords(format_str($uname))."','".strtolower(format_str($uemail))."','".format_str($umobile)."','".md5(format_str($upassword))."','$date',$status)";
			$result_insert = mysqli_query($con,$sql_insert) or die(mysqli_error($con));
			if($result_insert){
				$succ_msg = "Registration Successful..Please Login";
			}
			else
				$err_msg= "REGISTRATION FAILED";
		}
		else
			$err_msg= format_str($uemail)." already exist";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<!--header-->
	<?php require_once("includes/header.php");?>
	<!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php
							  if(!empty($log_err_msg))
							  {
					    ?>
								  
							   <span style="color:red;"><?php echo $log_err_msg;?></span>
                         <?php       						 
							  }
  					     ?>
						<form action="#" method="post">
							<input type="email" name="login_email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>" />
							<input type="password" name="login_password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>" />

							<span><input type="checkbox" class="checkbox" name="remember" value="1" checked> Keep me signed in</span>
							<button type="submit" name="login" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<?php
							  if(!empty($err_msg)){
					    ?>
								<span style="color:red;"><?php echo $err_msg;?></span>
                         <?php       						 
							  }
  					     ?>
						 <?php if(!empty($succ_msg)){?>
						 <span style="color:green;"><?php echo $succ_msg; ?></span>
						 <?php
								}
						 ?>
						<form action="#" method="post">
							<input type="text" name="uname" placeholder="Name"/>
							<input type="email" name="uemail" placeholder="Email Address"/>
							<input type="number" name="umobile" placeholder="Mobile"/>
							<input type="password" name="upassword" placeholder="Password"/>
							<button type="submit" name="signup" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<!--Footer-->
	<?php require_once("includes/footer.php");?>
	<!--/Footer-->
	
							  

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>