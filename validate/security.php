<?php
include("../db/db.php");
$id=$_GET['id']; 
$sqlchk="SELECT * FROM messagein WHERE id='$id'";
$s=mysql_query($sqlchk) or die(mysql_error);	
$rlt=mysql_fetch_array($s);
$msg2=$rlt['MessageText'];
$number=$rlt['MessageFrom'];

$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);
$uid=$arry_msg2[0];     //1 b4
$report=$arry_msg2[1]; //2 b4
       //get polling unit from here
      $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$uid'";
	  $resulp=mysql_query($sqlp) or die(mysql_error());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_id=$rowp['unit_id'];
	  $ward_id=$rowp['ward_id'];
	  $lg_id=$rowp['lg_id'];
	  $unit_name=$rowp['unit_name'];

		$sql_inz="INSERT INTO security_report SET unit_id='$unit_id',unit_name='$unit_name',ward_id='$ward_id',lg_id='$lg_id',report='$report'";
	    mysql_query($sql_inz) or die (mysql_error);
	  //====================
	  
	  	$sqld="DELETE FROM messagein WHERE Id ='$id'";
        mysql_query($sqld) or die(mysql_error);

header("location:all_messages.php");
exit;	
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