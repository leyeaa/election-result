<?php 
include("db/db.php");
$unit_name=addslashes($_GET['unit_name']);
$unit_code=$_GET['unit_code'];
$ward_code=$_GET['ward_code'];
$lg_code=$_GET['lg_code'];
$state_code=$_GET['state_code'];
$ck="SELECT * FROM result WHERE unit_code='$unit_code'";
	   $rk=mysql_query($ck) or die(mysql_error());
	   if($ro=mysql_fetch_array($rk)){
		   //notting is inside the result table
	    }
	    else{
		$gg="INSERT INTO result SET unit_name='$unit_name',unit_code='$unit_code',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code'";
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