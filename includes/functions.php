<?php

/* code for getting categories*/
function get_categories(){
	$con=mysqli_connect("localhost","root","root");
	mysqli_select_db($con,"mulgandh_famouskart");
	
	$sql_qry="select category_id,category_name from fk_categories_tbl where category_status=1 and trash=0 order by category_priority asc";
	$rs=mysqli_query($con,$sql_qry);
	return $rs;
}
/*end*/
/* code for getting sub categories*/
function get_subcategories($category_id){
	$con=mysqli_connect("localhost","root","root");
	mysqli_select_db($con,"mulgandh_famouskart");
	$sql_qry="select sub_category_id,sub_category_name from fk_sub_categories_tbl where sub_category_status=1 and trash=0 and category_id=$category_id order by sub_category_priority asc";
	$rs=mysqli_query($con,$sql_qry);
	return $rs;
}
/*end*/

/*Code for geetting slider data*/
function get_slider(){
	$con=mysqli_connect("localhost","root","root");
	mysqli_select_db($con,"mulgandh_famouskart");
	$sql_slider = "select * from fk_slider_tbl where slider_status=1 and trash=0";
	$rs = mysqli_query($con,$sql_slider);
	return $rs;
}
/*end*/
/*Code for geetting slider data*/
function get_products(){
	$con=mysqli_connect("localhost","root","root");
	mysqli_select_db($con,"mulgandh_famouskart");
	$sql_qry="select * from fk_products_tbl where prod_status=1 and trash=0";
	$rs=mysqli_query($con,$sql_qry);
	return $rs;
}
/*End*/



















?>