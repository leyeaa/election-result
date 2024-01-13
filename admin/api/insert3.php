<?php 
include("../../include/database.php");
include("../../include/db_function.php");
//header("Content-Type:application/json");
//$src="empdata.json";
	//$filename = '../download/empdata.json';
	$filename = "empdata.json";
    $json = file_get_contents($filename);   
    //convert json object to php associative array
    $data = json_decode($json, true);
    // loop through the array
    foreach ($data as $row) {
        // get the employee details
		if(is_array($row)){
		$unit_name= addslashes(trim($row['unit_name'])); 
		
		
	
	$unit_code=addslashes($row['unit_code']);
	//$agent_name=addslashes($row['agent_name']);
	//$agent_phone=addslashes($row['agent_phone']);
	$state_code=addslashes($row['state_code']);
	
	$lg_code=addslashes($row['lg_code']);
	$ward_code=addslashes($row['ward_code']);
	$unit_code2=addslashes($row['unit_code2']);
	$state_unit_code=addslashes($row['state_unit_code']);
	//$no_register_voters=addslashes($row['no_register_voters']);
	
	//---------------------------------------------------------------------------
	 $sql="SELECT * FROM polling_unit3 WHERE unit_code='$unit_code'";	
     $result=$database->query($sql);
	 //$num_rows=$database->num_rows($result);
	  if($rows=$database->fetch_array($result)){
	   //Update Budget
	   //$sql="UPDATE  polling_unit SET unit_name='$unit_name',unit_code='$unit_code',agent_name='$agent_name',agent_phone='$agent_phone',state_code='$state_code',lg_code='$lg_code',ward_code='$ward_code',unit_code2='$unit_code2',state_unit_code='$state_unit_code',no_register_voters='$no_register_voters' WHERE unit_code='$unit_code'";  
       $sql="UPDATE  polling_unit3 SET unit_name='$unit_name',unit_code='$unit_code',state_code='$state_code',lg_code='$lg_code',ward_code='$ward_code',unit_code2='$unit_code2',state_unit_code='$state_unit_code' WHERE unit_code='$unit_code'";  
	   $database->query($sql);
	   }
	  else{
	   //$sql="INSERT INTO  polling_unit SET unit_name='$unit_name',unit_code='$unit_code',agent_name='$agent_name',agent_phone='$agent_phone',state_code='$state_code',lg_code='$lg_code',ward_code='$ward_code',unit_code2='$unit_code2',state_unit_code='$state_unit_code',no_register_voters='$no_register_voters'";  
       $sql="INSERT INTO  polling_unit3 SET unit_name='$unit_name',unit_code='$unit_code',state_code='$state_code',lg_code='$lg_code',ward_code='$ward_code',unit_code2='$unit_code2',state_unit_code='$state_unit_code'";
	   $database->query($sql);  
	 }
}
     //$result_id[] = $id;
	 
	 
     //echo"Thank you.";
 }
     /*$SuccessfulResponse = array("status" => "success",
     "data" => $result_id);
	 $data=json_encode(array("info" => $SuccessfulResponse));
	 
	 echo"$data";*/
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