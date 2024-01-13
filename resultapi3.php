<?php 
include("db/db.php");
//$unit_name=$_GET['unit_name'];
$unit_code=$_GET['unit_code'];
$party_name=$_GET['party_name'];
$party_score=$_GET['party_score'];
//$ward_code=$_GET['ward_code'];
//$lg_code=$_GET['lg_code'];
//$state_code=$_GET['state_code'];
$ck="SELECT * FROM result WHERE unit_code='$unit_code'";
	   $rk=mysql_query($ck) or die(mysql_error());
	   if($ro=mysql_fetch_array($rk)){   
		$gg="UPDATE result SET $party_name='$party_score' WHERE unit_code='$unit_code'";
	    mysql_query($gg) or die(mysql_error());	
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
</body>
</html>