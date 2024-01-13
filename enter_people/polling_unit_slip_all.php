<?php 
session_start();
include("../db/db.php");
$lg_code=$_SESSION['lg_code'];
$phone=$_SESSION['phone'];

//===================================================
          $sql2= "SELECT * FROM lg WHERE lg_code='$lg_code'";
          $result2=mysql_query($sql2) or die(mysql_error());	
          $rows2=mysql_fetch_array($result2);
          $lg_name=$rows2['lg_name'];
//===================================================


      function ward($ward_code){
          $sql3= "SELECT * FROM ward WHERE ward_code='$ward_code'";
          $result3=mysql_query($sql3) or die(mysql_error());	
          $rows3=mysql_fetch_array($result3);
          return $ward_name=$rows3['ward_name'];
	  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 16px;
}
</style>
</head>

<body>
<p>&nbsp;</p>


<table width="60%" border="1" align="center" cellpadding="5" cellspacing="2">
  <tr>
    <td align="center"><?php echo  $lg_name?> </td>
  </tr>
</table>

<?php
$ss="SELECT * FROM ward WHERE lg_code ='$lg_code'";
$re=mysql_query($ss) or die(mysql_error());
$i=1;	
while($reo=mysql_fetch_array($re)){
$ward_code=$reo['ward_code'];	
$ward_name=ward($ward_code);
$sql= "SELECT * FROM polling_unit WHERE  ward_code='$ward_code'";
$result=mysql_query($sql) or die(mysql_error());

while($rows=mysql_fetch_array($result)){

echo"<table width='60%' border='1' align='center' cellpadding='5' cellspacing='3' bgcolor='#333333' >
  <tr>
    <td width='18%' align='right' bgcolor='#FFFFFF'>Ward Name:</td>
    <th colspan='3' align='left' bgcolor='#FFFFFF'>$ward_name</th>
  </tr>
  <tr>
    <td align='right' bgcolor='#FFFFFF'> [$i ] Polling Unit:</td>
    <th colspan='3' align='left' bgcolor='#FFFFFF'>{$rows['unit_name']}</th>
  </tr>
  
  <tr>
    <td bgcolor='#FFFFFF'>Security Report</td>
    <th width='56%' align='center' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*the report </th>
    <th width='7%' rowspan='2' align='center' bgcolor='#FFFFFF'>TO</th>
    <th width='19%' rowspan='2' align='center' bgcolor='#FFFFFF'>$phone</th>
  </tr>
  <tr>
    <td bgcolor='#FFFFFF'>Election Result</td>
    <th align='center' bgcolor='#FFFFFF'>{$rows['state_unit_code']}*APC*PDP*AD*SDP</th>
  </tr> 
</table> <p>&nbsp;</p>";
$i++;
}

}
?>




</body>
</html>