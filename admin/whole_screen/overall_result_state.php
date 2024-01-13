 <?php
 session_start();
error_reporting(0);
 include("../../include/database.php");
include("../../include/db_function.php"); 
 //include("../validate/check_validate.php");
 
  include("../../validate/phone_validate.php");
	 


	    function res($party_name){
			global $database;
	   $sql_SDP="SELECT SUM($party_name) AS party FROM result";// WHERE state_code='$state_code'";
	   $result_SDP=$database->query($sql_SDP) or die($database->error());
	   $rows_SDP=$database->fetch_array($result_SDP);
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
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
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
</style>
</head>
<body topmargin="0" bottommargin="0">
<table width="100%" cellspacing="1" bgcolor="#FF0000" id="n" celZLPadding="3">
  <tr>
    <th colspan="3" align="center" bgcolor="#66FF66" scope="col">NATION WIDE RESULT SUMMARY </th>
  </tr>
  <?php
   $sql="SELECT * FROM party WHERE status IS NOT NULL"; 
   $res=$database->query($sql) or die($database->error());
   $tot=0;
   $total=0;
   while($rr=$database->fetch_array($res)){ 
   $party_name=$rr['party_name'];
   $num=res($party_name);
   $num2=number_format($num); 
  echo"<tr>
    <td align='center' bgcolor='#CCCCCC'><font size='+3' style='font-family:Tahoma, Geneva, sans-serif; font-size: 18px; color: #000000;'><b>$party_name</b></font></td>
    <td align='right' bgcolor='#FFFFFF'><font size='+5' style='font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 35px;'><b>$num2</b></font></td>
    <td align='right' bgcolor='#FFFFFF'><font size='+5' color='#000000'><b></b></font></td>
  </tr>";
  $total+=$num;
  }
  $total_gr=number_format($total);
  ?>

  <tr>
    <th width="13%" align="right" bgcolor="#FFC1D1"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 18px; color: #000000;"><b>TOTAL:</b></font></th>
    <td width="77%" align="right" bgcolor="#FFC1D1"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 35px; color: #000000;"><b><?php echo  $total_gr ?></b></font></td>
    <td width="10%" align="right" bgcolor="#FFC1D1">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>