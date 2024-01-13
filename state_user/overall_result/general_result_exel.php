<?php 
set_time_limit(0);
include("../db/db.php");

function unit_result($party_name,$unit_code){
$sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE unit_code='$unit_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	   return  $sum_ZLP;
}

function word_result($party_name,$ward_code){
$sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE ward_code='$ward_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	  return $sum_ZLP;	
}

function lg_result($party_name,$lg_code){
$sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE lg_code='$lg_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	  return $sum_ZLP ;	
}
function state_result($party_name,$state_code){
$sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE state_code='$state_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	  return $sum_ZLP ;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>General Result</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
}
</style>
</head>

<body topmargin="0">
<table width="100%" cellpadding="4" cellspacing="2">
  <tr>
    <th align="center">STATE OF NIGERIA </th>
  </tr>
  <tr>
    <th align="center">RESULT SUMMARY</th>
  </tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr align="center">
    <th width="2%" bgcolor="#F4F4F4">S/N</th>
    <th width="5%" bgcolor="#F4F4F4">State Name</th>
    <th width="3%" bgcolor="#F4F4F4">State Code</th>
    <th width="8%" bgcolor="#F4F4F4">LGA Name</th>
    <th width="3%" bgcolor="#F4F4F4">LGA Code</th>
    <th width="11%" bgcolor="#F4F4F4">Ward Name</th>
    <th width="3%" bgcolor="#F4F4F4">Unit Code</th>
    <th width="28%" bgcolor="#F4F4F4">POLLING Polling Station Location / Name</th>
    <th width="4%" bgcolor="#F4F4F4">PU Code</th>
    <?php
   $sqla="SELECT * FROM party"; 
   $resa=mysql_query($sqla) or die(mysql_error());
   while($rra=mysql_fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   echo"<th width='4%' bgcolor='#F4F4F4'>$party_name</th>";
   }
     ?>
  </tr>
  <?php 
   $state_code=13;
    $sql= "SELECT * FROM lg";// WHERE state_code='$state_code'";
	  $result=mysql_query($sql) or die(mysql_error());
	  $i=1;
	  $l=1;
	  while($rows=mysql_fetch_array($result)){
	   $lg_code=$rows['lg_code'];
	   $lg_name=$rows["lg_name"]; 
	   //----ward
	  $sql1= "SELECT * FROM ward WHERE lg_code='$lg_code'";
	  $result1=mysql_query($sql1) or die(mysql_error());
	  $w=1;
	  while($rows1=mysql_fetch_array($result1)){
       $ward_code=$rows1['ward_code'];
	   $ward_name=$rows1["ward_name"]; 
	   ///----unit
	    $sql2= "SELECT * FROM polling_unit WHERE ward_code='$ward_code'";
	    $result2=mysql_query($sql2) or die(mysql_error());
		$u=1;
	    while($rows2=mysql_fetch_array($result2)){
        $unit_code=$rows2['state_unit_code'];
	    $unit_name=$rows2["unit_name"]; 

	  
    echo"<tr>
    <td align='right' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>EKITI</td>
    <td align='center' bgcolor='#FFFFFF'>EKT</td>
    <td bgcolor='#FFFFFF'>$lg_name</td>
    <td align='center' bgcolor='#FFFFFF'>$l</td>
    <td bgcolor='#FFFFFF'>$ward_name</td>
    <td align='center' bgcolor='#FFFFFF'>$unit_code</td>
    <td bgcolor='#FFFFFF'>$unit_name</td>
	<td align='center' bgcolor='#FFFFFF'>$u</td>";
	
   $sqlaa="SELECT * FROM party"; 
   $resa=mysql_query($sqlaa) or die(mysql_error());
   while($rra=mysql_fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   $unit_result=unit_result($party_name,$unit_code);
   echo" <td align='right' bgcolor='#FFFFFF'>$unit_result</td>";
    }
   echo"</tr>";  
   $i++;
   $u++;
		}
		///
	/*$sqlw="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV,SUM(PVC) AS sum_PVC,SUM(ADP) AS sum_ADP FROM result WHERE ward_code='$ward_code'";
	   $resultw=mysql_query($sqlw) or die(mysql_error());
	   $rowsw=mysql_fetch_array($resultw);
	   $sum_ZLPw=number_format($rowsw['sum_ZLP']);
	   $sum_APCw=number_format($rowsw['sum_APC']);
	   $sum_PDPw=number_format($rowsw['sum_PDP']);	   
	   $sum_SDPw=number_format($rowsw['sum_SDP']);
	    $sum_ADPw=number_format($rowsw['sum_ADP']);
	   $sum_AVw=number_format($rowsw["sum_AV"]);
       $sum_PVCw=number_format($rowsw["sum_PVC"]);
	   //---------------------
	   $sq="SELECT SUM(no_register_voters) AS sum_register_voters FROM polling_unit WHERE ward_code='$ward_code'";
	   $resu=mysql_query($sq) or die(mysql_error());
	   $ro=mysql_fetch_array($resu);
	   $sum_register_voters=number_format($ro['sum_register_voters']);
	   */

	echo"<tr>";
	echo"<td colspan='9' align='right' bgcolor='#CCFFFF'>Ward Total:</td>";
	$sql4="SELECT * FROM party";
   $resa14=mysql_query($sql4) or die(mysql_error());
   while($rra14=mysql_fetch_array($resa14)){ 
   $party_name=$rra14['party_name'];
   $ward_total=ward_result($party_name,$ward_code);
   $ward_total2=number_format($ward_total);
   echo"<td align='right' bgcolor='#CCFFFF'>$ward_total2</td>";
   } 
 echo"</tr>";					   
     $w++;
	  }
	 /*$sql4="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV, SUM(PVC) AS sum_PVC,SUM(ADP) AS sum_ADP FROM result WHERE lg_code='$lg_code'";
	   $result4=mysql_query($sql4) or die(mysql_error());
	   $rows4=mysql_fetch_array($result4);
	   $sum_ZLP4=number_format($rows4['sum_ZLP']);
	   $sum_APC4=number_format($rows4['sum_APC']);
	   $sum_PDP4=number_format($rows4['sum_PDP']);	   
	   $sum_SDP4=number_format($rows4['sum_SDP']); 
	   $sum_ADP4=number_format($rows4['sum_ADP']); 
	   $sum_AV4=number_format($rows4["sum_AV"]);
	   $sum_PVC4=number_format($rows4["sum_PVC"]);
	   //---
	   $sq="SELECT SUM(no_register_voters) AS sum_register_voters FROM polling_unit WHERE lg_code='$lg_code'";
	   $resu=mysql_query($sq) or die(mysql_error());
	   $ro=mysql_fetch_array($resu);
	   $sum_register_voters=number_format($ro['sum_register_voters']);*/
   echo"</tr>
  <tr bgcolor='#FFFFCC'>
  <th colspan='9' align='right'>Sum $lg_name:</th>";
   $sql3="SELECT * FROM party";
   $resa13=mysql_query($sql3) or die(mysql_error());
   while($rra13=mysql_fetch_array($resa13)){ 
   $party_name=$rra13['party_name'];
   $lg_total=lg_result($party_name,$lg_code);
   $lg_total2=number_format($lg_total);
   echo"<th align='right'>$lg_total2</th>";
   }
  echo"</tr>";
  $l++;
 
	  }
	  

  ?>
  
  <tr bgcolor="#FFCCFF">
    <th colspan="9" align="right">TOTAL SUM:</th>
    
    <?php 
   $resa13=mysql_query($sql3) or die(mysql_error());
   while($rra13=mysql_fetch_array($resa13)){ 
   $party_name=$rra13['party_name'];
   $state_total=state_result($party_name,$state_code);
   $state_total2=number_format($state_total);
	echo"<th align='right'>$state_total2</th>";
    }
	?>   
  </tr>
  <tr>
    
  </tr>
  
</table>
</body>
</html>