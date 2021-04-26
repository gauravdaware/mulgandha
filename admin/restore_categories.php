<?php
if(isset($_GET['sid']))
{
	require_once "includes/dbconnect.php";
	$sid=$_GET['sid'];
	$sql_qry="update fk_categories_tbl set trash=0 where category_id=$sid";
	$res=mysqli_query($con,$sql_qry);
	if($res)
		header('location:trash_managecategories.php');
	else
		echo "Not deleted";
	
}
?>

delete from fk_categories_tbl c join fk_sub_categories_tbl s on c.category_id = s.category_id where category_id = 10