<?php
require_once("includes/constants.php");
	if(isset($_GET['wid'])){
			require_once DB_PATH;
			//$prod_id_cart = $_GET['pid'];
			$wish_id = base64_decode($_GET['wid']);
			$sql_delete="delete from fk_wishlist_tbl where wishlist_id = $wish_id";
			
			$res=mysqli_query($con,$sql_delete) or die(mysqli_error($con));
			if($res)
				header('location:wishlist.php');
			else
				echo "Not deleted";
	}

?>