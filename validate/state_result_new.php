<?php 
include("../db/db.php");
/*$string = "This is some text and numbers 12345 and symbols !£$%^&";
$new_string = ereg_replace("[^A-Za-z0-9]", "", $string);
echo $new_string;*/

$sql="SELECT * FROM messagein"; // WHERE status=1";
$result=mysql_query($sql) or die(mysql_error());
while($rows=mysql_fetch_array($result)){	
$msg2=$rows['MessageText'];
$receiver=$rows['MessageFrom'];
$sender="Election";  
$id=$rows['Id'];
$senttime=$rows['SendTime'];
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$state_unit_code=trim(addslashes($arry_msg2[0])); //unit_code from here
$to_know=trim(strtoupper($arry_msg2[1])); // what message
$security_message=trim(addslashes($arry_msg2[2])); // what message
            			
       //-----check where the massage is from phone number GSM operators
	   $len_number=strlen($rows['MessageFrom']);
       if($len_number < 15)
	   {
	   $sqld="DELETE FROM messagein WHERE Id='$id'";
       mysql_query($sqld) or die(mysql_error);   
	   }
       		
	  $len=strlen($state_unit_code);				   
	 if($len == 4){  
      $sqlp="SELECT * FROM polling_unit WHERE state_unit_code='$state_unit_code'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_name=addslashes($rowp['unit_name']);
	  $unit_code=$rowp['unit_code'];
	  $state_code=substr($unit_code,0,2);
	  $lg_code=substr($unit_code,0,4);
	  $ward_code=substr($unit_code,0,6);
//--------------------------------------------------------------------------------------------------------------------------------------
	    if($to_know=="SR") //\\
		 {
			 
         insert_security($state_unit_code,$sender,$security_message);
		 $sqly="INSERT INTO security SET unit_code='$unit_code',unit_name='$unit_name',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver',security_message='$security_message'";
	   mysql_query($sqly) or die(mysql_error());
	     //send message 
	     $msg="Thank you, security report recieved";
		 $sql="INSERT INTO messageout SET MessageFrom ='$receiver',MessageTo ='$sender',MessageText ='$msg'";
		 mysql_query($sql) or die(mysql_error());		  
		 //Delete from Message In
	     $sqld="DELETE FROM messagein WHERE Id='$id'";
         mysql_query($sqld) or die(mysql_error);  
		 break;
		 }//\\
//----------------------------------------------------------------------------  PVC ------------------------------------------------------------
	  if($to_know=="PVC") //pvc
		 {
			$PVC=trim($arry_msg2[2]);
		    $sql_t="SELECT * FROM result WHERE unit_code='$unit_code'";  
	        $result_t=mysql_query($sql_t) or die("check"); 
	        if($rows_t=mysql_fetch_array($result_t))
	         {
			  $sqlb ="UPDATE result SET PVC='$PVC' WHERE unit_code='$unit_code'";
			  mysql_query($sqlb) or die(mysql_error());	 
			  //--
			  $sqld="DELETE FROM messagein WHERE Id='$id'";
			  mysql_query($sqld) or die(mysql_error);
			 }
			 else
			 {
			 //-----
			 $msg_in="Thank you, number of PVC send is $PVC";
			 $sql="INSERT INTO messageout SET MessageFrom ='$receiver',MessageTo ='$sender',MessageText ='$msg_in'";
			 mysql_query($sql) or die(mysql_error());
			 //---
			$sqly="INSERT INTO result SET unit_code='$unit_code',unit_name='$unit_name',PVC='$PVC',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver'";
	        mysql_query($sqly) or die(mysql_error());
			//Delete from Message In
	        $sqld="DELETE FROM messagein WHERE Id='$id'";
            mysql_query($sqld) or die(mysql_error);  
			 }		 
		 break;
		 }//pvc
		 
//------------------------------------------------------------------------- AV--------------------------------------------------------------------
  if($to_know=="AV") //av accredited vote
		 {
			$AV=trim($arry_msg2[2]);
		    $sql_t="SELECT * FROM result WHERE unit_code='$unit_code'";  
	        $result_t=mysql_query($sql_t) or die("check"); 
	        if($rows_t=mysql_fetch_array($result_t))
	         {
			      if($rows_t['AV']==0){
				  $msg_in="Thank you, the number of Accredited Voters send to us is $AV"; 
				  }
				  else{
					$msg_in="Thank you, duplicate entry last AV is taking $AV"; 
				   }
			   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	           mysql_query($sql) or die(mysql_error());
			   //send_message($sender,$receiver,$msg_in); 
			   $sqlb ="UPDATE result SET AV='$AV' WHERE unit_code='$unit_code'";
			   mysql_query($sqlb) or die(mysql_error());
			   //--
			   $sqld="DELETE FROM messagein WHERE Id='$id'";
			   mysql_query($sqld) or die(mysql_error);	 
			 }
			 else
			 {
			$sqly="INSERT INTO result SET unit_code='$unit_code',unit_name='$unit_name',AV='$AV',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver'";
	        mysql_query($sqly) or die(mysql_error());
			//send message -----------
			$msg_in="Thank you, the number of Accredited Voters send to us is $AV";
	        $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	        mysql_query($sql) or die(mysql_error());
			//Delete from Message In
	        $sqld="DELETE FROM messagein WHERE Id='$id'";
            mysql_query($sqld) or die(mysql_error);  
			 }		 
		 break;
		 }//pvc
//---------------------------------------------------------------------------------------------------------------------------------------------	 
	  if($to_know=="AT") //arival time
		 {
			$arival_time=trim($arry_msg2[2]);
		    $sql_t="SELECT * FROM arival_time WHERE unit_code='$unit_code'";  
	        $result_t=mysql_query($sql_t) or die("check"); 
	        if($rows_t=mysql_fetch_array($result_t))
	         {
				    
			  //-----------------	 
			  $sqlb ="UPDATE arival_time SET arival_time='$arival_time' WHERE unit_code='$unit_code'";
			  mysql_query($sqlb) or die(mysql_error());
			  //--------------
			  $sqld="DELETE FROM messagein WHERE Id='$id'";
			  mysql_query($sqld) or die(mysql_error);	 
			 }
			 else
			 {
			//-----------------------------------
			$msg_in="Thank you, arival time get to us.";
	        $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	        mysql_query($sql) or die(mysql_error());
			//----------
			$sqly="INSERT INTO arival_time SET unit_code='$unit_code',unit_name='$unit_name',arival_time='$arival_time',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver'";
	        mysql_query($sqly) or die(mysql_error());
			//Delete from Message In
	        $sqld="DELETE FROM messagein WHERE Id='$id'";
            mysql_query($sqld) or die(mysql_error);  
			 }		 
		 break;
		 }//arival time

//============================================================================================================================ Ballot paper
	  if($to_know=="BP") //ballot paper
		 {
			$bpaper=trim($arry_msg2[2]);
		    $sql_t="SELECT * FROM bpaper WHERE unit_code='$unit_code'";  
	        $result_t=mysql_query($sql_t) or die("check"); 
	        if($rows_t=mysql_fetch_array($result_t))
	         {
			  $sqlb ="UPDATE bpaper SET bpaper='$bpaper' WHERE unit_code='$unit_code'";
			  mysql_query($sqlb) or die(mysql_error());	 
			  //--
			  $sqld="DELETE FROM messagein WHERE Id='$id'";
			  mysql_query($sqld) or die(mysql_error);
			 }
			 else
			 {
			 //-----
			 $msg_in="Thank you, Ballot Paper received";
			 $sql="INSERT INTO messageout SET MessageFrom ='$receiver',MessageTo ='$sender',MessageText ='$msg_in'";
			 mysql_query($sql) or die(mysql_error());
			 //---
			$sqly="INSERT INTO bpaper SET unit_code='$unit_code',unit_name='$unit_name',bpaper='$bpaper',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver'";
	        mysql_query($sqly) or die(mysql_error());
			//Delete from Message In
	        $sqld="DELETE FROM messagein WHERE Id='$id'";
            mysql_query($sqld) or die(mysql_error);  
			 }		 
		 break;
		 }//ballo paper

//-------------------------------------- form R8 ----------------------------------------------------------------------------------------------------------------------
  if($to_know=="FE") //form E8
		 {
			$forme=trim($arry_msg2[2]);
		    $sql_t="SELECT * FROM forme8 WHERE unit_code='$unit_code'";  
	        $result_t=mysql_query($sql_t) or die("check"); 
	        if($rows_t=mysql_fetch_array($result_t))
	         {
			  $sqlb ="UPDATE forme8 SET forme='$forme' WHERE unit_code='$unit_code'";
			  mysql_query($sqlb) or die(mysql_error());	 
			  //--
			  $sqld="DELETE FROM messagein WHERE Id='$id'";
			  mysql_query($sqld) or die(mysql_error);
			 }
			 else
			 {
			 //-----
			 $msg_in="Thank you, Form E 8 received";
			 $sql="INSERT INTO messageout SET MessageFrom ='$receiver',MessageTo ='$sender',MessageText ='$msg_in'";
			 mysql_query($sql) or die(mysql_error());
			 //---
			$sqly="INSERT INTO forme8 SET unit_code='$unit_code',unit_name='$unit_name',forme='$forme',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver'";
	        mysql_query($sqly) or die(mysql_error());
			//Delete from Message In
	        $sqld="DELETE FROM messagein WHERE Id='$id'";
            mysql_query($sqld) or die(mysql_error);  
			 }		 
		 break;
		 }//










	  	  
	   if($fd==0)///-----  count  the number of ----------------------
		  {  	  
	      $sqlb="INSERT INTO all_messagein SET MessageFrom='$receiver',MessageText='$msg2'"; // check this to add reciver phpne 
	      mysql_query($sqlb) or die(mysql_error());
	      //-------------------------------------------------------------
		  //Delete from Message In
	      $sqld="DELETE FROM messagein WHERE Id='$id'";
          mysql_query($sqld) or die(mysql_error);  
		  } 
		  else
		  {
		//APC length is 3
		$APCN=$arry_msg2[1];	  
		$APC=strtoupper(SUBSTR($APCN,0,3));
		//$APC_score=SUBSTR($APCN,0,3);
		$APC_score=preg_replace("/[^0-9]/", "", $arry_msg2[1]);
		//LP length is 2
		$LPN=$arry_msg2[2];	  
		$LP=strtoupper(SUBSTR($LPN,0,2));
		$LP_score= preg_replace("/[^0-9]/", "", $arry_msg2[2]);
		//PDP length is 3
		$PDPN=$arry_msg2[3];	  
		$PDP=strtoupper(SUBSTR($PDPN,0,3));
		$PDP_score=preg_replace("/[^0-9]/", "", $arry_msg2[3]);
		//SDP length is 3
		$SDPN=$arry_msg2[4];	  
		$SDP=strtoupper(SUBSTR($SDPN,0,3));
		$SDP_score=preg_replace("/[^0-9]/", "", $arry_msg2[4]);
		
		
      
	  $sql_t="SELECT * FROM result WHERE unit_code='$unit_code'";  
	  $result_t=mysql_query($sql_t) or die("check"); 
	  
	  if($rows_t=mysql_fetch_array($result_t))
	  {
	   //true
	                       $RES=$rows_t['APC']+$rows_t['LP']+$rows_t['PDP']+$rows_t['SDP'];
			               if($RES == 0){
							  
						   $msg_in="Thank you we have recieved your result $state_unit_code*APC$APC_score*LP$LP_score*PDP$PDP_score*SDP$SDP_score";      
						   }
						   else{
						   $msg_in="Duplicate Entry, but last Message is taking: $state_unit_code*APC$APC_score*LP$LP_score*PDP$PDP_score*SDP$SDP_score";
						   
						   }
			
			 $sql="INSERT INTO messageout SET MessageFrom ='$receiver',MessageTo ='$sender',MessageText ='$msg_in'";
			 mysql_query($sql) or die(mysql_error());
			   //--------------------------------
	         $sqly="UPDATE result SET APC='$APC_score',LP='$LP_score',PDP='$PDP_score',SDP='$SDP_score' WHERE unit_code='$unit_code'";
	         mysql_query($sqly) or die(mysql_error()); 
			  //------------------------------------- 
			 $sqld="DELETE FROM messagein WHERE Id='$id'";
			 mysql_query($sqld) or die(mysql_error); 	        	 
	  }
	  else{ //88 
	       //----format from this place
		        //if($APC == "APC" && $LP =="LP" && $PDP=="PDP")
				if($APC == "APC" && $LP =="LP" && $PDP=="PDP" && $SDP=="SDP")
				{
				 //============================== Insert into mysql database =============================
	   $status=1;
	   $sqly="INSERT INTO result SET unit_code='$unit_code',unit_name='$unit_name',APC='$APC_score',LP='$LP_score',PDP='$PDP_score',SDP='$SDP_score',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',status='$status',agent_phone='$receiver'";
	   mysql_query($sqly) or die(mysql_error());
	   //-----------------------------------------send to online
	    //$url="resultapi.php?unit_code=$unit_code&unit_name=$unit_name&ward_code=$ward_code&lg_code=$lg_code&LP=$LP_score&PDP=$PDP_score&APC=$APC_score";
   $url="http://www.ermsng.org/resultapi.php?unit_code=$unit_code&unit_name=$unit_name&ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code&PDP=$PDP_score&APC=$APC_score&LP=$LP_score";
	   //------------------------------------------end to online
	   $sqlb="INSERT INTO all_messagein SET MessageFrom='$receiver',MessageText='$msg2'";
	   mysql_query($sqlb) or die(mysql_error());
	   //-------------------------------------------------------------
	   $msg_in="Thank you we have recieved your result $state_unit_code*APC$APC_score*LP$LP_score*PDP$PDP_score*SDP$SDP_score";
	   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	   mysql_query($sql) or die(mysql_error());
		 //Delete from Message In
	   $sqld="DELETE FROM messagein WHERE Id='$id'";
       mysql_query($sqld) or die(mysql_error);
				 }
				else
				 {
				 $msg_in="Incorrect Format! Resend in this format:- $state_unit_code*APC*LP*PDP*SDP";
				 $sqlc="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
				 mysql_query($sqlc) or die(mysql_error());
				   //Delete from Message In
				 $sqld="DELETE FROM messagein WHERE Id='$id'";
				 mysql_query($sqld) or die(mysql_error);
				 
				 //=========================== insert
				  $sqlb2="INSERT INTO wrong_messagein SET MessageFrom='$receiver',MessageText='$msg2'";
	              mysql_query($sqlb2) or die(mysql_error());
				 //Delete from Message In
	             $sqld="DELETE FROM messagein WHERE Id='$id'";
                 mysql_query($sqld) or die(mysql_error);
				 	
				 }
	   
	      } //88
		    
	 
	      
		  
		  }
	  
	  }
	  else
	  {
		$msg_in="Polling Unit cant be found, check the code and resend:- $state_unit_code*APC*LP*PDP*SDP";
	             $sqlc="INSERT INTO messageout SET MessageFrom ='$sender',MessageTo ='$receiver',MessageText ='$msg_in'";
	             mysql_query($sqlc) or die(mysql_error());
				 //=========================== insert
				  $sqlb2="INSERT INTO wrong_messagein SET MessageFrom ='$receiver',MessageText ='$msg2'";
	              mysql_query($sqlb2) or die(mysql_error());
				 //Delete from Message In
	             $sqld="DELETE FROM messagein WHERE Id='$id'";
                 mysql_query($sqld) or die(mysql_error);
	  }
	  //---

/* $sqlb2="INSERT INTO wrong_messagein SET MessageFrom='$receiver',MessageText='$msg2'";
 mysql_query($sqlb2) or die(mysql_error());	  
 $sqld="DELETE FROM messagein WHERE Id='$id'";
 mysql_query($sqld) or die(mysql_error);	*/
}
 
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<iframe src="<?php echo $url;  ?>"  height="0" width="0"></iframe>

</body>
</html>