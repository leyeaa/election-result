<?php 
//error_reporting(0);
session_start();
if(isset($_GET['lg_code'])){
$lg_code=$_GET['lg_code'];
$_SESSION['lg_code']=$lg_code;
}

if(isset($_SESSION['lg_code'])){
$lg_code=$_SESSION['lg_code'];	
}
$state_code=$_SESSION['state_code'];
include("../../include/database.php");
include("../../include/db_function.php");
//$state_name=state_name($state_code);
$sql= "SELECT * FROM lg WHERE lg_code='$lg_code'";
$result=$database->query($sql) or die($database->error());	
$rows=$database->fetch_array($result);
$lg_name=strtoupper($rows['lg_name']);

function word_sored($party_name,$ward_code,$state_code){
	global $database;
$sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE ward_code='$ward_code' AND state_code='$state_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	  return $sum_ZLP ;	
}
 function lgg($party_name,$lg_code,$state_code){
	 global $database;
       $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE lg_code='$lg_code' AND state_code='$state_code'";
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
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 9px;
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

<body>
<table width="100%" cellpadding="3" cellspacing="1">
  <tr>
    <th align="center">LGA Name: <a href="state_lg.php"><?php echo $lg_name ?></a></th>
  </tr>
</table>
<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#003300" id="n">

  
  <tr>
  <td colspan="2" align="center" bgcolor="#A4FFA4"><strong>Ward  Name</strong></td>
     <?php
   $sqla="SELECT * FROM party WHERE status IS NOT NULL"; 
   $resa=$database->query($sqla) or die($database->error());
   while($rra=$database->fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   echo"<td width='10%' align='center' bgcolor='#A4FFA4'><strong>$party_name</strong></td>";
   }
   ?>
    
  </tr>
  
  <?php 
  
  
      $sql= "SELECT * FROM ward WHERE lg_code='$lg_code' AND state_code='$state_code'";
	  $result=$database->query($sql) or die($database->error());
	  $i=1;
	
	  while($rows=$database->fetch_array($result)){
       $ward_code=$rows['ward_code'];
	   $ward_name=$rows["ward_name"];
	   
  
 echo" <tr>
    <td width='4%' align='center' bgcolor='#FFFFFF'>$i</td>
    <td width='28%' bgcolor='#FFFFFF'><a href='result_unit.php?ward_code=$ward_code&lg_code=$lg_code'>$ward_name</a></td>";
	$resa1=$database->query($sqla) or die($database->error());
   while($rra1=$database->fetch_array($resa1)){ 
   $party_name=$rra1['party_name'];
   $sored=word_sored($party_name,$ward_code,$state_code);
   $sored2=number_format($sored);
    echo"<td align='right' bgcolor='#FFFFFF'><b>$sored</b></td>";
   }    
 echo"</tr>";
  $i++;
	  }
  echo"<tr>
    <td colspan='2' align='right' bgcolor='#FFFFFF'>Total:</td>";
	$sqla="SELECT * FROM party WHERE status IS NOT NULL";
   $resa=$database->query($sqla) or die($database->error());
   while($rra=$database->fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   $lg_result=lgg($party_name,$lg_code,$state_code);
   $lg_result2=number_format($lg_result,0);
   echo" <th align='right' bgcolor='#FFFFCC'> $lg_result2 </th>";
   }
 echo"</tr>";
    //}
  ?>
</table>
</body>
</html>