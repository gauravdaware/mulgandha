<?php
if(isset($_GET['sid']))
{
	require_once "includes/dbconnect.php";
	$sid=$_GET['sid'];
	$sql_qry="update fk_slider_tbl set trash=0 where slider_id=$sid";
	$res=mysqli_query($con,$sql_qry);
	if($res)
		header('location:trash_manageslider.php');
	else
		echo "Not deleted";
	
}
?>