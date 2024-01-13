<?php 
//========================================================================================
function state_name($state){
	global $database;
$sql1="SELECT * FROM state WHERE state_code='$state'";
	$result1=$database->query($sql1);
	$rows1=$database->fetch_array($result1);
	$state_name=stripslashes(strtoupper($rows1["state_name"]));
	return $state_name;	
}

function lg_name($lg_code){
	global $database;
$sql1="SELECT * FROM lg WHERE lg_code='$lg_code'";
	$result1=$database->query($sql1);
	$rows1=$database->fetch_array($result1);
	$lg_name=stripslashes(strtoupper($rows1["lg_name"]));
	return $lg_name;	
}

function ward_name($ward_code){
	global $database;
$sql1="SELECT * FROM ward WHERE ward_code='$ward_code'";
	$result1=$database->query($sql1);
	$rows1=$database->fetch_array($result1);
	$ward_name=stripslashes(strtoupper($rows1["ward_name"]));
	return $ward_name;	
}
//------------------------------------------------------------------------------------



?>
