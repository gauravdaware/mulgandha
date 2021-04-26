<?php
$search_str=$_GET['sstr'];
if(!empty($search_str))
{
	require_once "includes/dbconnect.php";
	$sql_qry="select prod_id,prod_name from fk_products_tbl where prod_name like '$search_str%' and prod_status=1 and trash=0";
	$res=mysqli_query($con,$sql_qry);
	$count=mysqli_num_rows($res);
	if($count>0)
	{
	   while($row=mysqli_fetch_assoc($res))
	   {
		?>
	<a style="color:#696763;" href="product_details.php?pid=<?php echo base64_encode($row['prod_id']);?>"><?php echo $row['prod_name'];?></a><br/>
<?php
	   }
	}
}
?>
