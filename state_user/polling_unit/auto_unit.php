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
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
}
</style>
</head>

<body>
<p>&nbsp;</p>

 <?php
 $sql2= "SELECT * FROM lg, ward WHERE lg.state_code='$state' AND lg.lg_code=ward.lg_code";
                  $result2=mysql_query($sql2) or die(mysql_error());	
                  while($rows2=mysql_fetch_array($result2)){
					  $ward_code = $rows2['ward_code'];
					  $ward_name = $rows2['ward_name'];
					  $lg_name = $rows2['lg_name'];
                   
 
  $sql= "SELECT * FROM polling_unit WHERE lg_code='$lg_code'";
$result=mysql_query($sql) or die(mysql_error());
$i=1;	
while($rows=mysql_fetch_array($result)){
echo"<table width='69%' align='center' cellpadding='4' cellspacing='1'>
  <tr>
    <th colspan='6' align='center'>POLLING UNIT AGENT FORM </th>
  </tr>
  <tr>
    <td colspan='6'><hr /></td>
  </tr>
  <tr>
    <td colspan='6'>&nbsp;</td>
  </tr>
  <tr>
    <td>State:</td>
    <td colspan='3'>Ondo</td>
    <td width='20%' colspan='2' rowspan='6' align='center'>PASSPORT</td>
  </tr>
  <tr>
    <td width='23%'>LGA Name:</td>
    <td colspan='3'>lga</td>
  </tr>
  <tr>
    <td>Ward Name:</td>
    <td colspan='3'>Akure Ward II</td>
  </tr>
  <tr>
    <td>Unit Name/Unit Code:</td>
    <td colspan='3'>Front baba House Unit 1</td>
  </tr>
  <tr>
    <td>Agent Full Name:</td>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td>Sex:</td>
    <td colspan='2'>&nbsp;</td>
    <td width='18%'>Age:</td>
  </tr>
  <tr>
    <td>Phone Number:</td>
    <td colspan='2'>&nbsp;</td>
    <td>&nbsp;</td>
    <td width='20%' colspan='2' align='center'>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan='6'>RATE GSM SERVICE PROVIDE IN YOUR AREA ( Mark as appropriate)</td>
  </tr>
  <tr>
    <th align='center' bgcolor='#E3E3E3'>SERVICE PROVIDER</th>
    <th width='18%' align='center' bgcolor='#E3E3E3'>FULL</th>
    <th width='21%' align='center' bgcolor='#E3E3E3'>MODERATE</th>
    <th align='center' bgcolor='#E3E3E3'>POOR</th>
    <th colspan='2' align='center' bgcolor='#E3E3E3'>NO SIGNAL</th>
  </tr>
  <tr>
    <th align='center'>GLO</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='2'>&nbsp;</td>
  </tr>
  <tr>
    <th align='center'>MTN</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='2'>&nbsp;</td>
  </tr>
  <tr>
    <th align='center'>AIRTEL</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='2'>&nbsp;</td>
  </tr>
  <tr>
    <th align='center'>ETISALAT</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='2'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='6'>DECLARATION:</td>
  </tr>
  <tr>
    <td colspan='6' valign='bottom'>I .......................................................................... Confirm all the information abve are true about me.</td>
  </tr>
  <tr>
    <td colspan='6' valign='bottom'>SIGNATURE &amp; DATE.........................................................................</td>
  </tr>
  <tr>
    <td colspan='6'>WARD CHAIRMAN ATTESTATION </td>
  </tr>
  <tr>
    <td colspan='6'>I ...................................................................... attest that the above information of the agent is correct and he /she is know tome and i vouch that he will represent the party as stipulated by law.</td>
  </tr>
  <tr>
    <td colspan='6'>SIGNATURE &amp; DATE...........................................................</td>
  </tr>
</table>";
}
				  }
?>

</body>
</html>