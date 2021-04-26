<?php
/*
Author: Gaurav Daware
Created on: 07-07-2018
Purpose:Making connection with database famouskart
Updated on:09-07-2018
*/
date_default_timezone_set('asia/kolkata');
$con=mysqli_connect("localhost","root","root");
mysqli_select_db($con,"mulgandh_famouskart");
?>