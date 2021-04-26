<?php
if(isset($_GET['sid']))
{
	require_once "includes/dbconnect.php";
	$sid=$_GET['sid'];
	
	$sql_qry="update fk_products_tbl set trash=0 where prod_id=$sid";
	$res=mysqli_query($con,$sql_qry);
	if($res)
		header('location:trash_manageproducts.php');
	else
		echo "Not deleted";
	
}
?>
