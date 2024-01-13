<?php 
$phone_number=$_GET['phone'];
$message=addslashes($_GET['message']);
include("db/db.php");
$sql="INSERT INTO messagein SET MessageFrom='$phone_number',MessageText='$message'";
mysql_query($sql) or die(mysql_error());
//-------------------------------------------------------------
$sql1="INSERT INTO all_messagein SET MessageFrom='$phone_number',MessageText='$message'";
mysql_query($sql1) or die(mysql_error());


//$msg2=$rows['MessageText'];
//$receiver=$rows['MessageFrom'];
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