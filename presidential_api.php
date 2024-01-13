<?php 
include("db/db.php");
$unit_name=addslashes($_GET['unit_name']);
$unit_code=$_GET['unit_code'];
$ward_code=$_GET['ward_code'];
$lg_code=$_GET['lg_code'];
$state_code=$_GET['state_code'];
$APC=$_GET['APC'];
$AA=$_GET['AA'];
$PDP=$_GET['PDP'];
$AAC=$_GET['AAC'];
$ZLP=$_GET['ZLP'];
$ADC=$_GET['ADC'];

       $ck="SELECT * FROM result WHERE unit_code='$unit_code'";
	   $rk=mysql_query($ck) or die(mysql_error());
	   if($ro=mysql_fetch_array($rk)){
		 $gg="UPDATE result SET APC='$APC',AA='$AA',AAC='$AAC',PDP='$PDP',ZLP='$ZLP',ADC='$ADC' WHERE unit_code='$unit_code'";
	    mysql_query($gg) or die(mysql_error());	
	    }
	    else{
		 $gg="INSERT INTO result SET unit_code='$unit_code',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code',APC='$APC',AA='$AA',AAC='$AAC',PDP='$PDP',ZLP='$ZLP',ADC='$ADC'";
	    mysql_query($gg) or die(mysql_error());	
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