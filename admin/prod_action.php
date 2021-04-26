<?php
/*activating or inactive Categories*/
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
	/*check for prod_id existancy*/
	
	$sql_chk="select prod_id from fk_products_tbl where prod_id=$sid";
	$result_set=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($result_set);
	if($count==1)
	{
		mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
		$sql_qry="update fk_products_tbl set prod_status=$status where prod_id=$sid";
		$res=mysqli_query($con,$sql_qry);
		if($res)
			header('location:manageproducts.php');
		else
			echo "Status not updated";
	}
	else
	{
		echo "Invalid prod_id";
	}
	/*end*/
}
/*end*/


?>