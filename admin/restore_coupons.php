<?php
if(isset($_GET['sid']))
{
	require_once "includes/dbconnect.php";
	$sid=$_GET['sid'];
	$sql_qry="update fk_coupons_tbl set trash=0 where coupon_id=$sid";
	$res=mysqli_query($con,$sql_qry);
	if($res)
		header('location:trash_managecoupons.php');
	else
		echo "Not deleted";
	
}
?>

