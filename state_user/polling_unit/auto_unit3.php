<?php 
session_start();
include("../../include/database.php");
include("../../include/db_function.php");
$state=$_SESSION['state_code'];
$state_name=state_name($state);
$lg_code=$_SESSION['lg_code'];
$ward_code=$_SESSION['ward_code'];
$phone=$_SESSION['phone'];
$check_state=$_SESSION['check_state'];
$party=$_SESSION['party'];
//===================================================
         /* $sql2= "SELECT * FROM lg WHERE lg_code='$lg_code'";
          $result2=$database->query($sql2) or die($database->error());	
          $rows2=$database->fetch_array($result2);
          $lg_name=$rows2['lg_name'];*/
//===================================================
         /* $sql3= "SELECT * FROM ward WHERE ward_code='$ward_code'";
          $result3=$database->query($sql3) or die($database->error());	
          $rows3=$database->fetch_array($result3);
          $ward_name=$rows3['ward_name'];*/
		  
		    function lg_name1($lg_code){
				global $database;
          $sql2= "SELECT * FROM lg WHERE lg_code='$lg_code'";
          $result2=$database->query($sql2) or die($database->error());	
          $rows2=$database->fetch_array($result2);
          $lg_name=$rows2['lg_name'];
		  return $lg_name;
	 }
//===================================================
 function ward_name1($ward_code){
	 global $database;
          $sql3= "SELECT * FROM ward WHERE ward_code='$ward_code'";
          $result3=$database->query($sql3) or die($database->error());	
          $rows3=$database->fetch_array($result3);
          $ward_name=$rows3['ward_name'];
		  return $ward_name;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
@media print {
    .page-break {  
        page-break-before: always;  
        
    }
}

body, p, a,
span, td { 
    font-size: 9pt;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    margin-left: 2em; 
    margin-right: 2em;
}

.page {
    height: 600px;
    padding-top: 5px;
    page-break-after: always;   
    font-family: Arial, Helvetica, sans-serif;
    position: relative;
    /*border-bottom: 1px solid #000;*/
}
</style>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <?php
 //$sql2= "SELECT * FROM lg, ward WHERE lg.state_code='$state' AND lg.lg_code=ward.lg_code";
  $sql2="SELECT DISTINCT ward_code FROM polling_unit WHERE lg_code='$lg_code' ORDER BY ward_code";
                  $result2=$database->query($sql2) or die($database->error());	
                  while($rows2=$database->fetch_array($result2)){
					  $ward_code = $rows2['ward_code'];
					  //$ward_name = $rows2['ward_name'];
					  //$lg_name = $rows2['lg_name'];
                   
 $lg_name=lg_name1($lg_code);
  //$sql= "SELECT * FROM polling_unit WHERE  ward_code='$ward_code'";
 $sql= "SELECT * FROM polling_unit WHERE ward_code='$ward_code'";
$result=$database->query($sql) or die($database->error());
$i=1;	
while($rows=$database->fetch_array($result)){

if($check_state=="sta"){
	$unit_code=$rows['state_unit_code'];  
   }
   else{
	$unit_code=$rows['unit_code']; 
   }
$ward_name=ward_name1($ward_code);

 

echo"<div class='page'> <table width='100%' align='center' cellpadding='5' cellspacing='1'  style='border-style: ridge solid'>
  <tr>
    <th colspan='6' align='center'>$party POLLING UNIT AGENT FORM </th>
  </tr>
  <tr>
    <td colspan='6'><hr /></td>
  </tr>
  <tr>
    <td  align='center'  colspan='6'>$unit_code*APC*PDP*AD*SDP     TO  $phone</td>
  </tr>
  <tr>
    <th align='left'>State:</th>
    <td colspan='3'>$state_name</td>
    <td width='20%' colspan='2' rowspan='6' align='center'>PASSPORT</td>
  </tr>
  <tr>
    <th width='23%' align='left'>LGA Name:</th>
    <td colspan='3'>$lg_name</td>
  </tr>
  <tr>
    <th align='left'>Ward Name:</th>
    <td colspan='3'>$ward_name</td>
  </tr>
  <tr>
    <th align='left'>Unit Name/Unit Code:</th>
    <td colspan='3'>$unit_code: {$rows['unit_name']}</td>
  </tr>
  <tr>
    <th align='left'>Agent Full Name:</th>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <th align='left'>Sex:</th>
    <td colspan='2'>&nbsp;</td>
    <th width='18%' align='left'>Age:</th>
  </tr>
  <tr>
    <th align='left'>Phone Number:</th>
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
    <th align='center' bgcolor='#F7F7F7'>GLO</th>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='2' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <th align='center' bgcolor='#F7F7F7'>MTN</th>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='2' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <th align='center' bgcolor='#F7F7F7'>AIRTEL</th>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='2' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <th align='center' bgcolor='#F7F7F7'>ETISALAT</th>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td bgcolor='#F7F7F7'>&nbsp;</td>
    <td colspan='2' bgcolor='#F7F7F7'>&nbsp;</td>
  </tr>
  <tr>
    <th colspan='6' align='left'>DECLARATION:</th>
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
</table> </div>";
}

}

?>
   
</p>
 <p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>