<?php
/*  Author: Gaurav Daware
	Purpose: CRUD FUNCTIONS
	Created on: 10-08-2018
	Updated on: 
*/
require_once("includes/constants.php");

require_once VALIDATE;

//CRUD FUNCTIONS STARTS HERE
function my_insert($tbl_name,$array){
	$keys = array_keys($array);
	$values = array_values($array);
	$sql = "insert into ".$tbl_name." (".implode(',',$keys).") values (".implode(',',$values).")";
	$con=mysqli_connect("localhost","root","",'famouskart');
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	return $result;
}

/*function my_update($tbl_name,$array){
	$keys = array_keys($array);
	$values = array_values($array);
	$ck = count($keys);
	$sql = "update ".$tbl_name." set "for($i=0;$i<$ck;$i++){.$key[$i]." = ".$values[$i].}"";
	$con=mysqli_connect("localhost","root","",'famouskart');
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	return $result;
}*/
?>