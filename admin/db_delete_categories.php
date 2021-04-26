<?php
if(isset($_GET['sid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['sid'];
		$sql_delete = "delete from fk_categories_tbl where category_id = $sid";
		mysqli_query($con,"SET FOREIGN_KEY_CHECKS = 0");
		$res=mysqli_query($con,$sql_delete) or die(mysqli_error($con));
		if($res)
			header('location:trash_managecategories.php');
		else
			echo "Not deleted from database";
}
?>