<?php 
ob_start();
include("../../include/database.php");
include("../../include/db_function.php");

$action="Add";

if(isset($_POST['Submit'])){

  if($_POST['Submit']=="Add"){
  $party_name=addslashes(strtoupper($_POST['party_name']));
  //$party_sign=strtoupper($_POST['party_sign']);
  $sql="INSERT INTO party SET party_name='$party_name'";
  $database->query($sql) or die($database->error());
  //$party_sign="";	
 $sql2="ALTER TABLE `result` ADD `$party_name` VARCHAR(9) NULL DEFAULT NULL AFTER `agent_phone`";
  $database->query($sql2) or die($database->error());
  //$party_name="";
  header('location:party_menu.php');
  exit;
  }
//============================================================================
	if($_POST['Submit']=="Save"){
	$party_name=addslashes(strtoupper($_POST['party_name']));
	$party_name2=addslashes(strtoupper($_POST['party_name2'])); //hide field
	$party_id=$_POST['party_id'];
	$sql="UPDATE party SET party_name='$party_name' WHERE party_id='$party_id'";
	$database->query($sql) or die($database->error());
	$sl="ALTER TABLE `result` CHANGE `$party_name2` `$party_name` VARCHAR(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
	$database->query($sl) or die($database->error()); 
	header('location:party_menu.php');	
	$action="Add";
	}
}
//====================================== Edit and Delete secsion ======================================
if(isset($_GET['party_id_edit'])){
$party_id=$_GET['party_id_edit'];
$sql= "SELECT * FROM party WHERE party_id='$party_id'";
$resultt=$database->query($sql) or die($database->error());
$rows=$database->fetch_array($resultt);
$party_name=$rows['party_name'];
//$party_sign=$rows['party_sign'];
$action="Save";
}
//==============================================================================
if(isset($_GET['party_id_delete'])){
	$party_id=$_GET['party_id_delete'];
	
$sql= "SELECT * FROM party WHERE party_id='$party_id'";
$resultt=$database->query($sql) or die($database->error());
$rows=$database->fetch_array($resultt);
$party_name=$rows['party_name'];	

	
	
$sql="DELETE FROM party WHERE party_id='$party_id'";	
$database->query($sql) or die($database->error());
$sql1="ALTER TABLE `result` DROP `$party_name`";
$database->query($sql1) or die($database->error());
header('location:party_menu.php');
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a {
	font-family: Tahoma, Geneva, sans-serif;
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
<table width="100%">
  <tr>
    <th width="8%" scope="col">&nbsp;</th>
    <th width="92%" align="left" valign="top" scope="col"><table width="71%" cellpadding="6" cellspacing="1" bgcolor="#999999">
      <tr>
        <th colspan="5" bgcolor="#CCCCCC" class="inputs" scope="col">List of to consider</th>
      </tr>
      <tr>
        <th colspan="5" bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="party_menu.php">
          <table width="100%" cellpadding="6" cellspacing="1">
            <tr>
              <th width="46%" scope="col">&nbsp;</th>
              <th width="54%" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <td align="right" class="inputs">Party  Name:</td>
              <td align="left"><label for="party_name"></label>
                <input name="party_name" type="text" id="party_name" size="30" value="<?php echo @$party_name ?>" />
                <input name="party_id" type="hidden" id="party_id" value="<?php echo @$party_id ?>" />
                <input name="party_name2" type="hidden" id="party_name2" value="<?php echo @$party_name ?>" /></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" id="Submit" value="<?php echo $action ?>" /></td>
            </tr>
          </table>
        </form></th>
      </tr>
      <tr>
        <th colspan="5" bgcolor="#FFFFFF" scope="col">&nbsp;</th>
      </tr>
      <tr class="inputs">
        <td width="7%" align="center" bgcolor="#CCCCCC">S/N</td>
        <td width="35%" align="center" bgcolor="#CCCCCC">Party Name</td>
        <td width="34%" align="center" bgcolor="#CCCCCC">Party Sing / Rep</td>
        <td colspan="2" align="center" bgcolor="#CCCCCC">&nbsp;</td>
      </tr>
      <?php 
      $sql= "SELECT * FROM party";
	  $result=$database->query($sql) or die($database->error());
	  $i=1;
	  while($rows=$database->fetch_array($result)){
      echo"<tr class='inputs'>
        <td align='center' bgcolor='#FFFFFF'>$i</td>
        <td align='left' bgcolor='#FFFFFF'>{$rows['party_name']}</td>
        <td align='center' bgcolor='#FFFFFF'></td>
        <td width='11%' align='center' bgcolor='#FFFFFF'><a href='party_menu.php?party_id_edit={$rows['party_id']}'>Edit</a></td>
        <td width='13%' align='center' bgcolor='#FFFFFF'><a href='party_menu.php?party_id_delete={$rows['party_id']}'>Delete</a></td>
      </tr>";
	  $i++;
	  }
      ?>
    </table></th>
  </tr>
</table>
</body>
</html>