<?php
//error_reporting(0);
/* function lg_name($lg_id){  
			      $sql= "SELECT * FROM lg WHERE lg_id='$lg_id'";
                  $result=sqlsrv_query($sql) or die(sqlsrv_error());	
                  $rows=sqlsrv_fetch_array($result);
                  $lg_name=$rows['lg_name'];
				  return $lg_name;
				  }*/

//============================================================= Connect to mysl_database=======================
$server2 = "localhost";
$user = "root";
$password = "";
$database = "nigeria_election";
$con = mysql_connect($server2, $user, $password, $database);
mysql_select_db($database) or die("Cant't Select Database");

//========================================================================================
function state_name($state){
$sql1="SELECT * FROM state WHERE state_code='$state'";
	$result1=mysql_query($sql1)or die(mysql_error());
	$rows1=mysql_fetch_array($result1);
	$state_name=stripslashes(strtoupper($rows1["state_name"]));
	return $state_name;	
}

            
?>