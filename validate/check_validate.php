<?php 
//error_reporting(0);
session_start();
ob_start();
include("../include/database.php");
include("../include/db_function.php");

/*$string = "This is some text and numbers 12345 and symbols !£$%^&";
$new_string = ereg_replace("[^A-Za-z0-9]", "", $string);
echo $new_string;*/

$sql="SELECT * FROM messagein"; // WHERE status=1";
$result=$database->query($sql) or die($database->error());
if($rows=$database->fetch_array($result)){
//$msg2="0098*PDP890*APC567*AD567";
$msg2=$rows['MessageText'];
$receiver=$rows['MessageFrom'];
$sender="Election";  
$id=$rows['Id'];
$senttime=$rows['SendTime'];
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$to_know=trim(strtoupper($arry_msg2[1])); // what message
$security_message=trim(strtoupper($arry_msg2[2])); // what message

      //-----check where the massage is from GSM number or not-------------------------
	   $len_number=strlen($rows['MessageFrom']);
       if($len_number < 10)
	   {
		$sqld="DELETE FROM messagein WHERE Id='$id'";
        $database->query($sqld) or die($database->error); 
		$go="No";   
	   }
	   else{
		   
		$go="To";  
	   }
	   //------------------------------------------------------------------------------
       //------------------------------------------------------------------------------
	   
	   
	   //----------------------------------------------------------------------------
	   //------------------------------------------------------------------------------
      $unit_code=trim($arry_msg2[0]); //unit_code from here
      $sqlp= "SELECT * FROM polling_unit WHERE state_unit_code='$unit_code'";
	  $resulp=$database->query($sqlp) or die($database->error());
	  if($rowp=$database->fetch_array($resulp)){
	  $unit_name=addslashes($rowp['unit_name']);
	  $lg_code=$rowp['lg_code'];
	  $ward_code=$rowp['ward_code'];
	  $state_code=$_SESSION['state_code'];
	  //$state_code=28;
	  
	           //check for recurity message
			    if(trim($arry_msg2[1]=="S")){
				 $security= addslashes($arry_msg2[2]);
				 $kk="INSERT recurity SET unit_code='$unit_code',report='$security'";
				 $database->query($kk) or die($database->error());
				 $go="No";	
				}
				else{
				$go="True";	  //REMEMBER TO MOVE THIS UP-----------
				}
	  }
	  else
	  {
		  //echo"not exit";
		  //exit;
		  //the polling unit name did not exit
	          $msg_in="Thank you, the polling unit did not exit in our system check the code given to you";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          $database->query($sql) or die($database->error());
			  $go="No"; 
			  //delete it
			 $sqld="DELETE FROM messagein WHERE Id='$id'";
             $database->query($sqld) or die($database->error);   
	  }
	  
//-----------------------------------------------------------------------------------------------------------------	
   if($go=="True"){  
       $ck="SELECT * FROM result WHERE unit_code='$unit_code'";
	   $rk=$database->query($ck) or die($database->error());
	   if($ro=$database->fetch_array($rk)){
		   //notting is inside the result table
	    }
	    else{
	   // insert into
	    $gg="INSERT INTO result SET unit_name='$unit_name',unit_code='$unit_code',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code'";
	    $database->query($gg) or die($database->error()); 
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
		   $ros=$database->query($sd) or die($database->error());
		   if($rr=$database->fetch_array($ros)){
			  $gg="UPDATE result SET $party_name='$party_score' WHERE unit_code='$unit_code'"; 
		      $database->query($gg) or die($database->error());
			  // send to online
			  $url="http://www.rmsng.com/resultapi3.php?unit_code=$unit_code&party_name=$party_name&party_score=$party_score";
			     
		   }else{
			  $msg_in="Thank you, this $party_name  Party name does not exit, please Check and resend";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          $database->query($sql) or die($database->error());      
		   }
		  
		    
			
	   }
	   }
	    //send congratulatry message
			$msg_in="Thank you, we have received your input";
	          $sql="INSERT INTO messageout SET MessageFrom='$msg_in',MessageTo='$receiver',MessageText='$msg_in'";
	          $database->query($sql) or die($database->error());
	//detele it
	    $sqld="DELETE FROM messagein WHERE Id='$id'";
        $database->query($sqld) or die($database->error);   
   }
//----------------------------------------------------------------------------------------------------------------	  
}
ob_end_flush();
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