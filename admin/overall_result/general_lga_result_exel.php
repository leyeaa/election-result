<?php 
set_time_limit(0);
include("../db/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LGA RESULT</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
}
</style>
</head>

<body>
<table width="100%" cellpadding="4" cellspacing="2">
  <tr>
    <th align="center">STATE OF NIGERIA </th>
  </tr>
  <tr>
    <th align="center">LOCAL GOVERNMENT RESULT</th>
  </tr>
</table>
<table width="70%" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
  <tr align="center">
    <th width="5%" bgcolor="#F4F4F4">S/N</th>
    <th width="8%" bgcolor="#F4F4F4">State Name</th>
    <th width="7%" bgcolor="#F4F4F4">State Code</th>
    <th width="23%" bgcolor="#F4F4F4">LGA Name</th>
    <th width="5%" bgcolor="#F4F4F4">LGA Code</th>
    <th width="7%" bgcolor="#F4F4F4">Voter Reg</th>
    <th width="7%" bgcolor="#F4F4F4">PVC Collected</th>
    <th width="8%" bgcolor="#F4F4F4">Accredited Voters</th>
    <th width="6%" bgcolor="#F4F4F4">APC </th>
    <th width="5%" bgcolor="#F4F4F4">PDP</th>
    <th width="5%" bgcolor="#F4F4F4">LP</th>
    <th width="7%" bgcolor="#F4F4F4">SDP</th>
    <th width="7%" bgcolor="#F4F4F4">ADP</th>
  </tr>
  <?php 
   $state_code=28;
    $sql= "SELECT * FROM lg";// WHERE state_code='$state_code'";
	  $result=mysql_query($sql) or die(mysql_error());
	  $i=1;
	  $l=1;
	  while($rows=mysql_fetch_array($result)){
	   $lg_code=$rows['lg_code'];
	   $lg_name=$rows["lg_name"]; 
	   //----ward
	  $sql4="SELECT SUM(ZLP) AS sum_ZLP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC,SUM(SDP) AS sum_SDP,SUM(AV) AS sum_AV, SUM(PVC) AS sum_PVC,SUM(ADP) AS sum_ADP FROM result WHERE lg_code='$lg_code'";
	   $result4=mysql_query($sql4) or die(mysql_error());
	   $rows4=mysql_fetch_array($result4);
	   $sum_ZLP4=number_format($rows4['sum_ZLP']);
	   $sum_APC4=number_format($rows4['sum_APC']);
	   $sum_PDP4=number_format($rows4['sum_PDP']);	   
	   $sum_SDP4=number_format($rows4['sum_SDP']); 
	   $sum_AV4=number_format($rows4["sum_AV"]);
	   $sum_PVC4=number_format($rows4["sum_PVC"]);
	   $sum_ADP4=number_format($rows4["sum_ADP"]);
	   //---
	   $sq="SELECT SUM(no_register_voters) AS sum_register_voters FROM polling_unit WHERE lg_code='$lg_code'";
	   $resu=mysql_query($sq) or die(mysql_error());
	   $ro=mysql_fetch_array($resu);
	   $sum_register_voters=number_format($ro['sum_register_voters']);
	   
	  
    echo"<tr>
    <td align='right' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>EKITI</td>
    <td align='center' bgcolor='#FFFFFF'>EK</td>
    <td bgcolor='#FFFFFF'>$lg_name</td>
    <td align='center' bgcolor='#FFFFFF'>$l</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_register_voters</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_PVC4</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_AV4</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_APC4</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_PDP4</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_ZLP4</td>
    <td align='right' bgcolor='#FFFFFF'>$sum_SDP4</td>
	  <td align='right' bgcolor='#FFFFFF'>$sum_ADP4</td>
  </tr>";  
   $i++;
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
    <th colspan="5" align="right">TOTAL SUM:</th>
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