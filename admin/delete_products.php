<?php
if(isset($_GET['sid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['sid'];
		$trash = 1;
		mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
		$sql_update="update fk_products_tbl set trash = $trash where prod_id=$sid";
		//$result_set=mysqli_query($con,$sql_update);
		
		$res=mysqli_query($con,$sql_update);
		
		if($res)
			header('location:manageproducts.php');
		else
			echo "Not deleted";
}

?>