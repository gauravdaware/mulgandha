<?php
/*
	Author : Gaurav Daware
	Created_on	: 07-07-2018
	Purpose : admin logout
	Update_on : 07-07-2018
*/
//destroying the session and redirecting to index.php.
session_start();
session_destroy();
header('location:index.php');

//end
?>