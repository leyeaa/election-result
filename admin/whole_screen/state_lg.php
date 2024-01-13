<?php 
error_reporting(0);
session_start();
include("../../include/database.php");
include("../../include/db_function.php");
if(isset($_GET['state_code'])){
	
$state_code=$_GET['state_code'];
$_SESSION['state_code']=$state_code;
}
if(isset($_SESSION['state_code'])){
$state_code=$_SESSION['state_code'];	
}


$state_name=state_name($state_code);
 function lgg($party_name,$lg_code,$state_code){
	 global $database;
       $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE lg_code='$lg_code' AND state_code='$state_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $sum_ZLP=$rows2['sum_ZLP'];
	   return $sum_ZLP;
  }
   function party_score($party_name,$state_code){
	   global $database;
       $sql2="SELECT SUM($party_name) AS sum_ZLP FROM result WHERE state_code='$state_code'";
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
<meta http-equiv="refresh" content="5 ; http:state_lg.php">
<title>::: RESULT :::</title>
<style type="text/css">
body,td,th {
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

<body bottommargin="0" rightmargin="0" leftmargin="0">
<table width="100%">
  <tr>
    <td align="center"><a href="all_state.php"><?php echo $state_name ?> STATE</a></td>
  </tr>
</table>
<table width="100%" cellpadding="6" cellspacing="1" bgcolor="#00CC33" id="n">
  
  <tr>
    <th width="6%" align="center" bgcolor="#FFFFFF">S/N</th>
    <th width="25%" align="center" bgcolor="#FFFFFF">LGA Name</th>
    <?php 
	 $sqla="SELECT * FROM party WHERE status IS NOT NULL"; 
   $resa=$database->query($sqla) or die($database->error());
   while($rra=$database->fetch_array($resa)){ 
   $party_name=$rra['party_name'];
    echo"<td width='11%' align='center' bgcolor='#FFE6E6'><strong>$party_name</strong></td>";
   }
    ?>
  </tr>
   <?php 
      
	  //$state_code=$_SESSION['state_code2'];
	  //$sql="SELECT * FROM lg WHERE state_code='$state_code'";
	  $sql="SELECT * FROM lg WHERE state_code='$state_code'";
	  $result=$database->query($sql) or die($database->error());
	  $i=1;
	  
	  while($rows=$database->fetch_array($result)){
	   $lg_code=$rows['lg_code'];
	   $lg_name=$rows['lg_name'];     	 
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'><a href='ward_result.php?lg_code=$lg_code'> $lg_name</a> </td>";
	$sqlv="SELECT * FROM party WHERE status IS NOT NULL"; 
   $res2=$database->query($sqlv) or die($database->error());
   while($rr2=$database->fetch_array($res2)){ 
   $party_name=$rr2['party_name'];
   $number=lgg($party_name,$lg_code,$state_code);
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
	$sqlv="SELECT * FROM party WHERE status IS NOT NULL"; 
   $res2=$database->query($sqlv) or die($database->error());
   while($rr2=$database->fetch_array($res2)){ 
   $party_name=$rr2['party_name'];
    $nn=party_score($party_name,$state_code);
	$nn2=number_format($nn);
    echo"<th align='center' bgcolor='#33FFCC'>$nn2</th>";
    }
    ?>
  </tr>
</table>
</body>
</html>