 <?php
 //error_reporting(0);
 include("../db/db2.php");
 //include("../result/loan.php");
 
 $r2="SELECT * FROM result";// WHERE status=1";
 $ros=mysql_query($r2) or die(mysql_error());
 while($rrr=mysql_fetch_array($ros)){
	//$result_id=$rrr['result_id'];
	$unit_code=$rrr['unit_code'];
	$ward_code=$rrr['ward_code'];
	$unit_name=$rrr['unit_name'];
	$lg_code=$rrr['lg_code'];
	$LP=$rrr['LP'];
	$PDP=$rrr['PDP'];
	$APC=$rrr['APC'];
 }
	 
 include("../validate/result_new.php");  ///remember to committes this when it is real time
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
	   $NA="NA";
	   $sql_NA="SELECT SUM(no_accredited) AS sum_NA FROM no_accredited";
	   $result_NA=mysql_query($sql_NA) or die(mysql_error());
	   $rows_NA=mysql_fetch_array($result_NA);
	   $sum_NA=$rows_NA['sum_NA'];
	   $sum_NA2=number_format($sum_NA);
	   
	   
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
<meta http-equiv="refresh" content="1 ; http:overall_result.php">
<title>Untitled Document</title>
</head>
<body>
<table width="100%">
  <tr>
    <th width="14%" scope="col"><form id="form1" name="form1" method="post" action="overall_result.php">
    </form></th>
    <th width="86%" align="left" scope="col"><table width="70%" cellpadding="4" cellspacing="5" bgcolor="#CCCCCC">
      <tr>
        <th colspan="3" align="center" bgcolor="#FFFFCC" scope="col"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif">  OVERALL FINAL RESULT</font></th>
        </tr>
      <tr>
        <td align="center" bgcolor="#E3E3E3"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; color: #666; font-size: 65px;">AV</font></td>
        <td align="right" bgcolor="#E3E3E3"><font size="+4" style="font-family:Tahoma, Geneva, sans-serif; color: #666; font-size: 65px;"><?php echo $sum_NA2 ?></font></td>
        <td align="center" bgcolor="#E3E3E3">Number<br /> 
          of Accredited Voter</td>
      </tr>
      <tr>
        <td width="15%" align="center" bgcolor="#CCCCCC"><img src="../image/apc.jpg" alt="" width="95" height="85" border="1" /></td>
        <td width="66%" align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; color: #666; font-size: 65px;"><?php echo $sum_APC2 ?></font></td>
        <td width="19%" align="right" bgcolor="#FFFFFF"><font size="+5" color="#999999"><?php echo $APC_per ?>%</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC"><img src="../image/LP2.jpg" alt="" width="94" height="87" border="1" /></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #666;"><?php echo $sum_LP2 ?></font></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+5" color="#999999"><?php echo $LP_per ?>%</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC"><img src="../image/PDP.jpg" alt="" width="94" height="87" border="1" /></td>
        <td align="right" bgcolor="#FFFFFF"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #666;"><?php echo $sum_PDP2 ?></font></td>
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