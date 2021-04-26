<?php
if(isset($_GET['sid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['sid'];
		$sql_delete = "delete from fk_sub_categories_tbl where sub_category_id = $sid";
		
		$res=mysqli_query($con,$sql_delete);
		if($res)
			header('location:trash_managesubcategories.php');
		else
			echo "Not deleted from database";
}
?>