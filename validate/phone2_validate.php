<?php 
//error_reporting(0);
include("../db/db.php");

/*$string = "This is some text and numbers 12345 and symbols !£$%^&";
$new_string = ereg_replace("[^A-Za-z0-9]", "", $string);
echo $new_string;*/

$sql="SELECT * FROM messagein"; // WHERE status=1";
$result=mysql_query($sql) or die(mysql_error());
if($rows=mysql_fetch_array($result)){
//$msg2="0098*PDP890*APC567*AD567";
$msg2=$rows['MessageText'];
$receiver=$rows['MessageFrom'];
$sender="Election";  
$id=$rows['Id'];
$senttime=$rows['SendTime'];
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$security_message=trim(strtoupper($arry_msg2[2])); // what message

      //-----check where the massage is from GSM number or not-------------------------
	   $len_number=strlen($rows['MessageFrom']);
       if($len_number < 15)
	   {
		$sqld="DELETE FROM messagein WHERE Id='$id'";
        mysql_query($sqld) or die(mysql_error); 
		$go="No";   
	   }
	   else{
		   
		$go="To";  
	   }
	   //------------------------------------------------------------------------------
       //------------------------------------------------------------------------------
	   
	   
	   //----------------------------------------------------------------------------
	   //------------------------------------------------------------------------------
      //$unit_code=trim($arry_msg2[0]); //unit_code from here
      $sqlp= "SELECT * FROM polling_unit WHERE agent_phone='$receiver'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  if($rowp=mysql_fetch_array($resulp)){
	  $unit_name=addslashes($rowp['unit_name']);
	  $lg_code=$rowp['lg_code'];
	  $ward_code=$rowp['ward_code'];
	  $unit_code=$rowp['unit_code']; 
	  $state_code=28;
	  $go="Phone";        
	  }
	  
	  
	  else
	  {
		     //-------------check from polling unit weather unit exit or not
			      $unit_code=trim($arry_msg2[0]); //unit_code from here
		          $sqlp= "SELECT * FROM polling_unit WHERE state_unit_code='$unit_code'";
	              $resulp=mysql_query($sqlp) or die(mysql_error());
	              if($rowp=mysql_fetch_array($resulp))
				  {
	              $unit_name=addslashes($rowp['unit_name']);
	              $lg_code=$rowp['lg_code'];
	              $ward_code=$rowp['ward_code'];
	              $unit_code=$rowp['unit_code']; 
	              $state_code=28;
				  $go="True";
				  
				  }else
				   {
					$msg_in="Thank you, the polling unit did not exit in our system check the code given to you";
					$sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
					mysql_query($sql) or die(mysql_error());
					$go="No"; 
					//delete it
					$sqld="DELETE FROM messagein WHERE Id='$id'";
					mysql_query($sqld) or die(mysql_error);
				   }
		  
		  		  
	           
	  }
	  
//-----------------------------------------------------------------------------------------------------------------	
   if($go=="True"){  
       $ck="SELECT * FROM result WHERE unit_code='$unit_code'";
	   $rk=mysql_query($ck) or die(mysql_error());
	   if($ro=mysql_fetch_array($rk)){
		   //notting is inside the result table
	    }
	    else{
	   // insert into
	    $gg="INSERT INTO result SET unit_name='$unit_name',unit_code='$unit_code',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code'";
	    mysql_query($gg) or die(mysql_error()); 
		//form here sent to online api --------------------------- 
		 $url="http://www.rmsng.com/resultapi2.php?unit_name=$unit_name&unit_code=$unit_code&ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code";
		}
   }
//----------------------------------------------------------------------------------------------------------------		  
//----------------------------------------------------------------------------------------------------------------
   if($go=="True"){  
	   foreach($arry_msg2 as $key => $value){ 		
	   if($key==0){   
	   }
	   else{
		 //echo"$key -- $value";
         $party_name=preg_replace("/[^A-Za-z]/", "", $value);
		 $party_score=preg_replace("/[^0-9]/", "", $value);
		 //------- check if the party exit or not
		   $party_score=preg_replace("/[^0-9]/", "", $value);
		   $sd="SELECT * FROM party WHERE party_name='$party_name'";
		   $ros=mysql_query($sd) or die(mysql_error());
		   if($rr=mysql_fetch_array($ros)){
			  $gg="UPDATE result SET $party_name='$party_score' WHERE unit_code='$unit_code'"; 
		      mysql_query($gg) or die(mysql_error());
			  // send to online
			  $url="http://www.rmsng.com/resultapi3.php?unit_code=$unit_code&party_name=$party_name&party_score=$party_score";
			     
		   }else{
			  $msg_in="Thank you, this $party_name  Party name does not exit, please Check and resend";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          mysql_query($sql) or die(mysql_error());      
		   }
		  
		    
			
	   }
	   }
	    //send congratulatry message
			$msg_in="Thank you, we have received your input";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          mysql_query($sql) or die(mysql_error());
	//detele it
	    $sqld="DELETE FROM messagein WHERE Id='$id'";
        mysql_query($sqld) or die(mysql_error);   
   }



//----------------------------------------------------------------------------------------------------------------	  
	if($go=="Phone"){  
	   foreach($arry_msg2 as $key => $value){ 		
	   
		 //echo"$key -- $value";
         $party_name=preg_replace("/[^A-Za-z]/", "", $value);
		 $party_score=preg_replace("/[^0-9]/", "", $value);
		 //------- check if the party exit or not
		   $party_score=preg_replace("/[^0-9]/", "", $value);
		   $sd="SELECT * FROM party WHERE party_name='$party_name'";
		   $ros=mysql_query($sd) or die(mysql_error());
		   if($rr=mysql_fetch_array($ros)){
			  $gg="UPDATE result SET $party_name='$party_score' WHERE unit_code='$unit_code'"; 
		      mysql_query($gg) or die(mysql_error());
			  // send to online
			  $url="http://www.rmsng.com/resultapi3.php?unit_code=$unit_code&party_name=$party_name&party_score=$party_score";
			     
		   }else{
			  $msg_in="Thank you, this $party_name  Party name does not exit, please Check and resend";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          mysql_query($sql) or die(mysql_error());      
		   }
		  
		    
			
	   }
	   }
	    //send congratulatry message
			  $msg_in="Thank you, we have received your input";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          mysql_query($sql) or die(mysql_error());
	          //detele it
	          $sqld="DELETE FROM messagein WHERE Id='$id'";
              mysql_query($sqld) or die(mysql_error);   
     
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