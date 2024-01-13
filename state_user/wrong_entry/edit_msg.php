<?php
ob_start();
session_start();
include("../../include/database.php");
include("../../include/db_function.php");

$state_code=$_SESSION['state_code'];
$state_name=state_name($state_code); 
if(isset($_POST['Submit'])){
$msg=$_POST['msg'];
$msg_id=$_POST['msg_id'];
$status='Yes';
//------------------------------------------------------------
$sql="UPDATE wrong_messagein SET MessageText='$msg',status='$status' WHERE Id='$msg_id'";
$database->query($sql) or die("sender");
//===============================================================
   
header("location:all_messages.php");
exit;	
}

$id=$_GET['id']; 
$sqlchk="SELECT * FROM wrong_messagein WHERE Id ='$id'";
$s=$database->query($sqlchk) or die("can not");	
$rlt=$database->fetch_array($s);
//$sta=$rlt['status'];
$msg=$rlt['MessageText'];
$number=$rlt['MessageFrom'];
//------------------------------------------------------------
function insert($id){
$sql="SELECT * FROM wrong_messagein WHERE Id='$id'"; // WHERE status=1";
$result=$database->query($sql) or die($database->error());
$rows=$database->fetch_array($result);	
$msg2=$rows['MessageText'];
$receiver=$rows['MessageFrom'];
$sender="Election";  
//$id=$rows['Id'];
$senttime=$rows['SendTime'];	
				  $sqlb2="INSERT INTO messagein SET MessageFrom='$receiver',MessageText='$msg2'";
	              $database->query($sqlb2) or die($database->error());	
}
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
</style>
</head>

<body>
<table width="100%" cellpadding="5">
  <tr>
    <th colspan="2" scope="col"><?php echo $state_name ?> STATE</th>
  </tr>
  <tr>
    <th width="11%" scope="col">&nbsp;</th>
    <th width="89%" align="left" scope="col"><form id="form1" name="form1" method="post" action="">
      <table width="76%" cellpadding="1" cellspacing="1">
        <tr>
          <th colspan="2" scope="col">&nbsp;</th>
          </tr>
        <tr>
          <td width="24%" align="right">Message Recieved:</td>
          <td width="76%"><label for="msg"></label>
            <input name="msg" type="text" id="msg" value="<?php echo $msg ?>" size="80" /></td>
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