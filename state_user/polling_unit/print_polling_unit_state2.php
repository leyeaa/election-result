<?php 
session_start();
include("../db/db.php");
$state=$_SESSION['state2'];
$state_name=state_name($state);
$lg_code=$_SESSION['lg_code'];
$ward_code=$_SESSION['ward_code'];
$phone=$_SESSION['phone'];

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
	font-size: 16px;
	font-weight: bold;
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
    <td colspan="3" align="center" scope="col"><font size="+1"><?php echo $state_name ?> State</font></td>
  </tr>
  <tr>
    <td colspan="3" align="center" scope="col"><font size="+1"><?php echo $lg_name ?> Local Government Area</font></td>
  </tr>
  <tr>
    <th colspan="3" align="center"><u>WARD: <?php echo $ward_name ?></u> </th>
  </tr>
  <tr>
    <td width="11%" align="center">[ <a href="javascript:window.print() ">Print List</a> ]</td>
    <td width="81%" align="center"><font>The List of polling Unit</font></td>
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
    <td align='center' bgcolor='#FFFFFF'>{$rows['state_unit_code']}</td>
    
    <td align='center' bgcolor='#FFFFFF'><b><font size='+2'>{$rows['state_unit_code']}*APC*LP*PDP*SDP</font></b></td>
	<td align='left' bgcolor='#FFFFFF'>$phone</td>
  </tr>";
  $i++;
}
   ?>
</table>
<p>&nbsp;</p>
<table width="93%" align="center" cellpadding="10" bgcolor="#CCCCCC">
  <tr bgcolor="#E7E7E7">
    <th width="4%" align="center">S/N</th>
    <th width="33%" align="center">Unit Name</th>
    <td width="16%">&nbsp;</td>
    <td width="29%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php
  $sql= "SELECT * FROM polling_unit WHERE  ward_code='$ward_code'";
$result=mysql_query($sql) or die(mysql_error());
$i=1;	
while($rows=mysql_fetch_array($result)){

  
  echo"<tr>
    <td rowspan='8' align='center' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>&nbsp;</td>
    <th colspan='2' align='center' bgcolor='#FFFFCC'>PRESIDENT</th>
    <th align='center' bgcolor='#FFFFCC'>&nbsp;</th>
  </tr>
  <tr>
    <td rowspan='7' bgcolor='#FFFFFF'>{$rows['unit_name']}</td>
    <th align='left' bgcolor='#FFFFFF'>ACCREDITED voters</th>
    <th align='left' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*AV*</th>
    <th rowspan='3' align='left' bgcolor='#FFFFFF'>$phone</th>
  </tr>
  <tr>
    <th align='left' bgcolor='#FFFFFF'>RESULT</th>
    <th align='left' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*APC*LP*PDP*SDP</th>
  </tr>
  <tr>
    <th align='left' bgcolor='#FFFFFF'>SECURITY REPORT</th>
    <th align='left' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*SR*report</th>
  </tr>
  <tr>
    <th height='30' colspan='2' align='center' bgcolor='#FFFFCC'>SENATE</th>
    <th align='left' bgcolor='#FFFFCC'>&nbsp;</th>
  </tr>
  <tr>
    <th align='left' bgcolor='#FFFFFF'>ACCREDITED voters</th>
    <th align='left' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*AV*</th>
    <th rowspan='3' align='left' bgcolor='#FFFFFF'>sn number</th>
  </tr>
  <tr>
    <th align='left' bgcolor='#FFFFFF'>RESULT</th>
    <th align='left' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*APC*LP*PDP*SDP</th>
  </tr>
  <tr>
    <th align='left' bgcolor='#FFFFFF'>SECURITY REPORT</th>
    <th align='left' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*SR*report</th>
  </tr>";
  $i++;
}

?>   
</table>
<p>&nbsp;</p>
</body>
</html>