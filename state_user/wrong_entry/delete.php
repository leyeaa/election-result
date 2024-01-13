<?php 
ob_start();
$id=$_GET['id']; 
include("../../include/database.php");
include("../../include/db_function.php");
$sqld="DELETE FROM wrong_messagein WHERE Id ='$id'";
$database->query($sqld) or die($database->error);
header("location:all_messages.php");
exit;
ob_end_flush();
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