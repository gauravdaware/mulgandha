<?php
if(isset($_GET['oid'])){
	$oid = $_GET['oid'];
	require_once "includes/dbconnect.php";
	$sql_update = "update fk_orders_tbl set order_cancel_status = 1 where order_id = $oid";
	$res = mysqli_query($con,$sql_update);
	if($res)
		header('location:neworders.php');
	else
		echo "not updated";
	
}
?>