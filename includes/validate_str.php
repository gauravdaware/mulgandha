<?php
/*
Author: Gaurav Daware
Created on: 07-07-2018
Purpose: to validate user input from form
Updated on:09-07-2018
*/

function format_str($pstr){
	$rstr = strip_tags(addslashes(trim($pstr)));
	return $rstr;
}
?>