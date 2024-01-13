<?php 
include("../db/db.php");
//$stat=1;
$sql="SELECT * FROM ozekimessagein";//WHERE status='1'";
$result=sqlsrv_query($dbconnect,$sql) or die(sqlsrv_errors());
//$i=1;
while($rows=sqlsrv_fetch_array($result)){

$msg2=$rows['msg'];
//$sender=$rows['receiver'];
$sender="Ondo Election";
$receiver=$rows['sender'];
$id=$rows['id'];
$senttime=$rows['senttime'];
//$msg2="*5*LP*590*LP*293*PDP*214*"; // *24*LP56*APC67*PDP90*
//$msg2=  "*SE*2*1*";
      $blow=explode("*",$msg2);
      $sefirst=$blow[1];
      if($sefirst=="SE")
	  {
      $sepoll=$blow[2];  
      $selevel=$blow[3];//echo eecho xit;echo "<br>";echo "<br>";
      $sqlzp= "SELECT * FROM polling_unit WHERE unit_id='$sepoll'";
	  $resulzp=sqlsrv_query($dbconnect,$sqlzp) or die(sqlsrv_errors());
	  $rowzp=sqlsrv_fetch_array($resulzp);
	  //$unit_namez=$rowzp['unit_name'];
	  $lgz_id=$rowzp['lg_id'];
	 // $wardz_id=$rowzp['ward_id'];echo  
	  $stat=0;
	  $sql_inz="INSERT INTO security (security_code,unit_id,security_level,lg_id,status) VALUES(?,?,?,?,?)";//echo  exit;
	  $params = array($sefirst,$sepoll,$selevel,$lgz_id,$stat);
	  sqlsrv_query($dbconnect,$sql_inz,$params) or die ("tryaaa");
	  //===============================
	  	$status="Send";
		$msg="Your security report has been recieved, thank you";
		$sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	    $params = array($sender,$receiver,$msg,$status);
	    sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());
	  //===========================Delete=============
	  $sqld="DELETE FROM ozekimessagein WHERE id ='$id'";
      sqlsrv_query($dbconnect,$sqld) or die("can not delete"); 
      }
      else
	  {	  
	  //* //result
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
   if(strtolower($msg2)=="result") // this place if there any error
	{
	   $total_sum_LP=0;
	   $total_sum_PDP=0;
	   $total_sum_APC=0;
	   $LP="LP";
	   //$sql_LP="SELECT SUM(score) AS sum_score_LP FROM scores WHERE party_sign='$LP' AND lg_id='$lg_id'";
	   $sql_LP="SELECT SUM(LP) AS sum_LP FROM result";
	   $result_LP=sqlsrv_query($dbconnect,$sql_LP) or die(sqlsrv_errors());
	   $rows_LP=sqlsrv_fetch_array($result_LP);
	   $sum_LP=$rows_LP['sum_LP'];
	   $sum_LP2=number_format($sum_LP);
	   //=================================================================
	   $PDP="PDP";
	  //$sql_PDP="SELECT SUM(score) AS sum_score_PDP FROM scores WHERE party_sign='$PDP' AND lg_id='$lg_id'";
	   $sql_PDP="SELECT SUM(PDP) AS sum_PDP FROM result";
	   $result_PDP=sqlsrv_query($dbconnect,$sql_PDP) or die(sqlsrv_errors());
	   $rows_PDP=sqlsrv_fetch_array($result_PDP);
	   $sum_PDP=$rows_PDP['sum_PDP'];
	   $sum_PDP2=number_format($sum_PDP);
	   //=================================================================
	   $APC="APC";
	   //$sql_APC="SELECT SUM(score) AS sum_score_APC FROM scores WHERE party_sign='$APC' AND lg_id='$lg_id'";
	   $sql_APC="SELECT SUM(APC) AS sum_APC FROM result";
	   $result_APC=sqlsrv_query($dbconnect,$sql_APC) or die(sqlsrv_errors());
	   $rows_APC=sqlsrv_fetch_array($result_APC);
	   $sum_APC=$rows_APC['sum_APC'];
	   $sum_APC2=number_format($sum_APC);
	   //==================================

		$total_result="APC = $sum_APC2, LP = $sum_LP2, PDP = $sum_PDP2"."" ." --- ". "The results recieved so far";
		$status="Send";
		$sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	    $params = array($sender,$receiver,$total_result,$status);
	    sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());
		//=======================Delete========================
		$sqld="DELETE FROM ozekimessagein WHERE id ='$id'";
        sqlsrv_query($dbconnect,$sqld) or die("can not delete");
	}
   elseif($fd<9 || $fd>9)
    {
     $msg="Invalid Entry, please resend";
	 $status="Send";
	 //$sender="+2347038809073";
	 //$receiver="+2347037846503";
     $sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	 $params = array($sender,$receiver,$msg,$status);
	 sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors());	
	 //=================================== Delete from=========================== 
	 $sqld="DELETE FROM ozekimessagein WHERE id ='$id'";
     sqlsrv_query($dbconnect,$sqld) or die("can not delete");	
	 
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
	 /*//==================insert into wroung messages ====================
	 $sqli="INSERT INTO wrong_messages (sender,senttime,msg) VALUES(?,?,?)"; 
	 $paramsi=array($sender,$senttime,$msg);
	 sqlsrv_query($dbconnect,$sqli,$paramsi) or die(sqlsrv_errors());*/	
	 //=================================== Delete from 
	 $sqld="DELETE FROM ozekimessagein WHERE id ='$id'";
     sqlsrv_query($dbconnect,$sqld) or die("can not delete");
	 	
	 
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
	 //=================================== Delete from 
	 $sqld="DELETE FROM ozekimessagein WHERE id ='$id'";
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
	  $sql_t="SELECT * FROM result WHERE unit_id='$unit_id'";
	  $result_t=sqlsrv_query($dbconnect,$sql_t) or die("check");
	  if($rows_t=sqlsrv_fetch_array($result_t)){
			  
	  }
	  else{ 
	  //===========================================	
	   $sql_in="INSERT INTO result (unit_id,unit_name,LP,APC,PDP,lg_id,ward_id) VALUES(?,?,?,?,?,?,?)";
	   $params = array($unit_id,$unit_name,$LP_score,$APC_score,$PDP_score,$lg_id,$ward_id);
	   sqlsrv_query($dbconnect,$sql_in,$params) or die ("try oo");
	   //===========================================================
	   $msg_in="Thank you we have recieved your result";
	   $status="Send";
	   $sql="INSERT INTO ozekimessageout (sender,receiver,msg,status) VALUES(?,?,?,?)";
	   $params = array($sender,$receiver,$msg_in,$status);
	   sqlsrv_query($dbconnect,$sql,$params) or die(sqlsrv_errors()); 	
	}
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