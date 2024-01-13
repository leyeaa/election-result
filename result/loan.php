<?php 
include("../db/db.php");
//$stat=1;
$sql="SELECT * FROM messagein";// WHERE status=1";
$result=mysql_query($sql) or die(mysql_error());
//$i=1;
while($rows=mysql_fetch_array($result)){
$msg2=$rows['MessageText'];
$sender="Election"; // $rows['MessageFrom'];
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
	  $ward_id=$rowp['ward_id'];
	  $lg_id=$rowp['lg_id'];
      $unit_name=$rowp['unit_name'];

$LP=strtoupper($arry_msg2[2]);
$LP_score=$arry_msg2[3];
$APC=strtoupper($arry_msg2[4]);
$APC_score=$arry_msg2[5];
$PDP=strtoupper($arry_msg2[6]);
$PDP_score=$arry_msg2[7];
//==============================	 

    if($fd ==2){
		$stat="Send";
		$report=$arry_msg2[2];
		$sql_inz="INSERT INTO security_report SET unit_id='$unit_id',unit_name='$unit_name',ward_id='$ward_id',lg_id='$lg_id',report='$report'";
	    mysql_query($sql_inz) or die ("tryaaa");
	  //====================
	  	$sqld="DELETE FROM messagein WHERE Id ='$id'";
        mysql_query($sqld) or die("can not delete");

	}   
    elseif($fd<9 || $fd>9)
    {
     $msg="Invalid Entry, please resend";
	 $status="Send";

	 $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg'";
	 mysql_query($sql) or die(mysql_errors());	
	 //=================================== Delete from=========================== 
	 $sqld="DELETE FROM messagein WHERE Id ='$id'";
     mysql_query($sqld) or die("can not delete");	
	 
  }  
  elseif(!is_numeric($unit_id) || !is_numeric($LP_score) || !is_numeric($APC_score) || !is_numeric($PDP_score))
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	
	 $sql="INSERT INTO  messageout SET MessageFrom ='$sender',MessageTo='$receiver',MessageText='$msg'";
	 mysql_query($sql) or die(mysql_errors());	
	 //=================================== Delete from 
	 $sqld="DELETE FROM messagein WHERE Id ='$id'";
     mysql_query($sqld) or die("can not delete");
	 	
	 
  }
  elseif($LP!="LP" || $APC!="APC" || $PDP!="PDP")
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	
	 $sql="INSERT INTO  messageout SET MessageFrom ='$sender',MessageTo='$receiver',MessageText='$msg'";
	 mysql_query($sql) or die(mysql_errors());	
	 //=================================== Delete from 
	 $sqld="DELETE FROM messagein WHERE Id ='$id'";
     mysql_query($sqld) or die("can not delete"); 
  }
  else
    {	
	  $sqlp= "SELECT * FROM polling_unit WHERE unit_id='$unit_id'";
	  $resultp=mysql_query($sqlp) or die(mysql_errors());
	  $rowsp=mysql_fetch_array($resultp);
	  $unit_name=$rowsp['unit_name'];
	  $lg_id=$rowsp['lg_id'];
	  $ward_id=$rowsp['ward_id'];
	  $sql_t="SELECT * FROM result WHERE unit_id='$unit_id'";      // this check if the unit code exit before
	  $result_t=mysql_query($sql_t) or die("check"); 
	  if($rows_t=mysql_fetch_array($result_t)){		  
	  }
	  else{ 
	  //========================== insert in=================	
	                      
	 
	   //============================== Insert into mysql database =============================
	   $sqly="INSERT INTO result SET unit_id='$unit_id',unit_name='$unit_name',LP='$LP_score',APC='$APC_score',PDP='$PDP_score',lg_id='$lg_id',ward_id='$ward_id'";
	   mysql_query($sqly) or die(mysql_error());
	   //===================================== end insert =======================================
	   $msg_in="Thank you we have recieved your result";
	   $status="Send";
	   	 $sql="INSERT INTO  messageout SET MessageFrom ='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	     mysql_query($sql) or die(mysql_errors());
	    	
	}
 }    
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