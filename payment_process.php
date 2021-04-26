<?php
session_start();
require_once("includes/constants.php");
$payment_id = $_POST['payment_id'];
$uid = $_SESSION['user_id'];
$name=$_SESSION["bill_name"];
$amount=$_SESSION["amount"]; //Please use the amount value from database
$txnid=$_POST["payment_id"];
$order_id=$_SESSION['order_id'];
$email=$_SESSION["bill_email"];
$phone = $_SESSION['bill_mobile'];
if(isset($payment_id)){
	$status = "success";
	require_once DB_PATH;
	$added_on = date('Y-m-d');
	$sql_update_cart = "update fk_cart_tbl set cart_status = 1, order_id = $order_id, payment_status = 1 where user_id = $uid and cart_status = 0";
	$sql_insert_payment_details = "insert into fk_payment_history_tbl (user_id,order_id,mihpay_id,payment_mode,payment_status,payment_amount,added_on,payee_name,payee_mobile,error_message) values ($uid,$order_id,'$payment_id','Online',1,$amount,'$added_on','$name','$phone','$status')";
	$sql_update_order = "update fk_orders_tbl set order_status = 3, payment_type = 'Online' where order_id = $order_id";
	
	$cart_result=mysqli_query($con, $sql_update_cart) or die(mysqli_error($con));
	$result_payment_details = mysqli_query($con,$sql_insert_payment_details) or die(mysqli_error($con));
	$result_order = mysqli_query($con,$sql_update_order) or die(mysqli_error($con));
	$_SESSION['trans_id'] = $txnid;
	/* if($result_payment_details && $result_order && $cart_result){
		$_SESSION['trans_id'] = $txnid;
		header('location:success.php');
	}
	else
		echo "<h1>Opps...Something went wrong.</h1>"; */
}