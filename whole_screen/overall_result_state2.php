 <?php
//error_reporting(0);
 include("../db/db2.php");	 
 include("../validate/check_validate.php");

	  $total_sum_LP=0;
	  $total_sum_PDP=0;
	  $total_sum_APC=0;
	   $LP="LP";
	   //$sql_LP="SELECT SUM(score) AS sum_score_LP FROM scores WHERE party_sign='$LP' AND lg_id='$lg_id'";
	   $sql_LP="SELECT SUM(LP) AS sum_LP FROM result";
	   $result_LP=mysql_query($sql_LP) or die(mysql_error());
	   $rows_LP=mysql_fetch_array($result_LP);
	   $sum_LP=$rows_LP['sum_LP'];
	   $sum_LP2=number_format($sum_LP);
	   //=================================================================
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
	   
	   $total=number_format($sum_LP+$sum_PDP+$sum_APC+$sum_SDP); 
	   $total_all=$sum_LP+$sum_PDP+$sum_APC;
	   //=========calculate percentage LP=====
	   $LP_percentage=($sum_LP/$total_all)*100;
	   $LP_per=number_format($LP_percentage,2);
	   //===========percentage for APC =========
	   $APC_percentage=($sum_APC/$total_all)*100;
	   $APC_per=number_format($APC_percentage,2);
	   //========= percentage PDP ================
	   $PDP_percentage=($sum_PDP/$total_all)*100;
	   $PDP_per=number_format($PDP_percentage,2);
	   //========= percentage SDP ================
	   $SDP_percentage=($sum_SDP/$total_all)*100;
	   $SDP_per=number_format($SDP_percentage,2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1 ; http:overall_result_state.php">
<title>--</title>
</head>
<body topmargin="0" bottommargin="0">
<table width="100%" cellpadding="4" cellspacing="5" bgcolor="#CCCCCC">
  <tr>
    <th colspan="3" align="center" bgcolor="#66FF66" scope="col"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif"> OVERALL  RESULT</font></th>
  </tr>
  <tr>
    <td align="center" bgcolor="#E3E3E3"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 55px;"><b>AV</b></font></td>
    <td align="right" bgcolor="#E3E3E3"><font size="+4" style="font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 65px;"><b><?php echo $sum_NA2 ?></b></font></td>
    <td align="center" bgcolor="#E3E3E3">Number<br />
      of Accredited Voter</td>
  </tr>
  <tr>
    <td width="15%" align="center" bgcolor="#CCCCCC"><img src="../image/apc.jpg" alt="" width="77" height="72" border="1" /></td>
    <td width="66%" align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 65px;"><b><?php echo $sum_APC2 ?></b></font></td>
    <td width="19%" align="right" bgcolor="#FFFFFF"><font size="+5" color="#000000"><b><?php echo $APC_per ?>%</b></font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><img src="../image/LP2.jpg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo $sum_LP2 ?></b></font></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" color="#000000"><b><?php echo $LP_per ?>%</b></font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><img src="../image/PDP.jpg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo $sum_PDP2 ?></b></font></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+4" color="#000000"><b><?php echo $PDP_per?>%</b></font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><img src="../image/sdp.jpeg" alt="" width="77" height="72" border="1" /></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo $sum_SDP2 ?></b></font></td>
    <td align="right" bgcolor="#FFFFFF"><font size="+4" color="#000000"><b><?php echo $SDP_per?>%</b></font></td>
  </tr>
  <tr>
    <th align="right" bgcolor="#FFC1D1"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 23px; color: #000000;">TOTAL:</font></th>
    <td align="right" bgcolor="#FFC1D1"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo  $total ?></b></font></td>
    <td align="right" bgcolor="#FFC1D1">&nbsp;</td>
  </tr>
</table>
</body>
</html>