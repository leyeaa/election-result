<?php 
session_start();
if(isset($_POST['Print'])){
 $lg_code=$_POST['lg_code'];
 $ward_code=$_POST['ward_code'];
 if($lg_code == "None"){ 
 // print state result
  }
  elseif($lg_code !="None")
       {
	   //print local Government result  
	   header("location:print_local.php");
	   exit;  
	   }
  elseif($ward_code !="None")
	   {
		  
	    header("location:print_ward.php");
	    exit; 
       }
	
}
include("../db/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>::: RESULT :::</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
}
</style>
</head>

<body bottommargin="0" rightmargin="0" leftmargin="0" topmargin="0">
<p>&nbsp;</p>
<table width="90%" align="center" cellpadding="5" cellspacing="2" bgcolor="#00CC33">
  <tr bgcolor="#FFFFCC">
    <th colspan="8" align="center" bgcolor="#FFFFCC">STATE   RESULT</th>
  </tr>
  <tr>
    <td width="5%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="24%" align="center" bgcolor="#FFFFFF">State Name</td>
    <td width="12%" align="center" bgcolor="#FF8080"><strong>NA</strong></td>
    <td width="14%" align="center" bgcolor="#FF8080"><strong>APC</strong></td>
    <td width="13%" align="center" bgcolor="#FF8080"><strong>LP</strong></td>
    <td width="12%" align="center" bgcolor="#FF8080"><strong>PDP</strong></td>
    <th width="10%" align="center" bgcolor="#FF8080">OT</th>
    <th width="10%" align="center" bgcolor="#FF8080">AFGA</th>
  </tr>
   <?php 
	  $sql="SELECT * FROM state";
	  $result=mysql_query($sql) or die(mysql_error());
	  $i=1;
	  $total_sum_LP=0;
	  $total_sum_PDP=0;
	  $total_sum_APC=0;
	  $total_sum_NA=0;
	  $grand_total=0;
	  while($rows=mysql_fetch_array($result)){
	   $state_code=$rows['state_code'];
	   $state_name=$rows['state_name'];
	   $sql2="SELECT SUM(LP) AS sum_LP, SUM(PDP) AS sum_PDP, SUM(APC) AS sum_APC FROM result WHERE state_code='$state_code'";
	   $result2=mysql_query($sql2) or die(mysql_error());
	   $rows2=mysql_fetch_array($result2);
	   $sum_LP=$rows2['sum_LP'];
	   $sum_LP2=number_format($rows2['sum_LP']);
	   $total_sum_LP+=$sum_LP;
	   $total_sum_LP2=number_format($total_sum_LP);
	   //----
	   $sum_APC2=number_format($rows2['sum_APC']);
	   $sum_APC=$rows2['sum_APC'];
	   $total_sum_APC+=$sum_APC;
	   $total_sum_APC2=number_format($total_sum_APC);
	   //----
	   $sum_PDP2=number_format($rows2['sum_PDP']);
	   $sum_PDP=$rows2['sum_PDP'];
	   $total_sum_PDP+=$sum_PDP;
       $total_sum_PDP2=number_format($total_sum_PDP);
       
	   $NA="NA";
	   //$sql_NA="SELECT SUM(score) AS sum_score_NA FROM scores WHERE party_sign='$NA' AND state_code='$state_code'";
	   $sql_NA="SELECT SUM(AV) AS sum_NA FROM result WHERE state_code='$state_code'";
	   $result_NA=mysql_query($sql_NA) or die(mysql_error());
	   $rows_NA=mysql_fetch_array($result_NA);
	   $sum_NA2=number_format($rows_NA['sum_NA']);
	   $sum_NA=$rows_NA['sum_NA'];
	   $total_sum_NA+=$sum_NA;
	   $total_sum_NA2=number_format($total_sum_NA);
	   
	   //total of the party
	    $total_party = $sum_LP+$sum_APC+ $sum_PDP;
		 if($total_party > $sum_NA){
		  $bg="#FF0000"; 
		 }
		 else{
		  $bg="#FFFFFF";
		 }
	   
  echo"<tr>
    <td align='center' bgcolor='$bg'>$i</td>
    <td bgcolor='$bg'>$state_name </td>
    <td align='center' bgcolor='#FFFFCC'>$sum_NA2</td>
    <td align='center' bgcolor='#FFFFFF'>$sum_APC2</td>
    <td align='center' bgcolor='#FFFFFF'>$sum_LP2</td>
    <td align='center' bgcolor='#FFFFFF'>$sum_PDP2</td>
	<td align='center' bgcolor='#FFFFFF'></td>
    <td align='center' bgcolor='#FFFFFF'></td>
  </tr>";
   $i++;

	   }
		  
      ?>
  
  
  <tr>
    <th colspan="2" align="right" bgcolor="#FFFFFF">TOTAL:</th>
    <th align="center" bgcolor="#33FFCC"><?php echo $total_sum_NA2 ?></th>
    <th align="center" bgcolor="#33FFCC"><?php echo $total_sum_APC2 ?></th>
    <th align="center" bgcolor="#33FFCC"><?php echo $total_sum_LP2 ?></th>
    <th align="center" bgcolor="#33FFCC"><?php echo $total_sum_PDP2 ?></th>
    <th align="center" bgcolor="#33FFCC"></th>
    <th align="center" bgcolor="#33FFCC"></th>
  </tr>
</table>
</body>
</html>