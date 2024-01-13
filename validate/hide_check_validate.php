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
$to_know=trim(strtoupper($arry_msg2[1])); // what message
$security_message=trim(strtoupper($arry_msg2[2])); // what message

      //-----check where the massage is from GSM number or not
	   /*$len_number=strlen($rows['MessageFrom']);
       if($len_number < 15)
	   {
		$sqld="DELETE FROM messagein WHERE Id='$id'";
       mysql_query($sqld) or die(mysql_error);    
	   }*/
       //end of check
      $unit_code=trim($arry_msg2[0]); //unit_code from here
	 	  
      /*$state_code=substr($unit_code,0,2);
	  $lg_code=substr($unit_code,0,4);
	  $ward_code=substr($unit_code,0,6);*/

      $sqlp= "SELECT * FROM polling_unit WHERE state_unit_code='$unit_code'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_name=addslashes($rowp['unit_name']);
	  $lg_code=$rowp['lg_code'];
	  $ward_code=$rowp['ward_code'];
	  
		  
	  
	  //----- remember to insert code that will check if all party is correct if all are correct send msage and congrate him or her
	   
	  //----------
	  // print_r($arry_msg2);
		 //exit;
	   
	   //for($key=1; $key<=3; $key++){
	     //$i=0;
	    foreach($arry_msg2 as $key => $value){ 
		
		 echo"$key -- $value";
		 echo"<br>";
		 
	    $party_name=strtoupper(ereg_replace("[^A-Za-z]", "", $arry_msg2[$i]));
		$party_score=preg_replace("/[^0-9]/", "", $arry_msg2[$i]);
		   $sd="SELECT * FROM party WHERE party_name='$party_name'";
		   $ros=mysql_query($sd) or die(mysql_error());
		   if($rr=mysql_fetch_array($ros)){
			 // is  there then check if the unit code exit indide polling unit. 
			          $ck="SELECT * FROM result WHERE unit_code='$unit_code'";
					  $rk=mysql_query($ck) or die(mysql_error());
					  if($ro=mysql_fetch_array($rk)){
						//update the record
						 $gg="UPDATE result SET $party_name='$party_score' WHERE unit_code='$unit_code'"; 
						 mysql_query($gg) or die(mysql_error()); 
					   }
					  else{
						 // insert into
						 $gg="INSERT INTO result SET unit_name='$unit_name',unit_code='$unit_code',$party_name='$party_name',lg_code='$lg_code',ward_code='$ward_code'";
						 mysql_query($gg) or die(mysql_error()); 
					  }
		    }
			else
			{
			 // The part name did not exit,
			  $msg_in="Thank you, this $party_name  Party name dues not exit, please resent it again";
	          $sql="INSERT INTO messageout SET MessageFrom='$sender',MessageTo='$receiver',MessageText='$msg_in'";
	          mysql_query($sql) or die(mysql_error());
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
<iframe src="<?php echo $url;  ?>"  height="0" width="0"></iframe>

</body>
</html>