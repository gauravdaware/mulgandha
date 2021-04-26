<?php
require_once("includes/constants.php");
	if(isset($_GET['cid'])){
			require_once DB_PATH;
			//$prod_id_cart = $_GET['pid'];
			$cart_id_cart = $_GET['cid'];
			$sql_delete="delete from fk_cart_tbl where cart_id = $cart_id_cart";
			
			$res=mysqli_query($con,$sql_delete) or die(mysqli_error($con));
			if($res)
				header('location:checkout.php');
			else
				echo "Not deleted";
	}

?>