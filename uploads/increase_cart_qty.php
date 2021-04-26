<?php
require_once "includes/validate_str.php";
$cid = format_str($_GET['cart_id']);
$pid = format_str($_GET['prod_id']);
if((!empty($cid) && is_numeric($cid))&&(!empty($pid) && is_numeric($pid))){
	require_once "includes/dbconnect.php";
	$sql_cart = "select quantity, selling_price, shipping_charge, total from fk_cart_tbl where cart_id = $cid";
	$cart_res = mysqli_query($con,$sql_cart) or die(mysqli_error($con));
	$count = mysqli_num_rows($cart_res);
	if($count==1){
		$sql_prod = "select prod_stock from fk_products_tbl where prod_id = $pid";
		$prod_result = mysqli_query($con,$sql_prod) or die(mysqli_error($con));
		$prod_row = mysqli_fetch_assoc($prod_result);		
		$cart_row = mysqli_fetch_assoc($cart_res);
		if($cart_row['quantity']< $prod_row['prod_stock']){
			$updated_qty = $cart_row['quantity'] + 1;
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