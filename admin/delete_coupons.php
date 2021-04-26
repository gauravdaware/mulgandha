<?php
if(isset($_GET['dsid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['dsid'];
		$trash = 1;
		$sql_update="update fk_coupons_tbl set trash = $trash where coupon_id=$sid";
		$res=mysqli_query($con,$sql_update);
		if($res)
			header('location:managecoupons.php');
		else
			echo "Not deleted";
}

?>