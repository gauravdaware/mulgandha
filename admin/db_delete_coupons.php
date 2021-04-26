<?php
if(isset($_GET['sid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['sid'];
		$sql_delete = "delete from fk_coupons_tbl where coupon_id = $sid";
		mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
		$res=mysqli_query($con,$sql_delete) or die(mysqli_error($con));
		if($res)
			header('location:trash_managecoupons.php');
		else
			echo "Not deleted from database";
}
?>