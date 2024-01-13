 <?php
error_reporting(0);
 include("../db/db2.php");	 
 //include("../validate/check_validate.php");
  
include("../validate/phone_validate.php");
 
	  $total_sum_ZLP=0;
	  $total_sum_PDP=0;
	  $total_sum_APC=0;
	   $ZLP="ZLP";
	   //$sql_ZLP="SELECT SUM(score) AS sum_score_ZLP FROM scores WHERE party_sign='$ZLP' AND lg_id='$lg_id'";
	   $sql_ZLP="SELECT SUM(ZLP) AS sum_ZLP FROM result";
	   $result_ZLP=mysql_query($sql_ZLP) or die(mysql_error());
	   $rows_ZLP=mysql_fetch_array($result_ZLP);
	   $sum_ZLP=$rows_ZLP['sum_ZLP'];
	   $sum_ZLP2=number_format($sum_ZLP);
	   //=================================================================
	   $sql_ADP="SELECT SUM(ADP) AS sum_ADP FROM result";
	   $result_ADP=mysql_query($sql_ADP) or die(mysql_error());
	   $rows_ADP=mysql_fetch_array($result_ADP);
	   $sum_ADP=$rows_ADP['sum_ADP'];
	   $sum_ADP2=number_format($sum_ADP);
	   //========================================================
	   
	   
	   $PDP="PDP";
	  //$sql_PDP="SELECT SUM(score) AS sum_score_PDP FROM scores WHERE party_sign='$PDP' AND lg_id='$lg_id'";
	   $sql_PDP="SELECT SUM(PDP) AS sum_PDP FROM result";
	   $result_PDP=mysql_query($sql_PDP) or die(mysql_error());
	   $rows_PDP=mysql_fetch_array($result_PDP);
	   $sum_PDP=$rows_PDP['sum_PDP'];
	   $sum_PDP2=number_format($sum_PDP);
	   //=================================================================
	   $APC="APC";
	   //$sql_APC="SELECT SUM(score) AS sum_score_APC FROM scores WHERE party_sign='$APC' AND lg_id='$lg_id'";
	   $sql_APC="SELECT SUM(APC) AS sum_APC FROM result";
	   $result_APC=mysql_query($sql_APC) or die(mysql_error());
	   $rows_APC=mysql_fetch_array($result_APC);
	   $sum_APC=$rows_APC['sum_APC'];
	   $sum_APC2=number_format($sum_APC);
	   //==================================
	   
	   $SDP="SDP";
	   //$sql_SDP="SELECT SUM(score) AS sum_score_SDP FROM scores WHERE party_sign='$SDP' AND lg_id='$lg_id'";
	   $sql_SDP="SELECT SUM(SDP) AS sum_SDP FROM result";
	   $result_SDP=mysql_query($sql_SDP) or die(mysql_error());
	   $rows_SDP=mysql_fetch_array($result_SDP);
	   $sum_SDP=$rows_SDP['sum_SDP'];
	   $sum_SDP2=number_format($sum_SDP);
	   //==================================
	  
	   $NA="NA";
	   $sql_NA="SELECT SUM(AV) AS sum_NA FROM result";
	   $result_NA=mysql_query($sql_NA) or die(mysql_error());
	   $rows_NA=mysql_fetch_array($result_NA);
	   $sum_NA=$rows_NA['sum_NA'];
	   $sum_NA2=number_format($sum_NA);
	   
	   $total=number_format($sum_ZLP+$sum_PDP+$sum_APC+$sum_SDP+$sum_ADP); 
	   $total_all=$sum_ZLP+$sum_PDP+$sum_APC+$sum_ADP;
	   //=========calculate percentage ZLP=====
	   $ZLP_percentage=($sum_ZLP/$total_all)*100;
	   $ZLP_per=number_format($ZLP_percentage,2);
	   //===========percentage for APC =========
	   $APC_percentage=($sum_APC/$total_all)*100;
	   $APC_per=number_format($APC_percentage,2);
	   //========= percentage PDP ================
	   $PDP_percentage=($sum_PDP/$total_all)*100;
	   $PDP_per=number_format($PDP_percentage,2);
	   //========= percentage SDP ================
	   $SDP_percentage=($sum_SDP/$total_all)*100;
	   $SDP_per=number_format($SDP_percentage,2);
	   // ADP
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1 ; http:overall_result.php">
<title>--</title>
</head>
<body topmargin="0" bottommargin="0">
<table width="80%" align="center" cellpadding="2" cellspacing="2" bgcolor="#CCCCCC">
  <tr>
    <th colspan="2" align="center" bgcolor="#66FF66" scope="col"><font size="+2" style="font-family:Tahoma, Geneva, sans-serif"> OVERALL  RESULT</font></th>
  </tr>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><img src="../image/ADP.jpg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 65px;"><b><?php echo $sum_ADP2 ?></b></font></td>
  </tr>
  <tr>
    <td width="15%" align="center" bgcolor="#EEEEEE"><img src="../image/apc.jpg" alt="" width="77" height="72" border="1" /></td>
    <td width="66%" align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 65px;"><b><?php echo $sum_APC2 ?></b></font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><img src="../image/ZLP2.jpg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo $sum_LP2 ?></b></font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><img src="../image/PDP.jpg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo $sum_PDP2 ?></b></font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><img src="../image/sdp.jpeg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo $sum_SDP2 ?></b></font></td>
  </tr>
  <tr>
    <th align="right" bgcolor="#FFC1D1"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 23px; color: #000000;">TOTAL:</font></th>
    <td align="right" bgcolor="#FFC1D1"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo  $total ?></b></font></td>
  </tr>
</table>
</body>
</html>