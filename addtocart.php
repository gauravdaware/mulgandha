<?php
/*Author: Gaurav Daware
  created: 26-07-2018
  purpose: Adding products in the cart table
*/
require_once("includes/constants.php");
extract($_POST);

if(isset($add))
{
	session_start();
	$uid=$_SESSION['user_id'];
	require_once DB_PATH;
	$sql_qry="select prod_sp,prod_shipping_charge from fk_products_tbl where prod_id=$pid";
	$prod_info=mysqli_query($con,$sql_qry) or die(mysqli_error($con));
	$pinfo=mysqli_fetch_assoc($prod_info);
	$sp = $pinfo['prod_sp'];
	$ship_charge = $pinfo['prod_shipping_charge'];
	/*checking for product already added or not in cart_table */
	$sql_chk="select prod_id, quantity from fk_cart_tbl where prod_id=$pid and user_id=$uid and cart_status=0";
	$cart_prod_result=mysqli_query($con,$sql_chk) or die(mysqli_error($con));
	$count = mysqli_num_rows($cart_prod_result);
	if($count==1){
		$pexist = mysqli_fetch_assoc($cart_prod_result);
		$updated_qty = $pexist['quantity'] + $qty;
		$updated_total = ($updated_qty * $sp) + ($updated_qty * $ship_charge);
		$cart_update_sql = "update fk_cart_tbl set quantity = $updated_qty ,total = $updated_total where prod_id = $pid and user_id = $uid and cart_status=0";
		$result_update_cart = mysqli_query($con,$cart_update_sql) or die(mysqli_error($con));
		if($result_update_cart){
			header("location:checkout.php");
		}
		else{
			echo "not updated";
		}
	}
	else{
		//if product isnt available in cart_table then insert product details in cart table
		$total = ($qty*$sp)+($qty*$ship_charge);
		$date = date('Y-m-d');
		$cart_insert_sql="insert into fk_cart_tbl (prod_id, user_id, quantity, selling_price, shipping_charge, total, added_on) values ($pid, $uid, $qty, $sp, $ship_charge, $total, '$date')";
		
		$result_insert_cart = mysqli_query($con,$cart_insert_sql) or die(mysqli_error($con));
		if($result_insert_cart)
			header("location:checkout.php");
		else
			echo "not added";	
	}
}
else
	header('location:index.php');

?>