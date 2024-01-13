<?php
include("../db/db.php");
if(isset($_POST['Submit'])){
$msg=$_POST['msg'];
$msg_id=$_POST['msg_id'];
//$mess_hide=$_POST['mess_hide'];
//////
$xc=explode("*",$msg);
$unit_code=$xc[1];
$sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit_code'";
	  $resulp=mysql_query($sqlp) or die(mysql_errors());
	  $rowp=mysql_fetch_array($resulp);
	  $unit_id=$rowp['unit_id'];


$sql2="DELETE FROM result WHERE unit_id='$unit_id'";	
mysql_query($sql2)or die(mysql_error());
//------------------------------------------------------------
$sql="UPDATE MessageIn SET MessageText='$msg',id='$msg_id'";
mysql_query($sql) or die("sender");
//===============================================================
header("location:all_messages.php");
exit;	
}
$id=$_GET['id']; 
$sqlchk="SELECT * FROM MessageIn WHERE id ='$id'";
$s=mysql_query($sqlchk) or die("can not");	
$rlt=mysql_fetch_array($s);
$sta=$rlt['status'];
$msg=$rlt['MessageText'];
$number=$rlt['MessageFrom'];
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
</style>
</head>

<body>
<table width="100%">
  <tr>
    <th width="14%" scope="col">&nbsp;</th>
    <th width="86%" align="left" scope="col"><form id="form1" name="form1" method="post" action="">
      <table width="76%" cellpadding="1" cellspacing="1">
        <tr>
          <th colspan="2" scope="col">&nbsp;</th>
          </tr>
        <tr>
          <td width="31%" align="right">Message Recieved:</td>
          <td width="69%"><label for="msg"></label>
            <input name="msg" type="text" id="msg" value="<?php echo $msg ?>" size="50" /></td>
        </tr>
        <tr>
          <td align="right"><input type="hidden" name="mess_hide" id="mess_hide"  value="<?php echo $msg ?>"/></td>
          <td><input type="submit" name="Submit" id="Submit" value="Save Change" />
            <input name="msg_id" type="hidden" id="msg_id" value="<?php echo $id ?>" /></td>
        </tr>
      </table>
    </form></th>
  </tr>
</table>
</body>
</html>