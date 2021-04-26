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
	/*check for category_id existancy*/
	$sql_chk="select category_id from fk_categories_tbl where category_id=$sid";
	$result_set=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($result_set);
	if($count==1)
	{
		$sql_qry="update fk_categories_tbl set category_status=$status where category_id=$sid";
		$res=mysqli_query($con,$sql_qry);
		if($res)
			header('location:managecategories.php');
		else
			echo "Status not updated";
	}
	else
	{
		echo "Invalid Category id";
	}
	/*end*/
}
/*end*/


?>