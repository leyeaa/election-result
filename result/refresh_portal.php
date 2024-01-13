<?php 
include("../db/db.php");
$sql="SELECT * FROM ozekimessagein";
$result=sqlsrv_query($dbconnect,$sql) or die(sqlsrv_errors());
//$i=1;
while($rows=sqlsrv_fetch_array($result)){

$msg=$rows['msg'];
/*$sender=$rows['sender'];
$senttime=$rows['senttime'];
$receivedtime=$rows['receivedtime'];*/
//===========================================================
//$smg="*89*LP*56*";
$smg2="*24*LP*56*APC*23*PDP*24*";
$arry_msg2=explode("*",$msg2);
$unit_id=$arry_msg2[1];
$LP=$arry_msg2[2];
$LP_score=$arry_msg2[3];
$APC=$arry_msg2[4];
$APC_score=$arry_msg2[5];
$PDP=$arry_msg2[6];
$PDP_score=$arry_msg2[7];

echo"$APC";
exit;
////////////////////////////////////////////////////////////
$arry_msg=explode("*",$msg);
$size_msg=sizeof($arry_msg);
//============================================================
$unit_id=$arry_msg[1];
$party_sign=$arry_msg[2];
$score=$arry_msg[3];
/*echo"$unit_id";
echo"$party_sign";
echo"$score";*/
//print_r ($arry_msg);
//$vvvv=split('[*]',$come_smg);
//print_r ($vvvv);
//======= polling Unit ================
          $sqlp= "SELECT * FROM polling_unit";
	      $resultp=sqlsrv_query($dbconnect,$sqlp) or die(sqlsrv_errors());
	      $rowsp=sqlsrv_fetch_array($resultp);
		  $unit_name=$rowsp['unit_name'];
		  $lg_id=$rowsp['lg_id'];
		  $ward_id=$rowsp['ward_id'];
/*//====== lg ===================
          $sql2= "SELECT * FROM lg WHERE lg_id='$lg_id'";
          $result2=sqlsrv_query($dbconnect,$sql2) or die(sqlsrv_error());	
          $rows2=sqlsrv_fetch_array($result2);
          $lg_name2=$rows2['lg_name'];
//====== Parties =============
          $sql3= "SELECT * FROM party WHERE party_id='$party_id'";
          $result3=sqlsrv_query($dbconnect,$sql3) or die(sqlsrv_error());	
          $rows3=sqlsrv_fetch_array($result3);
          $party_name=$rows3['party_name'];
          $party_sign=$rows3['party_sign'];
//====== Ward ================
          $sql4= "SELECT * FROM ward WHERE ward_id='$ward_id'";
          $result4=sqlsrv_query($dbconnect,$sql4) or die(sqlsrv_error());	
          $rows4=sqlsrv_fetch_array($result4);
          $ward_name=$rows4['ward_name'];
*/

$sql_t="SELECT * FROM scores WHERE unit_id='$unit_id' ";
$result_t=sqlsrv_query($dbconnect,$sql_t) or die("check");
if($rows_t=sqlsrv_fetch_array($result_t)){	
}
else{
//========= Insert Into Database Scores =========================================================
 $sql_in="INSERT INTO scores (unit_id,unit_name,party_sign,score,lg_id,ward_id) VALUES(?,?,?,?,?,?)";
 $params = array($unit_id,$unit_name,$party_sign,$score,$lg_id,$ward_id);
 sqlsrv_query($dbconnect,$sql_in,$params) or die ("insert");	
		
}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%">
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
	  $total_sum_LP=0;
	  $total_sum_PDP=0;
	  $total_sum_APC=0;
	  $sql= "SELECT * FROM lg";
	  $result=sqlsrv_query($dbconnect,$sql) or die(sqlsrv_error());
	  $i=1;
	  while($rows=sqlsrv_fetch_array($result)){
	   $lg_id=$rows['lg_id'];
	   $LP="LP";
	   $sql_LP="SELECT SUM(score) AS sum_score_LP FROM scores WHERE party_sign='$LP' AND lg_id='$lg_id'";
	   $result_LP=sqlsrv_query($dbconnect,$sql_LP) or die(sqlsrv_errors());
	   $rows_LP=sqlsrv_fetch_array($result_LP);
	   $sum_score_LP=$rows_LP['sum_score_LP'];
	   $total_sum_LP+=$sum_score_LP;
	   //=================================================================
	   $PDP="PDP";
	   $sql_PDP="SELECT SUM(score) AS sum_score_PDP FROM scores WHERE party_sign='$PDP' AND lg_id='$lg_id'";
	   $result_PDP=sqlsrv_query($dbconnect,$sql_PDP) or die(sqlsrv_errors());
	   $rows_PDP=sqlsrv_fetch_array($result_PDP);
	   $sum_score_PDP=$rows_PDP['sum_score_PDP'];
	   $total_sum_PDP+=$sum_score_PDP;
	   //=================================================================
	   $APC="APC";
	   $sql_APC="SELECT SUM(score) AS sum_score_APC FROM scores WHERE party_sign='$APC' AND lg_id='$lg_id'";
	   $result_APC=sqlsrv_query($dbconnect,$sql_APC) or die(sqlsrv_errors());
	   $rows_APC=sqlsrv_fetch_array($result_APC);
	   $sum_score_APC=$rows_APC['sum_score_APC'];
	   $total_sum_APC+=$sum_score_APC;
	   
          echo"<tr class='inputs'>
            <td align='center' bgcolor='#FFFFFF'>$i</td>
            <td align='left' bgcolor='#FFFFFF'>{$rows['lg_name']}</td>
            <td align='center' bgcolor='#FFFFFF'>$sum_score_LP</td>
            <td align='center' bgcolor='#FFFFFF'>$sum_score_PDP</td>
            <td align='center' bgcolor='#FFFFFF'>$sum_score_APC</td>
           
            <td align='center' bgcolor='#FFFFFF'>567</td>
          </tr>";
		  $i++;
	     }
          ?>
          
          <tr>
            <td colspan="2" align="right" bgcolor="#FFFFFF">Total:</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo  $total_sum_LP ?>&nbsp;</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $total_sum_PDP ?>&nbsp;</td>
            <td align="center" bgcolor="#EFEFEF"><?php echo $total_sum_APC ?></td>
            
            <td align="center" bgcolor="#EFEFEF">45555</td>
          </tr>
        </table></th>
      </tr>
    </table></th>
  </tr>
</table>
<p>&nbsp;</p>
<table width="79%" align="center">
  <tr>
    <th width="5%" scope="col">id</th>
    <th width="18%" scope="col">sender</th>
    <th width="47%" scope="col">reciver</th>
    <th width="17%" scope="col">message</th>
    <th width="13%" scope="col">sent time</th>
  </tr>
  
  <?php 
  include("../db/db.php");
  $sql="SELECT * FROM ozekimessagein";
  $result=sqlsrv_query($dbconnect,$sql ) or die("error occur");
  $i=1;
  while($rows=sqlsrv_fetch_array($result)){
 echo" <tr>
    <td align='center'>$i</td>
    <td>{$rows['sender']}</td>
    <td>{$rows['receiver']}</td>
    <td align='left'>{$rows['msg']}</td>
    <td align='center'>sent time</td>
  </tr>";
  $i++;
  }
  ?>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>