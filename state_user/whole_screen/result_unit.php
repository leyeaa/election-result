<?php 
//error_reporting(0);
session_start();
$lg_code=$_GET['lg_code'];
$ward_code=$_GET['ward_code'];
//$state_code=substr($ward_code,0,2);

$state_code=$_SESSION['state_code'];
include("../../include/database.php");
include("../../include/db_function.php");
//$state_name=state_name($state_code);
$sql= "SELECT * FROM lg WHERE lg_code='$lg_code'";
$result=$database->query($sql) or die($database->error());	
$rows=$database->fetch_array($result);
$lg_name=strtoupper($rows['lg_name']);
//------------------------------------
$sql2= "SELECT * FROM ward WHERE ward_code='$ward_code'";
$result2=$database->query($sql2) or die($database->error());	
$rows2=$database->fetch_array($result2);
$ward_name=strtoupper($rows2['ward_name']);
 
 function unit_result($party_name,$unit_code,$state_code){
	 global $database;
   $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE unit_code='$unit_code' AND state_code='$state_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	   return $sum_ZLP; 
 }
 
  function party_result($party_name,$ward_code,$state_code){
	  global $database;
   $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE ward_code='$ward_code' AND state_code='$state_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
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
	font-size: 10px;
}
#bb{
    border-radius:5px;
	width:98%;
    background-color: #f2f2f2;
    padding:3px;
	margin:auto;
	border: 2px solid green;
}
#n{
 border-radius: 5px;	
 border: 2px solid green;
}
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 9px;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body topmargin="0">
<table width="100%" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <th align="center"><?php echo $lg_name ?> : LOCAL GOVERNMENT AREA</th>
  </tr>
  <tr>
    <th align="center"> <a href="ward_result.php">Ward Name: <?php echo $ward_name ?><a></th>
  </tr>
</table>
<table width="100%" align="center" cellpadding="4" cellspacing="1" bgcolor="#003300" id="n">
  <tr>
    <td colspan="2" align="center" bgcolor="#A4FFA4"><strong>Unit  Name</strong></td>
    <?php 
   $sqla="SELECT * FROM party WHERE status IS NOT NULL"; 
   $resa=$database->query($sqla) or die($database->error());
   while($rra=$database->fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   echo"<td width='8%' align='center' bgcolor='#A4FFA4'><strong> $party_name</strong></td>";
   }
   ?>
  </tr>
  
  <?php 
      $sql= "SELECT * FROM polling_unit WHERE ward_code='$ward_code'";
	  $result=$database->query($sql) or die($database->error());
	  $i=1;
	  while($rows=$database->fetch_array($result)){
       $state_unit_code=$rows['state_unit_code'];
	   $unit_code=$rows['unit_code'];
	   $unit_name=$rows["unit_name"];
	   
 echo" <tr>
    <td width='4%' align='center' bgcolor='#FFFFFF'>$i</td>
    <td width='28%' bgcolor='#FFFFFF'>$unit_name </td>";
	$resay=$database->query($sqla) or die($database->error());
   while($rray=$database->fetch_array($resay)){ 
   $party_name=$rray['party_name'];
   $unit_score=unit_result($party_name,$unit_code,$state_code);
   echo"<td align='right' bgcolor='#FFFFFF'>$unit_score</td>";
   }
    
  echo"</tr>";
  $i++;
	  }	
  echo"<tr>
    <td colspan='2' align='right' bgcolor='#FFFFFF'>Total:</td>";
	$resay1=$database->query($sqla) or die($database->error());
   while($rray1=$database->fetch_array($resay1)){ 
   $party_name=$rray1['party_name'];
   $ward_s=party_result($party_name,$ward_code,$state_code);
   $ward_s2=number_format($ward_s,0);
   echo"<th align='right' bgcolor='#FFFFCC'> $ward_s2 </th>";
   }
    
  echo"</tr>";
    
  ?>
</table>
</body>
</html>