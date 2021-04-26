<?php
require_once("includes/constants.php");
require_once CRUD;
session_start();
if((isset($_GET['pid'])) && (!empty($_SESSION['user_id']))){
		require_once VALIDATE;
		$pid = base64_decode($_GET['pid']);
		$uid = $_SESSION['user_id'];
		$added_on = date('Y-m-d');
		require_once DB_PATH;
		$sql_chk_prod_id = "select wishlist_id from fk_wishlist_tbl where prod_id = $pid and user_id = $uid";
		$chk_res = mysqli_query($con,$sql_chk_prod_id);
		$count = mysqli_num_rows($chk_res);
		if($count==0){
			 $sql_insert = "insert into fk_wishlist_tbl (prod_id,user_id,added_on) values ($pid,$uid,'$added_on') ";
			 $res = mysqli_query($con,$sql_insert);
			
			$arr = array('prod_id'=>$pid,'user_id'=>$uid,'added_on'=>$added_on);
			$res = my_insert('fk_wishlist_tbl',$arr);
			
			if($res){
				$wid = mysqli_insert_id($con);
				header('location:index.php');
				$succ_msg = "Added to wishlist";
			}
			else
				$err_msg = "Not Added";
		}
		else{
			header('location:index.php');
		}
}
else{
	header('location:login.php');
}
?>