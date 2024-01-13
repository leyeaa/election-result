<?php
ob_start();
session_start();
include("../../include/database.php");
include("../../include/db_function.php");
$state_code=$_SESSION['state_code'];
$state_name=state_name($state_code); 
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<body topmargin="0">
<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#999999">
  <tr bgcolor="#FFFFFF">
    <th colspan="6" align="center" scope="col"><?php echo $state_name ?> STATE </th>
  </tr>
  <tr>
    <th colspan="6" scope="col">Number of Messages Received</th>
  </tr>
  <tr>
    <th colspan="7" bgcolor="#FFFFFF" scope="col"><?php if(isset($_REQUEST['message'])) echo $_REQUEST['message'] ?></th>
  </tr>
  <tr>
    <td width="3%" align="center" bgcolor="#CCCCCC">S/N</td>
    <td width="9%" align="center" bgcolor="#CCCCCC">Sender</td>
    <td width="38%" align="center" bgcolor="#CCCCCC">Message</td>
   
    <td width="32%" colspan="4" bgcolor="#CCCCCC">&nbsp; </td>
  </tr>
  
   <?php 
  $sql="SELECT * FROM wrong_messagein WHERE state_code='$state_code' ORDER BY MessageFrom";
  $result=$database->query($sql ) or die("error occur");
  $i=1;
  while($rows=$database->fetch_array($result)){
	  $validate=$rows['status'];
	  $msg2=$rows['MessageText'];
	  
	  /*$arry_msg2=explode("*",$msg2);
      $unit_code=$arry_msg2[0]; 
	  //-----------------
	  $state_code=substr($unit_code,0,2);
	  $lg_code=substr($unit_code,0,4);
	  $ward_code=substr($unit_code,0,6);
	  
	 
	  
      $state_name=state_name($state_code);
      $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit_code'";
	  $resulp=$database->query($sqlp) or die($database->error());
	  $rowp=$database->fetch_array($resulp);
	  $unit_name=$rowp['unit_name'];
	  
	  //--------------
	  $sqlq= "SELECT * FROM lg WHERE lg_code='$lg_code'";
      $resultq=$database->query($sqlq) or die($database->error());	
      $rowsq=$database->fetch_array($resultq);
      $lg_name=$rowsq['lg_name'];*/
	  
	  
 echo" <tr>
    <td align='center' bgcolor='#FFFFFF'>$i</td>
    <td bgcolor='#FFFFFF'>{$rows['MessageFrom']}</td>
    <td bgcolor='#FFFFFF'>{$rows['MessageText']}</td>
    
    <td width='4%' align='center' bgcolor='#FFFFFF'><a href='edit_msg.php?id={$rows['Id']}' target='all_page'>Edit</a></td>
    <td width='4%' align='center' bgcolor='#FFFFFF'><a href='delete.php?id={$rows['Id']}' target='all_page'>Delete</a></td>
	<td width='6%' align='center' bgcolor='#FFFFFF'><a href='security.php?id={$rows['Id']}' target='all_page'></a></td>
	<td width='6%' align='center' bgcolor='#FFFFFF'><a href='validation.php?id={$rows['Id']}'target='all_page'>Send to Result</a></td>
  </tr>";
  $i++;
  }
  ?>
</table>
</body>
</html>