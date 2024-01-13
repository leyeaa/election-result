<?php
error_reporting(0);
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
$database = "presidential_election";
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



function lg_name($lg_code){
$sql1="SELECT * FROM lg WHERE lg_code='$lg_code'";
	$result1=mysql_query($sql1)or die(mysql_error());
	$rows1=mysql_fetch_array($result1);
	$lg_name=stripslashes(strtoupper($rows1["lg_name"]));
	return $lg_name;	
}

function ward_name($ward_code){
$sql1="SELECT * FROM ward WHERE ward_code='$ward_code'";
	$result1=mysql_query($sql1)or die(mysql_error());
	$rows1=mysql_fetch_array($result1);
	$ward_name=stripslashes(strtoupper($rows1["ward_name"]));
	return $ward_name;	
}



function insert_security($state_unit_code,$sender,$security_message){
$sqlp="SELECT * FROM polling_unit WHERE state_unit_code='$state_unit_code'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_name=addslashes($rowp['unit_name']);
	  $unit_code=$rowp['unit_code'];
	  $state_code=substr($unit_code,0,2);
	  $lg_code=substr($unit_code,0,4);
	  $ward_code=substr($unit_code,0,6);
	  //----------------------------
	  $sql1="SELECT * FROM state WHERE state_code='$state_code'";
	  $result1=mysql_query($sql1) or die(mysql_error());
	  $rows1=mysql_fetch_array($result1);
	  $state_security_number=$rows1["security_number"];
	  //---------------------------------------------------------------
	  $sql2="SELECT * FROM ward WHERE ward_code='$ward_code'";
	  $result2=mysql_query($sql2) or die(mysql_error());
	  $rows2=mysql_fetch_array($result2);
	  $ward_name=addslashes($rows2["ward_name"]);
	  $ward_security_number=$rows2["security_number"];
	  //------------------------------------------------
	  $sql3="SELECT * FROM lg WHERE lg_code='$lg_code'";
	  $result3=mysql_query($sql3) or die(mysql_error());
	  $rows3=mysql_fetch_array($result3);
	  $lg_name=$rows3["lg_name"];
	  $lg_security_number=$rows3["security_number"];
	  
          $state_security_message="from LG:$lg_name,W:$ward_name,P:$unit_name - $security_message";  
	      $sq="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$state_security_number',MessageText='$state_security_message'"; // for state
	      mysql_query($sq) or die(mysql_error());
	       
		  $lg_security_message="from W:$ward_name,P:$unit_name - $security_message";
	  	  $sq1="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$lg_security_number',MessageText='$lg_security_message'";
	      mysql_query($sq1) or die(mysql_error());
		  
	      $ward_security_message="from $unit_name - $security_message";
	      $sq2="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$ward_security_number',MessageText='$ward_security_message'";
	      mysql_query($sq2) or die(mysql_error());
}
    
	function send_message($sender,$receiver,$msg_in){
	$sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	mysql_query($sql) or die(mysql_error());		
	}
	         
?>