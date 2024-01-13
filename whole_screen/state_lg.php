<?php 
//error_reporting(0);
$state_code=28;
session_start();
include("../db/db.php");
 function lgg($party_name,$lg_code){
       $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE lg_code='$lg_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	   return $sum_ZLP;
  }
   function tot($party_name,$state_code){
       $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE state_code='$state_code'";
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
<meta http-equiv="refresh" content="5 ; http:state_lg.php">
<title>::: RESULT :::</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
}
</style>
</head>

<body bottommargin="0" rightmargin="0" leftmargin="0" topmargin="0">
<table width="100%" cellpadding="6" cellspacing="1" bgcolor="#00CC33">
  <tr bgcolor="#FFFFCC">
    <th colspan="8" align="center" bgcolor="#FFFFCC">LOCAL GOVERNMENT    RESULT</th>
  </tr>
  <tr>
    <th width="6%" align="center" bgcolor="#FFFFFF">S/N</th>
    <th width="25%" align="center" bgcolor="#FFFFFF">Local Government  Name</th>
    <?php 
	 $sqla="SELECT * FROM party"; 
   $resa=mysql_query($sqla) or die(mysql_error());
   while($rra=mysql_fetch_array($resa)){ 
   $party_name=$rra['party_name'];
    echo"<td width='11%' align='center' bgcolor='#FFE6E6'><strong>$party_name</strong></td>";
   }
    ?>
  </tr>
   <?php 
      
	  //$state_code=$_SESSION['state_code2'];
	  //$sql="SELECT * FROM lg WHERE state_code='$state_code'";
	  $sql="SELECT * FROM lg";
	  $result=mysql_query($sql) or die(mysql_error());
	  $i=1;
	  
	  while($rows=mysql_fetch_array($result)){
	   $lg_code=$rows['lg_code'];
	   $lg_name=$rows['lg_name'];     	 
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'><a href='ward_result.php?lg_code=$lg_code'> $lg_name</a> </td>";
	$sqlv="SELECT * FROM party"; 
   $res2=mysql_query($sqlv) or die(mysql_error());
   while($rr2=mysql_fetch_array($res2)){ 
   $party_name=$rr2['party_name'];
   $number=lgg($party_name,$lg_code);
   $number2=number_format($number);
    echo"<td align='center' bgcolor='#FFFFFF'><b>$number</b></td>";
   }
  echo"</tr>";
   $i++;

	   }
		  
      ?>
  
  
  <tr>
    <th colspan="2" align="right" bgcolor="#FFFFFF">TOTAL:</th>
    <?php
	$sqlv="SELECT * FROM party"; 
   $res2=mysql_query($sqlv) or die(mysql_error());
   while($rr2=mysql_fetch_array($res2)){ 
   $party_name=$rr2['party_name'];
    $nn=tot($party_name,$state_code);
	$nn2=number_format($nn);
    echo"<th align='center' bgcolor='#33FFCC'>$nn2</th>";
    }
    ?>
  </tr>
</table>
</body>
</html>