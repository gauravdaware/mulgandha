<?php
require_once("includes/constants.php");
require_once VALIDATE;
session_start();
echo "<pre>";
print_r($_POST);

print_r($_SESSION);exit;
extract($_POST);
$uid = $_SESSION['user_id'];
$status=$_POST["status"];
$name=$_POST["firstname"];
$amount=$_POST["amount"]; //Please use the amount value from database
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$order_id=$_POST["productinfo"];
$email=$_POST["email"];
$salt="eCwWELxi"; //Please change the value with the live salt for production environment


//Validating the reverse hash
If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	}
	else{	  
		$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

    }	 
	$hash = hash("sha512", $retHashSeq);
		 
	if ($hash != $posted_hash) {
	   echo "Transaction has been tampered. Please try again";
	   }
	else{
		require_once DB_PATH;
		$added_on = date('Y-m-d');
		$sql_update_cart = "update fk_cart_tbl set cart_status = 1, order_id = $order_id, payment_status = 1 where user_id = $user_id and cart_status=0";
		$sql_insert_payment_details = "insert into fk_payment_history_tbl (user_id,order_id,mihpay_id,payment_mode,payment_status,payment_amount,added_on,payee_name,payee_mobile,error_message) values ($uid,$order_id,'$mihpayid','Online',1,$amount,'$added_on','$name','$phone','$status')";
		$sql_update_order = "update fk_orders_tbl set order_status = 3, payment_type = 'Online' where order_id = $order_id";
		
		$cart_result=mysqli_query($con, $sql_update_cart) or die(mysqli_error($con));
		$result_payment_details = mysqli_query($con,$sql_insert_payment_details) or die(mysqli_error($con));
		$result_order = mysqli_query($con,$sql_update_order) or die(mysqli_error($con));
		
		if($result_payment_details && $result_order && $cart_result){
			$_SESSION['trans_id'] = $txnid;
			header('location:success.php');
		}
		else
			echo "<h1>Something went wrong...</h1>";
			
		// echo "<h3>Thank You, " . $firstname .".Your order status is ". $status .".</h3>";
		// echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
    }         
?>	