<?php
/*
	Author: Gaurav Daware
	Created on:08:08:2018
	Purpose:activating or inactive Reviews
*/

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
	$sql_chk="select review_id from fk_reviews_tbl where review_id=$sid";
	$result_set=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($result_set);
	if($count==1)
	{
		$sql_qry="update fk_reviews_tbl set review_status=$status where review_id=$sid";
		$res=mysqli_query($con,$sql_qry);
		if($res)
			header('location:manage_reviews.php');
		else
			echo "Status not updated";
	}
	else
	{
		echo "Invalid review id";
	}
	/*end*/
}
/*end*/


?>