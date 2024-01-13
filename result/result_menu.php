<?php 
include("loan.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<meta http-equiv="refresh" content="3 ; http:result_menu.php">
</head>

<body>
<table width="100%">
  <tr>
    <th scope="col">&nbsp;</th>
    <th align="left" valign="top" scope="col"><?php //include"../logout_link.php";  ?>&nbsp;</th>
  </tr>
  <tr>
    <th width="6%" scope="col">&nbsp;</th>
    <th width="94%" align="left" valign="top" scope="col"><table width="82%" cellpadding="1" cellspacing="1" bgcolor="#999999">
      <tr>
        <th width="100%" bgcolor="#CCCCCC" class="inputs" scope="col">Local Government Area</th>
      </tr>
      <tr>
        <th bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="lg_menu.php">
        </form></th>
      </tr>
      <tr>
        <th bgcolor="#FFFFFF" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <th bgcolor="#FFFFFF" scope="col"><table width="100%" cellpadding="1" cellspacing="1" bgcolor="#999999">
          <tr>
            <th colspan="2" bgcolor="#FFFFFF" scope="col"><span class="inputs">Local Government Area</span></th>
            <th colspan="5" bgcolor="#FFFFFF" scope="col"><span class="inputs">Political Parties</span></th>
            </tr>
          <tr>
            <td width="5%" align="center" bgcolor="#CCCCCC"><span class="inputs">S/N</span></td>
            <td width="41%" align="center" bgcolor="#CCCCCC"><span class="inputs">LG Name</span></td>
            <td width="13%" align="center" bgcolor="#CCCCCC"><span class="inputs">LP</span></td>
            <td width="11%" align="center" bgcolor="#CCCCCC"><span class="inputs">PDP</span></td>
            <td width="9%" align="center" bgcolor="#CCCCCC"><span class="inputs">APC</span></td>
            
            <td width="11%" align="center" bgcolor="#CCCCCC"><span class="inputs">Total</span></td>
          </tr>
          
          <?php 
		  include("../db/db.php");
	  $total_sum_LP=0;
	  $total_sum_PDP=0;
	  $total_sum_APC=0;
	  $sql= "SELECT * FROM lg";
	  $result=sqlsrv_query($dbconnect,$sql) or die(sqlsrv_error());
	  $i=1;
	  $grand_total=0;
	  while($rows=sqlsrv_fetch_array($result)){
	   $lg_id=$rows['lg_id'];
	   $LP="LP";
	   //$sql_LP="SELECT SUM(score) AS sum_score_LP FROM scores WHERE party_sign='$LP' AND lg_id='$lg_id'";
	   $sql_LP="SELECT SUM(LP) AS sum_LP FROM result WHERE lg_id='$lg_id'";
	   $result_LP=sqlsrv_query($dbconnect,$sql_LP) or die(sqlsrv_errors());
	   $rows_LP=sqlsrv_fetch_array($result_LP);
	   $sum_LP=$rows_LP['sum_LP'];
	   $total_sum_LP+=$sum_LP;
	   //=================================================================
	   $PDP="PDP";
	  //$sql_PDP="SELECT SUM(score) AS sum_score_PDP FROM scores WHERE party_sign='$PDP' AND lg_id='$lg_id'";
	   $sql_PDP="SELECT SUM(PDP) AS sum_PDP FROM result WHERE lg_id='$lg_id'";
	   $result_PDP=sqlsrv_query($dbconnect,$sql_PDP) or die(sqlsrv_errors());
	   $rows_PDP=sqlsrv_fetch_array($result_PDP);
	   $sum_PDP=$rows_PDP['sum_PDP'];
	   $total_sum_PDP+=$sum_PDP;
	   //=================================================================
	   $APC="APC";
	   //$sql_APC="SELECT SUM(score) AS sum_score_APC FROM scores WHERE party_sign='$APC' AND lg_id='$lg_id'";
	   $sql_APC="SELECT SUM(APC) AS sum_APC FROM result WHERE lg_id='$lg_id'";
	   $result_APC=sqlsrv_query($dbconnect,$sql_APC) or die(sqlsrv_errors());
	   $rows_APC=sqlsrv_fetch_array($result_APC);
	   $sum_APC=$rows_APC['sum_APC'];
	   $total_sum_APC+=$sum_APC;
	   $total_left=$sum_LP+$sum_PDP+$sum_APC;
          echo"<tr class='inputs'>
            <td align='center' bgcolor='#FFFFFF'>$i</td>
            <td align='left' bgcolor='#FFFFFF'>{$rows['lg_name']}</td>
            <td align='center' bgcolor='#FFFFFF'>$sum_LP</td>
            <td align='center' bgcolor='#FFFFFF'>$sum_PDP</td>
            <td align='center' bgcolor='#FFFFFF'>$sum_APC</td>
           
            <td align='center' bgcolor='#FFFFFF'>$total_left</td>
          </tr>";
		  $i++;
		  $grand_total+=$total_left;
	     }
		  
          ?>
          
          <tr>
            <td colspan="2" align="right" bgcolor="#FFFFFF">Total:</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo  $total_sum_LP ?>&nbsp;</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $total_sum_PDP ?>&nbsp;</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $total_sum_APC ?></td>
            
            <td align="center" bgcolor="#EFEFEF"><?php echo  $grand_total ?></td>
          </tr>
        </table></th>
      </tr>
    </table></th>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>