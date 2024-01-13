<?php 
include("../../include/database.php");
include("../../include/db_function.php");

	//$id = addslashes($row['id']);
	$unit_name= addslashes(trim($_GET['unit_name']));
	$unit_code=addslashes($_GET['unit_code']);
	$agent_name=addslashes($_GET['agent_name']);
	$agent_phone=addslashes($_GET['agent_phone']);
	$state_code=addslashes($_GET['state_code']);
	
	$lg_code=addslashes($_GET['lg_code']);
	$ward_code=addslashes($_GET['ward_code']);
	$unit_code2=addslashes($_GET['unit_code2']);
	$state_unit_code=addslashes($_GET['state_unit_code']);
	$no_register_voters=addslashes($_GET['no_register_voters']);
	
	//---------------------------------------------------------------------------
	 $sql="SELECT * FROM polling_unit WHERE unit_code='$unit_code'";	
     $result=$database->query($sql);
	 //$num_rows=$database->num_rows($result);
	  if($rows=$database->fetch_array($result)){
	   //Update Budget
	   $sql="UPDATE  polling_unit SET unit_name='$unit_name',unit_code='$unit_code',agent_name='$agent_name',agent_phone='$agent_phone',state_code='$state_code',lg_code='$lg_code',ward_code='$ward_code',unit_code2='$unit_code2',state_unit_code='$state_unit_code',no_register_voters='$no_register_voters' WHERE unit_code='$unit_code'";  
       $database->query($sql);
	   }
	  else{
	   $sql="INSERT INTO  polling_unit SET unit_name='$unit_name',unit_code='$unit_code',agent_name='$agent_name',agent_phone='$agent_phone',state_code='$state_code',lg_code='$lg_code',ward_code='$ward_code',unit_code2='$unit_code2',state_unit_code='$state_unit_code',no_register_voters='$no_register_voters'";  
       $database->query($sql);  
	 }

    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>