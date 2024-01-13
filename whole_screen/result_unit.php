<?php 
//error_reporting(0);
session_start();
$lg_code=$_GET['lg_code'];
$ward_code=$_GET['ward_code'];
//$state_code=substr($ward_code,0,2);

include("../db/db.php");
//$state_name=state_name($state_code);
$sql= "SELECT * FROM lg WHERE lg_code='$lg_code'";
$result=mysql_query($sql) or die(mysql_error());	
$rows=mysql_fetch_array($result);
$lg_name=strtoupper($rows['lg_name']);
//------------------------------------
$sql2= "SELECT * FROM ward WHERE ward_code='$ward_code'";
$result2=mysql_query($sql2) or die(mysql_error());	
$rows2=mysql_fetch_array($result2);
$ward_name=strtoupper($rows2['ward_name']);
 
 function unit_result($party_name,$unit_code){
   $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE unit_code='$unit_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	   return $sum_ZLP; 
 }
 
  function ward_result($party_name,$ward_code){
   $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE ward_code='$ward_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	   return $sum_ZLP; 
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
	font-size: 11px;
}
</style>
</head>

<body topmargin="0">
<table width="90%" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <th align="center"><?php echo $lg_name ?> : LOCAL GOVERNMENT AREA</th>
  </tr>
  <tr>
    <th align="center"> <a href="ward_result.php">Ward: <?php echo $ward_name ?><a></th>
  </tr>
</table>
<table width="90%" align="center" cellpadding="6" cellspacing="1" bgcolor="#003300">
  <tr>
    <td colspan="2" align="center" bgcolor="#A4FFA4"><strong>Unit  Name</strong></td>
    <?php 
   $sqla="SELECT * FROM party"; 
   $resa=mysql_query($sqla) or die(mysql_error());
   while($rra=mysql_fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   echo"<td width='8%' align='center' bgcolor='#A4FFA4'><strong> $party_name</strong></td>";
   }
   ?>
  </tr>
  
  <?php 
     
  
      $sql= "SELECT * FROM polling_unit WHERE ward_code='$ward_code'";
	  $result=mysql_query($sql) or die(mysql_error());
	  while($rows=mysql_fetch_array($result)){
       $unit_code=$rows['state_unit_code'];
	   $unit_name=$rows["unit_name"];
	   
 echo" <tr>
    <td width='4%' align='center' bgcolor='#FFFFFF'>$i</td>
    <td width='28%' bgcolor='#FFFFFF'>$unit_name </td>";
	$resay=mysql_query($sqla) or die(mysql_error());
   while($rray=mysql_fetch_array($resay)){ 
   $party_name=$rray['party_name'];
   $unit_score=unit_result($party_name,$unit_code);
   echo"<td align='right' bgcolor='#FFFFFF'>$unit_score</td>";
   }
    
  echo"</tr>";
  $i++;
	  }	
  echo"<tr>
    <td colspan='2' align='right' bgcolor='#FFFFFF'>Total:</td>";
	$resay1=mysql_query($sqla) or die(mysql_error());
   while($rray1=mysql_fetch_array($resay1)){ 
   $party_name=$rray1['party_name'];
   $ward_s=ward_result($party_name,$ward_code);
   echo"<th align='right' bgcolor='#FFFFCC'> $ward_s </th>";
   }
    
  echo"</tr>";
    
  ?>
</table>
</body>
</html>