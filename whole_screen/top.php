<?php 
session_start();
$name=$_SESSION['name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: || Mobile Election Counting Software || :::</title>
<link href="csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #CCC;
}
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 16px;
	color: #F00;
}
</style>
</head>

<body topmargin="0">
<table width="100%" cellpadding="3" cellspacing="3">
  <tr>
    <th width="10%" scope="col">&nbsp;</th>
    <th width="78%" scope="col"><span class="mobile_head">Election Process Management System [E-Pro] <?php echo $name ?></span></th>
    <th width="12%" scope="col"><a href="../../logout.php" target="_parent">Logout</a></th>
  </tr>
</table>
</body>
</html>