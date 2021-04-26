<?php
require_once("includes/constants.php");
require_once VALIDATE;
$cid = format_str($_GET['cart_id']);

if(!empty($cid) && is_numeric($cid)){
	require_once DB_PATH;
	$sql_cart = "select quantity, selling_price, shipping_charge, total from fk_cart_tbl where cart_id = $cid";
	$cart_res = mysqli_query($con,$sql_cart) or die(mysqli_error($con));
	$count = mysqli_num_rows($cart_res);
	if($count==1){
		$cart_row = mysqli_fetch_assoc($cart_res);
		if($cart_row['quantity']>1){
		$updated_qty = $cart_row['quantity'] - 1;
		$updated_total =($updated_qty * $cart_row['selling_price'])+($updated_qty * $cart_row['shipping_charge']);
		$sql_update = "update fk_cart_tbl set quantity = $updated_qty, total = $updated_total where cart_id = $cid";
		$update = mysqli_query($con, $sql_update)  or die(mysqli_error($con));
			if($update)
				header('location:checkout.php');
			else
				echo "Something went wrong..!";
		}
		else
			header('location:checkout.php');
	}
	else
		echo "Something went wrong..!";
}
?>