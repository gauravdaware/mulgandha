<?php
/*
	Author : Gaurav Daware
	Created_on	: 23-07-2018
	Purpose : user logout
	Update_on : 23-07-2018
*/
//destroying the session and redirecting to index.php.

session_start();
session_destroy();
header('location:index.php');
?>