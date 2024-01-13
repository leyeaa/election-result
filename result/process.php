<?php 
include("../db/db.php");
//$stat=1;
$sql="SELECT * FROM MessageIn WHERE status=1";
$result=sqlsrv_query($dbconnect,$sql) or die(sqlsrv_errors());
//$i=1;
while($rows=sqlsrv_fetch_array($result)){

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
	  $resulp=sqlsrv_query($dbconnect,$sqlp) or die(sqlsrv_errors());
	  $rowp=sqlsrv_fetch_array($resulp);
	  $unit_id=$rowp['unit_id'];
	  $ward_id=$rowsp['ward_id'];
	  $lg_id=$rowsp['lg_id'];


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
	 	$sql_inz="INSERT INTO security (unit_id,unit_name,ward_id,lg_id,status) VALUES(?,?,?,?,?)";//echo  exit;
	  $params = array($unit_id,$unit_name,$ward_id,$lg_id,$stat);
	  sqlsrv_query($dbconnect,$sql_inz,$params) or die ("tryaaa");
	  //====================
	  	$sqld="DELETE FROM MessageIn WHERE Id ='$id'";
        sqlsrv_query($dbconnect,$sqld) or die("can not delete");
	  //========== insert into mysql database security =============
/*	   $sqly="INSERT INTO security SET security_code='$sefirst',unit_id='$unit_id,security_level='$selevel',lg_id='$lgz_id',status='$stat'";
	   mysql_query($sqly) or die(mysql_error());*/	
	}   
    elseif($fd<9 || $fd>9)
    {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	 //$receiver="+2347037846503";
     $sql="INSERT INTO MessageOut (MessageFrom,MessageTo,MessageText,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	
	 //=================================== Delete from=========================== 
	 $sqld="DELETE FROM MessageIn WHERE Id ='$id'";
     sqlsrv_query($dbconnect,$sqld) or die("can not delete");	
	 
  }  
  elseif(!is_numeric($unit_id) || !is_numeric($LP_score) || !is_numeric($APC_score) || !is_numeric($PDP_score))
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	// $receiver="+2347037846503";
     $sql="INSERT INTO MessageOut (MessageFrom,MessageTo,MessageText,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	
	 //=================================== Delete from 
	 $sqld="DELETE FROM MessageIn WHERE Id ='$id'";
     sqlsrv_query($dbconnect,$sqld) or die("can not delete");
	 	
	 
  }
  elseif($LP!="LP" || $APC!="APC" || $PDP!="PDP")
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	 //$receiver="+2347037846503";
     $sql="INSERT INTO MessageOut (MessageFrom,MessageTo,MessageText,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	
	 //=================================== Delete from 
	 $sqld="DELETE FROM MessageIn WHERE Id ='$id'";
     sqlsrv_query($dbconnect,$sqld) or die("can not delete"); 
  }
  else
    {	
	  $sqlp= "SELECT * FROM polling_unit WHERE unit_id='$unit_id'";
	  $resultp=sqlsrv_query($dbconnect,$sqlp) or die(sqlsrv_errors());
	  $rowsp=sqlsrv_fetch_array($resultp);
	  $unit_name=$rowsp['unit_name'];
	  $lg_id=$rowsp['lg_id'];
	  $ward_id=$rowsp['ward_id'];
	  $sql_t="SELECT * FROM result WHERE unit_id='$unit_id'";      // this check if the unit code exit before
	  $result_t=sqlsrv_query($dbconnect,$sql_t) or die("check"); 
	  if($rows_t=sqlsrv_fetch_array($result_t)){		  
	  }
	  else{ 
	  //========================== insert in=================	
	                      
	  
	   $sql_in="INSERT INTO result (unit_id,unit_name,LP,APC,PDP,lg_id,ward_id) VALUES(?,?,?,?,?,?,?)";
	   $params = array($unit_id,$unit_name,$LP_score,$APC_score,$PDP_score,$lg_id,$ward_id);
	   sqlsrv_query($dbconnect,$sql_in,$params) or die ("trygggg");
	   //============================== Insert into mysql database =============================
	   $sqly="INSERT INTO result SET unit_id='$unit_id',unit_name='$unit_name',LP='$LP_score',APC='$APC_score',PDP='$PDP_score',lg_id='$lg_id',ward_id='$ward_id'";
	   mysql_query($sqly) or die(mysql_error());
	   //===================================== end insert =======================================
	   $msg_in="Thank you we have recieved your result";
	   $status="Send";
	   $sql="INSERT INTO MessageOut (sender,receiver,msg,status) VALUES(?,?,?,?)";
	   $params = array($sender,$receiver,$msg_in,$status);
	   sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors()); 
	    	
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