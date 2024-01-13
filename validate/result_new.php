<?php 
include("../db/db.php");

/*$string = "This is some text and numbers 12345 and symbols !£$%^&";
$new_string = ereg_replace("[^A-Za-z0-9]", "", $string);
echo $new_string;*/

$sql="SELECT * FROM messagein"; // WHERE status=1";
$result=mysql_query($sql) or die(mysql_error());
if($rows=mysql_fetch_array($result)){
$msg2=$rows['MessageText'];
$receiver=$rows['MessageFrom'];
$sender="Election";  
$id=$rows['Id'];
$senttime=$rows['SendTime'];
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$to_know=trim(strtoupper($arry_msg2[1])); // what message
$security_message=trim(strtoupper($arry_msg2[2])); // what message

      //-----check where the massage is from GSM number or not
	   $len_number=strlen($rows['MessageFrom']);
       if($len_number < 15)
	   {
		$sqld="DELETE FROM messagein WHERE Id='$id'";
       mysql_query($sqld) or die(mysql_error);    
	   }
       //end of check

$unit_code=trim($arry_msg2[0]); //unit_code from here
      $state_code=substr($unit_code,0,2);
	  $lg_code=substr($unit_code,0,4);
	  $ward_code=substr($unit_code,0,6);

      $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit_code'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_name=addslashes($rowp['unit_name']);
	  //----------
	   if($to_know=="S") //\\
		 {
		  $phone_to="+2348033676175";
	      $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$phone_to',MessageText='$security_message'";
	      mysql_query($sql) or die(mysql_error());
		  
		   $sqly="INSERT INTO security SET unit_code='$unit_code',unit_name='$unit_name',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',agent_phone='$receiver',security_message='$security_message'";
	   mysql_query($sqly) or die(mysql_error());		  
		 //Delete from Message In
	     $sqld="DELETE FROM messagein WHERE Id='$id'";
         mysql_query($sqld) or die(mysql_error); 
		 break; 
		 }//\\
	  
	  
	  	  
	   if($fd==2)
		  {	  
	   $no_accredited= preg_replace("/[^0-9]/", "", $arry_msg2[1]); 
	   $sqly="INSERT INTO no_accredited SET  unit_code='$unit_code',unit_name='$unit_name',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',no_accredited='$no_accredited',agent_phone='$receiver'";
	   mysql_query($sqly) or die(mysql_error());
	   $url="http://www.ermsng.org/no_accredited.php?unit_code=$unit_code&unit_name=$unit_name&ward_code=$ward_code&lg_code=$lg_code&no_accredited=$no_accredited&state_code=$state_code"; //send online from here
	   //===================================== end insert =======================================
	   $sqlb="INSERT INTO all_messagein SET MessageFrom='$receiver',MessageText='$msg2'";
	   mysql_query($sqlb) or die(mysql_error());
	   //-------------------------------------------------------------
	   $msg_in="Thank you, the number of Accredited Voters send to us is $no_accredited";
	   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	   mysql_query($sql) or die(mysql_error());
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
		/*$LPN=$arry_msg2[2];	  
		$LP=strtoupper(SUBSTR($LPN,0,2));
		$LP_score= preg_replace("/[^0-9]/", "", $arry_msg2[2]);*/
		//PDP length is 3
		$PDPN=$arry_msg2[2];	  
		$PDP=strtoupper(SUBSTR($PDPN,0,3));
		$PDP_score=preg_replace("/[^0-9]/", "", $arry_msg2[2]);

      
	  $sql_t="SELECT * FROM result WHERE unit_code='$unit_code'";  
	  $result_t=mysql_query($sql_t) or die("check"); 
	  if($rows_t=mysql_fetch_array($result_t))
	  {
	   //true
			 $msg_in="There is Duplicate Entry for this Unit: $unit_name, but Last one is taking";
			 $sql="INSERT INTO messageout SET MessageFrom='$receiver',MessageTo='$sender',MessageText='$msg_in'";
			 mysql_query($sql) or die(mysql_error());	
			 //-----send back to user that there is depulicate
			 $message="There is Duplicate Entry for this Unit: $unit_name, but Last one is taking";
			   //-------------------------------------------------
			 $hh="DELETE FROM result WHERE unit_code='$unit_code'";
			 mysql_query($hh) or die(mysql_error());
			   //--------------------------------
			$status=1;
	        $sqly="INSERT INTO result SET unit_code='$unit_code',unit_name='$unit_name',APC='$APC_score',PDP='$PDP_score',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',status='$status',agent_phone='$receiver'";
	   mysql_query($sqly) or die(mysql_error()); 
			   
			  $sqld="DELETE FROM messagein WHERE Id='$id'";
			   mysql_query($sqld) or die(mysql_error); 
		        	 
	  }
	  else{ //88 
	       //----format from this place
		        //if($APC == "APC" && $LP =="LP" && $PDP=="PDP")
				if($APC == "APC"  && $PDP=="PDP")
				{
				 //============================== Insert into mysql database =============================
	   $status=1;
	   $sqly="INSERT INTO result SET unit_code='$unit_code',unit_name='$unit_name',APC='$APC_score',PDP='$PDP_score',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',status='$status',agent_phone='$receiver'";
	   mysql_query($sqly) or die(mysql_error());
	   //-----------------------------------------send to online
	    //$url="resultapi.php?unit_code=$unit_code&unit_name=$unit_name&ward_code=$ward_code&lg_code=$lg_code&LP=$LP_score&PDP=$PDP_score&APC=$APC_score";
   $url="http://www.ermsng.org/resultapi.php?unit_code=$unit_code&unit_name=$unit_name&ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code&PDP=$PDP_score&APC=$APC_score";
		//http://www.ondobudget_org/e-budget/resultapi.php
	   
	   //------------------------------------------end to online
	   //===================================== end insert =======================================
	   $sqlb="INSERT INTO all_messagein SET MessageFrom='$receiver',MessageText='$msg2'";
	   mysql_query($sqlb) or die(mysql_error());
	   //-------------------------------------------------------------
	   $msg_in="Thank you we have recieved your result $unit_code*APC$APC_score*PDP$PDP_score";
	   $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	   mysql_query($sql) or die(mysql_error());
		 //Delete from Message In
	   $sqld="DELETE FROM messagein WHERE Id='$id'";
       mysql_query($sqld) or die(mysql_error);
				 }
				else
				 {
				 $msg_in="Incorrect Format! Resend in this format:- $unit_code*APC*PDP";
	             $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	             mysql_query($sql) or die(mysql_error());
				 //Delete from Message In
	             $sqld="DELETE FROM messagein WHERE Id='$id'";
                 mysql_query($sqld) or die(mysql_error);
				 	
				 }
	   
	      } //88
		    
	 }

}
else{
	
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