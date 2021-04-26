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

<style>
	body{
		font-family: "Comic Sans MS", sans-serif;
		margin: 0;
		background-color: #eeeeee;
	}
	
	form{
		padding:20px;
	}
	table{
		border-collapse: collapse;
		border: 2px solid black;
		background-color:#f5f5f5;
	}
	table, tr, td {
	padding: 5px;	
}
</style>
<div id="login_form" allign="center">
<form action = "" method="post" onsubmit="return validate_login_form()">
	<table>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" id="email" placeholder = "Enter Email" value="<?php if(!empty($email)){ echo $email;} ?>"/>
				<span id="email_err" class="error"><?php if(!empty($email_err_msg)){ echo $email_err_msg;}?></span>
			</td>
		</tr>
		<tr>
		<td>Password :</td>
		<td>
			<input type="password" name="password" id="password" placeholder="Enter Password"/>
			<span id="pwd_err" class="error"><?php if(!empty($pwd_err_msg)){ echo $pwd_err_msg;}?></span>
			</td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" name="login" value="Login"/></td>
		</tr>
	</table>
</form>
</div>
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