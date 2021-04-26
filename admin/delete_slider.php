<?php
if(isset($_GET['sid'])){
		require_once "includes/dbconnect.php";
		$sid=$_GET['sid'];
		$trash = 1;
		$sql_update="update fk_slider_tbl set trash = $trash where slider_id=$sid";
		$res=mysqli_query($con,$sql_update);
		if($res)
			header('location:manageslider.php');
		else
			echo "Not deleted";
}
?>