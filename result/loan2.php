<?php 
include("../db/db.php");
//$stat=1;
$sql="SELECT * FROM ozekimessagein WHERE status='1'";
$result=sqlsrv_query($dbconnect,$sql) or die(sqlsrv_errors());
//$i=1;
while($rows=sqlsrv_fetch_array($result)){

$msg2=$rows['msg'];
$sender=$rows['sender'];
$receiver=$rows['receiver'];

//$msg2="*x*LP*590*LP*293*PDP*214*"; // *24*LP56*APC67*PDP90*

$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$unit_id=$arry_msg2[1];
$LP=$arry_msg2[2];
$LP_score=$arry_msg2[3];
$APC=$arry_msg2[4];
$APC_score=$arry_msg2[5];
$PDP=$arry_msg2[6];
$PDP_score=$arry_msg2[7];
//==============================
  if($fd<9 || $fd>9)
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	 //$receiver="+2347037846503";
     $sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	
  }  
  elseif(!is_numeric($unit_id) || !is_numeric($LP_score) || !is_numeric($APC_score) || !is_numeric($PDP_score))
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	// $receiver="+2347037846503";
     $sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	 
  }
  elseif($LP!="LP" || $APC!="APC" || $PDP!="PDP")
  {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	 //$receiver="+2347037846503";
     $sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	
  }
  else
    {	
	  $sqlp= "SELECT * FROM polling_unit WHERE unit_id='$unit_id'";
	  $resultp=sqlsrv_query($dbconnect,$sqlp) or die(sqlsrv_errors());
	  $rowsp=sqlsrv_fetch_array($resultp);
	  $unit_name=$rowsp['unit_name'];
	  $lg_id=$rowsp['lg_id'];
	  $ward_id=$rowsp['ward_id'];
	  $sql_t="SELECT * FROM result WHERE unit_id='$unit_id'";
	  $result_t=sqlsrv_query($dbconnect,$sql_t) or die("check");
	  if($rows_t=sqlsrv_fetch_array($result_t)){
			  
	  }
	  else{
	  //========= Insert Into Database Scores =========================================================
	   /*$sql_in="INSERT INTO scores (unit_id,unit_name,party_sign,score,lg_id,ward_id) VALUES(?,?,?,?,?,?)";
	   $params = array($unit_id,$unit_name,$party_sign,$score,$lg_id,$ward_id);
	   sqlsrv_query($dbconnect,$sql_in,$params) or die ("insert");*/
	   
	  //===========================================	
	   $sql_in="INSERT INTO result (unit_id,unit_name,LP,APC,PDP,lg_id,ward_id) VALUES(?,?,?,?,?,?,?)";
	   $params = array($unit_id,$unit_name,$LP_score,$APC_score,$PDP_score,$lg_id,$ward_id);
	   sqlsrv_query($dbconnect,$sql_in,$params) or die ("try"); 	
	  }
    }
	  
	  
	  


}

//}
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