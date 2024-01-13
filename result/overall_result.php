 <?php
 error_reporting(0);
  include("../db/db.php");
  include("loan.php");
	  $total_sum_LP=0;
	  $total_sum_PDP=0;
	  $total_sum_APC=0;
	   $LP="LP";
	   //$sql_LP="SELECT SUM(score) AS sum_score_LP FROM scores WHERE party_sign='$LP' AND lg_id='$lg_id'";
	   $sql_LP="SELECT SUM(LP) AS sum_LP FROM result";
	   $result_LP=sqlsrv_query($dbconnect,$sql_LP) or die(sqlsrv_errors());
	   $rows_LP=sqlsrv_fetch_array($result_LP);
	   $sum_LP=$rows_LP['sum_LP'];
	   $sum_LP2=number_format($sum_LP);
	   //=================================================================
	   $PDP="PDP";
	  //$sql_PDP="SELECT SUM(score) AS sum_score_PDP FROM scores WHERE party_sign='$PDP' AND lg_id='$lg_id'";
	   $sql_PDP="SELECT SUM(PDP) AS sum_PDP FROM result";
	   $result_PDP=sqlsrv_query($dbconnect,$sql_PDP) or die(sqlsrv_errors());
	   $rows_PDP=sqlsrv_fetch_array($result_PDP);
	   $sum_PDP=$rows_PDP['sum_PDP'];
	   $sum_PDP2=number_format($sum_PDP);
	   //=================================================================
	   $APC="APC";
	   //$sql_APC="SELECT SUM(score) AS sum_score_APC FROM scores WHERE party_sign='$APC' AND lg_id='$lg_id'";
	   $sql_APC="SELECT SUM(APC) AS sum_APC FROM result";
	   $result_APC=sqlsrv_query($dbconnect,$sql_APC) or die(sqlsrv_errors());
	   $rows_APC=sqlsrv_fetch_array($result_APC);
	   $sum_APC=$rows_APC['sum_APC'];
	   $sum_APC2=number_format($sum_APC);
	   //==================================
	   $total=number_format($sum_LP+$sum_PDP+$sum_APC); 
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
	   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="3 ; http:overall_result.php">
<title>Untitled Document</title>
</head>
<body>
<table width="100%">
  <tr>
    <th width="14%" scope="col">&nbsp;</th>
    <th width="86%" align="left" scope="col"><table width="70%" cellpadding="4" cellspacing="5" bgcolor="#CCCCCC">
      <tr>
        <th colspan="3" bgcolor="#FFFFCC" scope="col"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif">  OVERALL FINAL RESULT</font></th>
        </tr>
      <tr>
        <td width="17%" align="right" bgcolor="#CCCCCC"><img src="../image/ACN-LOGO.jpg" alt="" width="112" height="100" border="1" /></td>
        <td width="61%" align="right" bgcolor="#FFFFFF"><font size="+6" style="font-family:Tahoma, Geneva, sans-serif; color: #666; font-size: 77px;"><?php echo $sum_APC2 ?></font></td>
        <td width="22%" align="right" bgcolor="#FFFFFF"><font size="+5" color="#999999"><?php echo $APC_per ?>%</font></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#CCCCCC"><img src="../image/LP2.jpg" alt="" width="112" height="100" border="1" /></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #666;"><?php echo $sum_LP2 ?></font></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+5" color="#999999"><?php echo $LP_per ?>%</font></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#CCCCCC"><img src="../image/PDP.jpg" alt="" width="112" height="100" border="1" /></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 77px; color: #666;"><?php echo $sum_PDP2 ?></font></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+4" color="#999999"><?php echo $PDP_per?>%</font></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#FFFFCC"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 23px; color: #666;">TOTAL:</font></td>
        <td align="right" bgcolor="#FFFFCC"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #666;"><?php echo  $total ?></font></td>
        <td align="right" bgcolor="#FFFFCC">&nbsp;</td>
      </tr>
    </table></th>
  </tr>
</table>
</body>
</html>