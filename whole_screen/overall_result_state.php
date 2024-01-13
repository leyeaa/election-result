 <?php
error_reporting(0);
 include("../db/db2.php");	 
 //include("../validate/check_validate.php");
 
  include("../validate/phone_validate.php");
	 
	   
	    function res($party_name){
	   $sql_SDP="SELECT SUM($party_name) AS party FROM result";
	   $result_SDP=mysql_query($sql_SDP) or die(mysql_error());
	   $rows_SDP=mysql_fetch_array($result_SDP);
	   $sum_SDP=$rows_SDP['party'];
	   return $sum_SDP;
	   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1 ; http:overall_result_state.php">
<title>::: OVERALL RESULT :::</title>
</head>
<body topmargin="0" bottommargin="0">
<table width="100%" celZLPadding="3" cellspacing="1" bgcolor="#FF0000">
  <tr>
    <th colspan="3" align="center" bgcolor="#66FF66" scope="col"><font size="+2" style="font-family:Tahoma, Geneva, sans-serif"> OVERALL  RESULT</font></th>
  </tr>
  <?php
   $sql="SELECT * FROM party"; 
   $res=mysql_query($sql) or die(mysql_error());
   $tot=0;
   while($rr=mysql_fetch_array($res)){ 
   $party_name=$rr['party_name'];
   $num=res($party_name);
   $num2=number_format($num); 
  echo"<tr>
    <td align='center' bgcolor='#CCCCCC'><font size='+3' style='font-family:Tahoma, Geneva, sans-serif; font-size: 23px; color: #000000;'><b>$party_name</b></font></td>
    <td align='right' bgcolor='#FFFFFF'><font size='+5' style='font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 65px;'><b>$num2</b></font></td>
    <td align='right' bgcolor='#FFFFFF'><font size='+5' color='#000000'><b></b></font></td>
  </tr>";
  $total+=$num;
  }
  $total_gr=number_format($total);
  ?>

  <tr>
    <th width="13%" align="right" bgcolor="#FFC1D1"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 23px; color: #000000;"><b>TOTAL:</b></font></th>
    <td width="77%" align="right" bgcolor="#FFC1D1"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 65px; color: #000000;"><b><?php echo  $total_gr ?></b></font></td>
    <td width="10%" align="right" bgcolor="#FFC1D1">&nbsp;</td>
  </tr>
</table>
</body>
</html>