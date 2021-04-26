<?php
/*
	Author: Gaurav Daware
	Created on:08:08:2018
	Purpose: To delete Reviews
*/
if(isset($_GET['dsid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['dsid'];
		$sql_delete = "delete from fk_reviews_tbl where review_id = $sid";
		//mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
		$res=mysqli_query($con,$sql_delete) or die(mysqli_error($con));
		if($res)
			header('location:manage_reviews.php');
		else
			echo "Not deleted from database";
}
?>