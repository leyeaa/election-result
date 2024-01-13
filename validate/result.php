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

//$msg2="1234*LP890*ACP789*PDP899";
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);

      $unit_code=trim($arry_msg2[0]); //unit_id from here
      $state_code=substr($unit_code,0,2);
	  $lg_code=substr($unit_code,0,4);
	  $ward_code=substr($unit_code,0,6);

		   //LP length is 2
		$LPN=$arry_msg2[1];	  
		$LP=strtoupper(SUBSTR($LPN,0,2));
		$LP_score= preg_replace("/[^0-9]/", "", $arry_msg2[1]);
		
		//APC length is 3
		$APCN=$arry_msg2[2];	  
		$APC=strtoupper(SUBSTR($APCN,0,3));
		//$APC_score=SUBSTR($APCN,0,3);
		$APC_score=preg_replace("/[^0-9]/", "", $arry_msg2[2]);
		
		//PDP length is 3
		$PDPN=$arry_msg2[3];	  
		$PDP=strtoupper(SUBSTR($PDPN,0,3));
		$PDP_score=preg_replace("/[^0-9]/", "", $arry_msg2[3]);

//--------------------------------------------------------------------------------
	  $sql_t="SELECT * FROM result WHERE unit_code='$unit_code'";  
	  $result_t=mysql_query($sql_t) or die("check"); 
	  if($rows_t=mysql_fetch_array($result_t))
	  {
	   //true
	   $msg_in="Duplicate Entry ! Call 080........";
	   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	   mysql_query($sql) or die(mysql_error());	
	   //-----send back to user that there is depulicate
	   $message="There is Duplicate Entry in for this Unit: $unit_name";
	   header("location:all_messages.php?message=$message");
	   exit;
	   	  
	  }
	  else{ 
	   //============================== Insert into mysql database =============================
	   $sqly="INSERT INTO result SET unit_code='$unit_code',unit_name='$unit_name',LP='$LP_score',APC='$APC_score',PDP='$PDP_score',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code'";
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