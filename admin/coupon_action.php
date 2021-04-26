<?php
/*activating or inactive Coupons*/
if(isset($_GET['sid']) || isset($_GET['asid']) )
{
	require_once "includes/dbconnect.php";
	if(!empty($_GET['sid']))
	{
		$sid=$_GET['sid'];
		$status=1;
	}
	else
	{
		$sid=$_GET['asid'];
		$status=0;
	}	
	/*check for coupon_id existancy*/
	$sql_chk="select coupon_id from fk_coupons_tbl where coupon_id=$sid";
	$result_set=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($result_set);
	if($count==1)
	{
		$sql_qry="update fk_coupons_tbl set coupon_status=$status where coupon_id=$sid";
		$res=mysqli_query($con,$sql_qry);
		if($res)
			header('location:managecoupons.php');
		else
			echo "Status not updated";
	}
	else
	{
		echo "Invalid Coupon id";
	}
	/*end*/
}
/*end*/


?>