<?php
/*
	Author : Gaurav Daware
	Created_on	: 07-07-2018
	Purpose : admin login
	Update_on : 07-07-2018
*/
//check session if user is already logged in.
session_start();
if(!empty($_SESSION['email'])){
	header('location:dashboard.php');
}
//end
extract($_POST);

if(isset($login)){
	require_once "includes/dbconnect.php";
	require_once "includes/validate_str.php";
	$sql_qry="select admin_email from fk_admin_tbl where admin_email='".format_str($email)."' and admin_password='".format_str(md5($password))."'";
	$result_set = mysqli_query($con,$sql_qry);
	$count = mysqli_num_rows($result_set);
	if($count == 1){
        if(isset($remember)){

            setcookie('admin_email',$email,time()+(24*3600));
            setcookie('admin_password',$password,time()+(24*3600));
        }
		//updating last login date and ip address
		$last_login=date('Y-m-d H:i:s');
		
		$last_ip = $_SERVER['REMOTE_ADDR'];
		
		$update_qry="update fk_admin_tbl set admin_last_login_date='$last_login',admin_last_login_ip='$last_ip' where admin_email='".format_str($email)."'";
		
		mysqli_query($con,$update_qry);
		
		//end
		$_SESSION['email'] = $email;
		header('location:dashboard.php');
	}
	else
		echo "Login failed";
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
    <title>Admin Login</title>
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
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action = "" method="post" onsubmit="return validate_login_form()">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php if(isset($_COOKIE['admin_email'])){echo $_COOKIE['admin_email'];}?>">
							<span id="email_err" class="error"><?php if(!empty($email_err_msg)){ echo $email_err_msg;}?></span>
						</div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE['admin_password'])){echo $_COOKIE['admin_password'];}?>">
							<span id="pwd_err" class="error"><?php if(!empty($pwd_err_msg)){ echo $pwd_err_msg;}?></span>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" value="1"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" name="login"  class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                       
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="js/vendor/jquery-2.1.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>


</body>
</html>
<script>
function validate_login_form()
{
	var str=true;
	var email=document.getElementById('email').value;
	var password=document.getElementById('password').value;
	if(email=="")
	{
		str=false;
		document.getElementById('email_err').innerHTML="Please enter email";
		document.getElementById('email').style.border="1px solid red";
	}
	else{
		document.getElementById('email_err').innerHTML="";
document.getElementById('email').style.border="";
	}
	if(password=="")
	{
		str=false;
		document.getElementById('pwd_err').innerHTML="Please enter password";
		document.getElementById('password').style.border="1px solid red";
	}
	else{
		document.getElementById('pwd_err').innerHTML="";
document.getElementById('password').style.border="";
	}
	return str;
}
</script>