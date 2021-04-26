<?php
/*activating or inactive subcategories*/
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
	/*check for sub cat id existancy*/
	$sql_chk="select sub_category_id from fk_sub_categories_tbl where sub_category_id=$sid";
	$result_set=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($result_set);
	if($count==1)
	{
		$sql_qry="update fk_sub_categories_tbl set sub_category_status=$status where sub_category_id=$sid";
		$res=mysqli_query($con,$sql_qry);
		if($res)
			header('location:managesubcategories.php');
		else
			echo "Status not updated";
	}
	else
	{
		echo "Invalid subcategory id";
	}
	/*end*/
}
/*end*/


?>