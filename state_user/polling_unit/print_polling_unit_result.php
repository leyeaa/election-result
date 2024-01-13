<?php 
//error_reporting(0);
session_start();
include("../db/db.php");
$state=$_SESSION['state2'];
$state_name=state_name($state);
$lg_code=$_POST['lg_code'];
$ward_code=$_POST['ward_code'];
$_SESSION['lg_code']=$lg_code;
$_SESSION['ward_code']=$ward_code;
$check_state=$_POST['check_state'];
$phone=trim($_POST['phone']);
$_SESSION['phone']=$phone;

   if($check_state=="sta"){
	header("location:polling_unit_slip.php");
	exit;   
   }

//===================================================
          $sql2= "SELECT * FROM lg WHERE lg_code='$lg_code'";
          $result2=mysql_query($sql2) or die(mysql_error());	
          $rows2=mysql_fetch_array($result2);
          $lg_name=$rows2['lg_name'];
//===================================================
          $sql3= "SELECT * FROM ward WHERE ward_code='$ward_code'";
          $result3=mysql_query($sql3) or die(mysql_error());	
          $rows3=mysql_fetch_array($result3);
          $ward_name=$rows3['ward_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: ||| WARD IN THE LOCAL GOVERNMENT ::: |||</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body topmargin="0">
<table width="95%" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td colspan="3" align="center" scope="col"><font size="+1"><?php echo $state_name ?> STATE NIGERIA</font></td>
  </tr>
  <tr>
    <td colspan="3" align="center" scope="col"><font size="+1"><?php echo $lg_name ?> : Local Government Area</font></td>
  </tr>
  <tr>
    <th colspan="3" align="center"><u>WARD: <?php echo $ward_name ?></u> </th>
  </tr>
  <tr>
    <td width="8%" align="center">[ <a href="javascript:window.print() ">Print List</a> ]</td>
    <td width="84%" align="center"><font>The List of polling Unit</font></td>
    <td width="8%" align="center">[ <a href="javascript:window.close()">Close </a>]</td>
  </tr>
</table>
<table width="95%" align="center" cellpadding="5" cellspacing="2" bgcolor="#999999">
  <tr>
    <th width="9%" bgcolor="#CCCCCC" scope="col">S/N</th>
    <th width="28%" bgcolor="#CCCCCC" scope="col">Polling Unit Name</th>
    <th width="15%" bgcolor="#CCCCCC" scope="col">Unit Code</th>
    
    <th width="30%" bgcolor="#CCCCCC" scope="col">SMS Format</th>
    <th width="18%" bgcolor="#CCCCCC" scope="col">Send To</th>
  </tr>
  
  <?php
  $sql= "SELECT * FROM polling_unit WHERE  ward_code='$ward_code'";
$result=mysql_query($sql) or die(mysql_error());
$i=1;	
while($rows=mysql_fetch_array($result)){
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>{$rows['unit_name']}</td>
    <td align='center' bgcolor='#FFFFFF'>{$rows['unit_code']}</td>
    
    <td align='center' bgcolor='#FFFFFF'><b><font size='+2'>{$rows['unit_code']}*APC*PDP</font></b></td>
	<td align='left' bgcolor='#FFFFFF'>$phone</td>
  </tr>";
  $i++;
}
   ?>
</table>
</body>
</html>