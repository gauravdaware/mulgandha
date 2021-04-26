<?php
require_once "includes/dbconnect.php";
$cid=$_GET['cid'];
$sql_qry="select sub_category_id,sub_category_name from fk_sub_categories_tbl where category_id=$cid order by sub_category_name asc";
$res=mysqli_query($con,$sql_qry);
?>
<select name="scname" id="scname" class="form-control">
<option value="">- Select Subcategory</option>
<?php
while($row=mysqli_fetch_assoc($res))
{
	?>
<option value="<?php echo $row['sub_category_id'];?>"><?php echo $row['sub_category_name'];?></option>
	<?php
}
?>
</select>