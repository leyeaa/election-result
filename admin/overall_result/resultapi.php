<?php 
//include("../db/db.php");

$server2 = "localhost";
$user = "root";
$password = "";
$database = "sms_election2";
$con = mysql_connect($server2, $user, $password, $database);
mysql_select_db($database) or die("Cant't Select Database");



$unit_id=$_REQUEST['unit_id'];
$unit_name=$_REQUEST['unit_name'];
$ward_id=$_REQUEST['ward_id'];
$lg_id=$_REQUEST['lg_id'];
$LP_score=$_REQUEST['LP'];
$PDP_score=$_REQUEST['PDP'];
$APC_score=$_REQUEST['APC'];

      
	   $sqly="INSERT INTO result SET unit_id='$unit_id',unit_name='$unit_name',LP='$LP_score',APC='$APC_score',PDP='$PDP_score',lg_id='$lg_id',ward_id='$ward_id'";
	   $result = mysql_query($sqly);
	  // echo 1;
	   // or die(mysql_error());


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