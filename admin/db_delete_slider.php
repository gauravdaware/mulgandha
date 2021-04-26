<?php
if(isset($_GET['sid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['sid'];
		$sql_delete = "delete from fk_slider_tbl where slider_id = $sid";
		
		$res=mysqli_query($con,$sql_delete);
		if($res)
			header('location:trash_manageslider.php');
		else
			echo "Not deleted from database";
}
?>