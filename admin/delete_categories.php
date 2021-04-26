<?php
if(isset($_GET['dsid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['dsid'];
		$trash = 1;
		
		$sql_update="update fk_categories_tbl set trash = $trash where category_id=$sid";
		//$result_set=mysqli_query($con,$sql_update);
		
		$res=mysqli_query($con,$sql_update);
		
		if($res)
			header('location:managecategories.php');
		else
			echo "Not deleted";
}

?>