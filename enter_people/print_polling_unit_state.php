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
	font-size: 15px;
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
@media print {
   thead {display: table-header-group;}
}
</style>
</head>

<body topmargin="0">
<thead>
</thead>
 <?php
 $sql2= "SELECT * FROM lg, ward WHERE lg.state_code='$state' AND lg.lg_code=ward.lg_code";
                  $result2=mysql_query($sql2) or die(mysql_error());	
                  while($rows2=mysql_fetch_array($result2)){
					  $ward_code = $rows2['ward_code'];
					  $ward_name = $rows2['ward_name'];
					  $lg_name = $rows2['lg_name'];
                   
 
  $sql= "SELECT * FROM polling_unit WHERE  ward_code='$ward_code'";
$result=mysql_query($sql) or die(mysql_error());
$i=1;	
while($rows=mysql_fetch_array($result)){


echo"<table width='90%' align='center' cellpadding='6' cellspacing='5' bgcolor='#CCCCCC' border='1' style='page-break-after: always'>
  <tr>
    <td colspan='3' align='center' bgcolor='#CCFFCC'>$ward_name/$lg_name</td>
  </tr>
  <tr>
    <td width='4%' rowspan='8' align='center' bgcolor='#FFFFFF'>$i</td>
    <td width='33%' rowspan='8' bgcolor='#FFFFFF'>{$rows['unit_name']}</td>
    <td colspan='3' align='center' bgcolor='#FFFFCC'>PRESIDENT ELECTION</td>
  </tr>
  <tr>
    <td width='18%' bgcolor='#FFFFCC'>Accredited Voters</td>
    <td width='30%' bgcolor='#FFFFCC'>{$rows['state_unit_code']}*AV*</td>
    <td width='15%' rowspan='3' bgcolor='#FFFFCC'>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#FFFFCC'>Result</td>
    <td bgcolor='#FFFFCC'>{$rows['state_unit_code']}*APC*LP*PDP*SDP</td>
  </tr>
  <tr>
    <td bgcolor='#FFFFCC'>Security Report</td>
    <td bgcolor='#FFFFCC'>{$rows['state_unit_code']}*SR*report</td>
  </tr>
  <tr>
    <td colspan='3' align='center' bgcolor='#CCFFCC'>SENATE ELECTION</td>
  </tr>
  <tr>
    <td width='18%' bgcolor='#CCFFCC'>Accredited Voters</td>
    <td bgcolor='#CCFFCC'>{$rows['state_unit_code']}*AV*</td>
    <td rowspan='3' bgcolor='#CCFFCC'>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor='#CCFFCC'>Result</td>
    <td bgcolor='#CCFFCC'>{$rows['state_unit_code']}*APC*LP*PDP*SDP</td>
  </tr>
  <tr>
    <td bgcolor='#CCFFCC'>Security Report</td>
    <td bgcolor='#CCFFCC'>{$rows['state_unit_code']}*SR*report</td>
  </tr>
</table>";
  $i++;
	}
}
?>

<p>&nbsp;</p>
</body>
</html>