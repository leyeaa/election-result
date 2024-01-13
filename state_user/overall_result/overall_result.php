 <?php
 ob_start();
 session_start();
//error_reporting(0);	
include("../../include/database.php");
include("../../include/db_function.php"); 
//include("../validate/check_validate.php"); 
$state_code=$_SESSION['state_code'];
include("../../validate/phone_validate.php");
$state_name=state_name($state_code); 
	   function res($party_name,$state_code){
		global $database;
	   $sql_SDP="SELECT SUM($party_name) AS party FROM result WHERE state_code='$state_code'";
	   $result_SDP=$database->query($sql_SDP) or die($database->error());
	   $rows_SDP=$database->fetch_array($result_SDP);
	   $sum_SDP=$rows_SDP['party'];
	   return $sum_SDP;
	   }
	  ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1 ; http:overall_result.php">
<title>--</title>
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
<table width="50%" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="n">
  <tr>
    <th colspan="2" align="center" bgcolor="#FFC1D1" scope="col"><font size="+2" style="font-family:Tahoma, Geneva, sans-serif"><b><?php echo @$state_name ?> STATE RESULT</b></font></th>
  </tr>

  <?php
   $sql="SELECT * FROM party"; 
   $res=$database->query($sql) or die($database->error());
   $tot=0;
   $total=0;
   while($rr=$database->fetch_array($res)){ 
   $party_name=$rr['party_name'];
   $num=res($party_name,$state_code);
   $num2=number_format($num); 
  echo"<tr>
    <td  width='11%' align='center' bgcolor='#EEEEEE'><font size='+3' style='font-family:Tahoma, Geneva, sans-serif; font-size: 15px; color: #000000;'><b>$party_name</b></font></td>
    <td align='right' bgcolor='#FFFFFF'><font size='+3' style='font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 35px;'><b>$num2</b></font></td>
  </tr>";
  $total+=$num;
  }
  $total_gr=number_format($total);
  ?>

  <tr>
    <th width="16%" align="right" bgcolor="#FFC1D1"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 15px; color: #000000;">TOTAL:</font></th>
    <td width="84%" align="right" bgcolor="#FFC1D1"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 35px; color: #000000;"><b><?php echo  $total_gr ?></b></font></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>