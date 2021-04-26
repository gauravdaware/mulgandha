<?php
/*activating or inactive Categories*/
if(isset($_GET['sid']) || isset($_GET['asid']) )
{
	require_once "includes/dbconnect.php";
	if(!empty($_GET['sid']))
	{
		$sid=$_GET['sid'];
		$status=1;
	}
	else
	{
		$sid=$_GET['asid'];
		$status=0;
	}
	/*check for category_id existancy*/
	$sql_chk="select slider_id from fk_slider_tbl where slider_id=$sid";
	$result_set=mysqli_query($con,$sql_chk);
	$count=mysqli_num_rows($result_set);
	if($count==1)
	{
		$sql_qry="update fk_slider_tbl set slider_status=$status where slider_id=$sid";
		$res=mysqli_query($con,$sql_qry);
		if($res)
			header('location:manageslider.php');
		else
			echo "Status not updated";
	}
	else
	{
		echo "Invalid Slider id";
	}
	/*end*/
}
/*end*/


?>