<?php 
set_time_limit(0);
include("../db/db.php");
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
    <th width="4%" bgcolor="#F4F4F4">Voter Reg</th>
    <th width="5%" bgcolor="#F4F4F4">PVC Collected</th>
    <th width="5%" bgcolor="#F4F4F4">Accredited Voters</th>
    <th width="5%" bgcolor="#F4F4F4">APC </th>
    <th width="4%" bgcolor="#F4F4F4">PDP</th>
    <th width="5%" bgcolor="#F4F4F4">ZLP</th>
    <th width="5%" bgcolor="#F4F4F4">SDP</th>
    <th width="5%" bgcolor="#F4F4F4">ADP</th>
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
		
	   $sql3="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV,SUM(PVC) AS sum_PVC, SUM(ADP) AS sum_ADP FROM result WHERE unit_code='$unit_code'";
	   $result3=mysql_query($sql3) or die(mysql_error());
	   $rows3=mysql_fetch_array($result3);
	   $sum_ZLP3=number_format($rows3['sum_ZLP']);
	   $sum_APC3=number_format($rows3['sum_APC']);
	   $sum_PDP3=number_format($rows3['sum_PDP']);	   
	   $sum_SDP3=number_format($rows3['sum_SDP']);
	   $sum_ADP3=number_format($rows3['sum_ADP']);
	   $sum_AV3=number_format($rows3["sum_AV"]);
       $sum_PVC3=number_format($rows3["sum_PVC"]);
	   //---------------------
	   $sq="SELECT SUM(no_register_voters) AS sum_register_voters FROM polling_unit WHERE unit_code='$unit_code'";
	   $resu=mysql_query($sq) or die(mysql_error());
	   $ro=mysql_fetch_array($resu);
	   $sum_register_voters=number_format($ro['sum_register_voters']);
	   
	  
    echo"<tr>
    <td align='right' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>EKITI</td>
    <td align='center' bgcolor='#FFFFFF'>EKT</td>
    <td bgcolor='#FFFFFF'>$lg_name</td>
    <td align='center' bgcolor='#FFFFFF'>$l</td>
    <td bgcolor='#FFFFFF'>$ward_name</td>
    <td align='center' bgcolor='#FFFFFF'>$unit_code</td>
    <td bgcolor='#FFFFFF'>$unit_name</td>
	
	
    <td align='center' bgcolor='#FFFFFF'>$u</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_register_voters</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_PVC3</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_AV3</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_APC3</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_PDP3</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_ZLP3</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_SDP3</td>
	<td align='right' bgcolor='#FFFFFF'>$sum_ADP3</td>
  </tr>";  
   $i++;
   $u++;
		}
		///
	$sqlw="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV,SUM(PVC) AS sum_PVC,SUM(ADP) AS sum_ADP FROM result WHERE ward_code='$ward_code'";
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
	   

		echo" <tr>
	  <td colspan='9' align='right' bgcolor='#CCFFFF'>Ward Total:</td>
	  <td align='right' bgcolor='#CCFFFF'>$sum_register_voters</td>
	  <td align='right' bgcolor='#CCFFFF'>$sum_PVCw</td>
	  <td align='right' bgcolor='#CCFFFF'>$sum_AVw</td>
	  <td align='right' bgcolor='#CCFFFF'>$sum_APCw</td>
	  <td align='right' bgcolor='#CCFFFF'>$sum_PDPw</td>
	  <td align='right' bgcolor='#CCFFFF'>$sum_ZLPw</td>
	  <td align='right'  bgcolor='#CCFFFF'>$sum_SDPw</td>
	  <td align='right'  bgcolor='#CCFFFF'>$sum_ADPw</td>
	   </tr>";
		//	
						   
     $w++;
	  }
	 $sql4="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV, SUM(PVC) AS sum_PVC,SUM(ADP) AS sum_ADP FROM result WHERE lg_code='$lg_code'";
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
	   $sum_register_voters=number_format($ro['sum_register_voters']);
  echo" </tr>
  <tr bgcolor='#FFFFCC'>
    <th colspan='9' align='right'>Sum $lg_name:</th>
    <th align='right'>$sum_register_voters</th>
    <th align='right'>$sum_PVC4</th>
    <th align='right'>$sum_AV4</th>
    <th align='right'>$sum_APC4</th>
    <th align='right'>$sum_PDP4</th>
    <th align='right'>$sum_ZLP4</th>
    <th align='right'>$sum_SDP4</th>
	<th align='right'>$sum_ADP4</th>
  </tr>";
  $l++;
 
	  }
	  
	   $sql5="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV,SUM(PVC) AS sum_PVC,SUM(ADP) AS sum_ADP FROM result WHERE state_code='$state_code'";
	   $result5=mysql_query($sql5) or die(mysql_error());
	   $rows5=mysql_fetch_array($result5);
	   $sum_ZLP5=number_format($rows5['sum_ZLP']);
	   $sum_APC5=number_format($rows5['sum_APC']);
	   $sum_PDP5=number_format($rows5['sum_PDP']);	   
	   $sum_SDP5=number_format($rows5['sum_SDP']); 
	   $sum_AV5=number_format($rows5['sum_AV']);
	   $sum_PVC5=number_format($rows5['sum_PVC']);
	   $sum_ADP5=number_format($rows5['sum_ADP']);
	   //----
	   $sq="SELECT SUM(no_register_voters) AS sum_register_voters FROM polling_unit WHERE state_code='$state_code'";
	   $resu=mysql_query($sq) or die(mysql_error());
	   $ro=mysql_fetch_array($resu);
	   $sum_register_voters=number_format($ro['sum_register_voters']);
  ?>
  
  <tr bgcolor="#FFCCFF">
    <th colspan="9" align="right">TOTAL SUM:</th>
    <th align="right"><?php echo $sum_register_voters ?></th>
    <th align="right"><?php echo $sum_PVC5 ?></th>
    <th align="right"><?php echo $sum_AV5 ?></th>
    <th align="right"><?php echo  $sum_APC5 ?></th>
    <th align="right"><?php echo  $sum_PDP5 ?></th>
    <th align="right"><?php echo $sum_ZLP5 ?></th>
    <th align="right"><?php echo $sum_SDP5 ?></th>
    <th align="right"><?php echo $sum_ADP5 ?></th>
  </tr>
  <tr>
    
  </tr>
  
</table>
</body>
</html>