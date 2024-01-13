<?php 
include("loan.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Ward Details</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%">
  <tr>
    <th width="6%" scope="col">&nbsp;</th>
    <th width="94%" align="left" valign="top" scope="col"><table width="89%" cellpadding="1" cellspacing="1" bgcolor="#999999">
      <tr>
        <th width="100%" bgcolor="#CCCCCC" class="inputs" scope="col">Local Government  Result by Ward</th>
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
            <th colspan="3" bgcolor="#FFFFFF" scope="col"><span class="inputs">Local Government Area / Wards</span></th>
            <th colspan="4" bgcolor="#FFFFFF" scope="col"><span class="inputs">Political Parties</span></th>
          </tr>
          <tr>
            <td width="3%" align="center" bgcolor="#CCCCCC"><span class="inputs">S/N</span></td>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><span class="inputs">LG Name</span></td>
            <td width="12%" align="center" bgcolor="#CCCCCC"><span class="inputs">LP</span></td>
            <td width="9%" align="center" bgcolor="#CCCCCC"><span class="inputs">PDP</span></td>
            <td width="9%" align="center" bgcolor="#CCCCCC"><span class="inputs">APC</span></td>
            <td width="9%" align="center" bgcolor="#CCCCCC"><span class="inputs">Total</span></td>
          </tr>
          <?php
          include("../db/db.php");
          $sql2= "SELECT * FROM lg";
          $result2=sqlsrv_query($dbconnect,$sql2) or die(sqlsrv_error());
          $i=1;	
          while($rows2=sqlsrv_fetch_array($result2))
          {
           $lg_id=$rows2['lg_id'];
          echo"<tr class='inputs'>
            <td align='center' bgcolor='#FFFFFF'>$i</td>
            <td colspan='6' align='left' bgcolor='#FFFFFF' class='resu'>{$rows2['lg_name']}</td>
            </tr>"; 
          $LP_sum=0;
		  $PDP_sum=0;
		  $APC_sum=0;
          $sqlp= "SELECT * FROM ward WHERE lg_id='$lg_id'";
	      $resultp=sqlsrv_query($dbconnect,$sqlp) or die(sqlsrv_errors());
          $p=1;
	      while($rowsp=sqlsrv_fetch_array($resultp)){
          $ward_id=$rowsp['ward_id'];
          $sqlr="SELECT SUM(LP) AS LP,SUM(APC) AS APC, SUM(PDP) AS PDP FROM result WHERE ward_id='$ward_id'";
	      $resultr=sqlsrv_query($dbconnect,$sqlr) or die(sqlsrv_errors());
	      $rowsr=sqlsrv_fetch_array($resultr);
          $LP=$rowsr['LP'];
          $PDP=$rowsr['PDP'];
          $APC=$rowsr['APC'];
          $total_left=$LP+$PDP+$APC; 
           
          echo"<tr class='inputs'>
            <td align='center' bgcolor='#FFFFFF'>&nbsp;</td>
            <td width='55%' align='right' bgcolor='#FFFFFF'>{$rowsp['ward_name']}:</td>
            <td width='3%' align='center' bgcolor='#FFFFFF'>$p</td>
            <td align='center' bgcolor='#FFFFFF'>$LP</td>
            <td align='center' bgcolor='#FFFFFF'>$PDP</td>
            <td align='center' bgcolor='#FFFFFF'>$APC</td>
            <td align='center' bgcolor='#FFFFFF'>$total_left</td>
          </tr>";
           $p++;
		   $LP_sum+=$LP;
		   $PDP_sum+=$PDP;
		   $APC_sum+=$APC;
          }
	$p++;
       
         echo" <tr class='inputs'>
            <td align='center' bgcolor='#FFFFFF'>&nbsp;</td>
            <td colspan='2' align='right' bgcolor='#FFFFFF'>Total:</td>
            <td align='center' bgcolor='#FFFF99'>$LP_sum</td>
            <td align='center' bgcolor='#FFFF99'>$PDP_sum </td>
            <td align='center' bgcolor='#FFFF99'>$APC_sum</td>
            <td align='center' bgcolor='#FFFF99'></td>
          </tr>";
		  $i++;
		}  
		 
		 $sqlg="SELECT SUM(LP) AS LP_total, SUM(PDP) AS PDP_total, SUM(APC) AS APC_total FROM result";
		 $resultg=sqlsrv_query($dbconnect,$sqlg) or die("tott");
		 $rowsg=sqlsrv_fetch_array($resultg);
		 $LP_total=$rowsg['LP_total'];
		 $PDP_total=$rowsg['PDP_total'];
		 $APC_total=$rowsg['APC_total'];
		 $grand_total=$LP_total+$PDP_total+$APC_total;
        ?>  
          
          <tr class="inputs">
            <td colspan="7" align="center" bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          <tr class="inputs">
            <td colspan="3" align="right" bgcolor="#FFFFFF">Grand Total:</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $LP_total ?></td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $PDP_total ?></td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $APC_total ?></td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $grand_total ?></td>
          </tr>
        </table></th>
      </tr>
    </table></th>
  </tr>
</table>
</body>
</html>