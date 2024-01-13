<?php 
include("../db/db.php");
/*$string = "This is some text and numbers 12345 and symbols !£$%^&";
$new_string = ereg_replace("[^A-Za-z0-9]", "", $string);
echo $new_string;*/

$sql="SELECT * FROM messagein"; // WHERE status=1";
$result=mysql_query($sql) or die(mysql_error());
if($rows=mysql_fetch_array($result)){	
$msg2=$rows['MessageText'];
$receiver=$rows['MessageFrom']; // phone number of person sending.
$sender="Election";  
$id=$rows['Id'];
$senttime=$rows['SendTime'];
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$state_unit_code=trim($arry_msg2[0]); //unit_code from here
            $len=strlen($state_unit_code);
			
	$sl="SELECT * FROM polling_unit WHERE agent_phone='$receiver'";
	$rl=mysql_query($sl) or die(mysql_error());
	$nu_phone_v=mysql_num_rows($rl);
	 
		echo "$nu_phone_v";
		
			
			
		
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