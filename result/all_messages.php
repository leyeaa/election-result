<?php
 include("../db/db.php");
if(isset($_GET['msg_id'])){	
$msg_id=$_GET['msg_id'];

$msgplid=$_GET['plid'];
$xc=explode("*",$msgplid);
$unit1=$xc[1]; //exit;

$sql="DELETE FROM MessageIn WHERE Id ='$msg_id'";
mysql_query($sql) or die("can not delete");	
//========================
      $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit1'";
	  $resulp=mysql_query($sqlp) or die(mysql_errors());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_id=$rowp['unit_id'];


$sql2="DELETE FROM result WHERE unit_id ='$unit_id'";
mysql_query($sql2) or die("can not delete Result");
}



if(isset($_GET['validate_id'])){
$msg_id2=$_GET['validate_id'];

$msgplid=$_GET['plid'];
$xc=explode("*",$msgplid);
$unit1=$xc[1]; //exit;

$sqlchk="SELECT * FROM MessageIn WHERE Id ='$msg_id2'";
$s=mysql_query($sqlchk) or die("can not delete");	
$rlt=mysql_fetch_array($s);
$sta=$rlt['status'];
if($sta==0){
$status=1;
}else{
$status=0;	
}
$sql="UPDATE MessageIn SET status='$status' WHERE Id ='$msg_id2'";
mysql_query($sql) or die("vali");	

/*$sql="DELETE FROM result WHERE unit_id ='$unit1'";
mysql_query($dbconnect,$sql) or die("can not delete");	*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="3 ; http:all_messages.php">
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
.name-phone {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
	color: #F00;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>
</head>

<body>
<table width="100%" cellpadding="1" cellspacing="1" bgcolor="#999999">
  <tr>
    <th colspan="6" scope="col">Number of Message Received</th>
  </tr>
  <tr>
    <td width="3%" align="center" bgcolor="#CCCCCC">S/N</td>
    <td width="9%" align="center" bgcolor="#CCCCCC">Sender</td>
    <td width="38%" align="center" bgcolor="#CCCCCC">Local Gov || Polling Unit</td>
    <td width="18%" align="center" bgcolor="#CCCCCC">Message</td>
    <td width="32%" colspan="3" bgcolor="#CCCCCC">&nbsp; </td>
  </tr>
  
   <?php 
  include("../db/db.php");
  $sql="SELECT * FROM MessageIn ORDER BY MessageFrom";
  $result=mysql_query($sql ) or die("error occur");
  $i=1;
  while($rows=mysql_fetch_array($result)){
	  $validate=$rows['status'];
	  if($validate==1){
	  $me="Validated";
	  $bg="#66FF66";
	  }
	  else{
		$me="Not Validated";
		$bg="#FFFFFF"; 
	  }
	  
	  $msg2=$rows['MessageText'];
	  $arry_msg2=explode("*",$msg2);
      $unit_code=$arry_msg2[1];

      $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit_code'";
	  $resulp=mysql_query($sqlp) or die(mysql_errors());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_name=$rowp['unit_name'];
	  $lg_id=$rowp['lg_id'];
	  //--------------
	  $sqlq= "SELECT * FROM lg WHERE lg_id='$lg_id'";
      $resultq=mysql_query($sqlq) or die(mysql_error());	
      $rowsq=mysql_fetch_array($resultq);
      $lg_name=$rowsq['lg_name'];
	  
	  
 echo" <tr>
    <td align='center' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>{$rows['MessageFrom']}</td>
    <td bgcolor='#FFFFFF'>$lg_name || $unit_name</td>
    <td bgcolor='#FFFFFF'>{$rows['MessageText']}</td>
    <td width='4%' align='center' bgcolor='#FFFFFF'><a href='edit_msg.php?id={$rows['Id']}' target='all_page'>Edit</a></td>
    <td width='4%' align='center' bgcolor='#FFFFFF'><a href='all_messages.php?msg_id={$rows['Id']}&plid={$rows['MessageText']}' target='all_page'>Delete</a></td>
	<td width='6%' align='center' bgcolor='$bg'><a href='all_messages.php?validate_id={$rows['Id']}&plid={$rows['MessageText']}' target='all_page'>$me</a></td>
  </tr>";
  $i++;
  }
  ?>
</table>
</body>
</html>