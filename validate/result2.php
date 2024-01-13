<?php 
include("../db/db.php");
$id=$_GET['id']; 
$sql="SELECT * FROM messagein WHERE Id='$id'";// WHERE status=1";
$result=mysql_query($sql) or die(mysql_error());
$rows=mysql_fetch_array($result);
$msg2=$rows['MessageText'];
$sender="Election";
$receiver=$rows['MessageFrom'];
$id=$rows['Id'];
$senttime=$rows['SendTime'];
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$uid=$arry_msg2[1];
       //get polling unit from here
      $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$uid'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_id=$rowp['unit_id'];
	  $unit_name=$rowp['unit_name'];
	  $ward_id=$rowp['ward_id'];
	  $lg_id=$rowp['lg_id'];
	  
$LP=strtoupper($arry_msg2[2]);
$LP_score=$arry_msg2[3];
$APC=strtoupper($arry_msg2[4]);
$APC_score=$arry_msg2[5];
$PDP=strtoupper($arry_msg2[6]);
$PDP_score=$arry_msg2[7];



//echo"$id";
//exit;
//==============================	 
/*$sqlp= "SELECT * FROM polling_unit WHERE unit_id='$unit_id'";
	  $resultp=mysql_query($sqlp) or die(mysql_errors());
	  $rowsp=mysql_fetch_array($resultp);
	  $unit_name=$rowsp['unit_name'];
	  $lg_id=$rowsp['lg_id'];
	  $ward_id=$rowsp['ward_id'];*/
	  $sql_t="SELECT * FROM result WHERE unit_id='$unit_id'";  
	  $result_t=mysql_query($sql_t) or die("check"); 
	  if($rows_t=mysql_fetch_array($result_t))
	  {
	   //true
	   $msg_in="Duplicate Entry ! if there is any error Resend";
	   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	   mysql_query($sql) or die(mysql_error());		  
	  }
	  else{ 
	   //============================== Insert into mysql database =============================
	   $sqly="INSERT INTO result SET unit_id='$unit_id',unit_name='$unit_name',LP='$LP_score',APC='$APC_score',PDP='$PDP_score',lg_id='$lg_id',ward_id='$ward_id'";
	   mysql_query($sqly) or die(mysql_error());
	   //===================================== end insert =======================================
	   $sqlb="INSERT INTO all_messagein SET MessageFrom='$receiver',MessageText='$msg2'";
	   mysql_query($sqlb) or die(mysql_error());
	   //-------------------------------------------------------------
	   $msg_in="Thank you we have recieved your result";
	   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	   mysql_query($sql) or die(mysql_error());
		 
		 
		 //Delete from Message In
	   $sqld="DELETE FROM messagein WHERE Id='$id'";
       mysql_query($sqld) or die(mysql_error);
       
	    }
		header("location:all_messages.php");
       exit;  
		
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