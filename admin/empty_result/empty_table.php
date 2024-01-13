<?php 
ob_start();
include("../../include/database.php");
include("../../include/db_function.php");
//==============================================================================
if(isset($_POST['Submit'])){
	//$lg_id=$_GET['lg_id_delete'];
$sql="TRUNCATE TABLE result";	
$database->query($sql)or die($database->error());
//________________________________ delete from mysql table_________________________

$message="Thank you the Table is Empty for now";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../csc/csc_sheet.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
function validate(){

 var lg_name = document.getElementById('lg_name_name').value;
     if(lg_name==""){
	 alert("Please Enter Local Government Name");
	 document.getElementById('lg_name').focus();
	 return false;
	 }
	 
 var senetorial = document.getElementById('senetorial').value;
     if(senetorial==""){
	 alert("Please Select Senetorial");
	 document.getElementById('senetorial').focus();
	 return false;
	 }
}
</script>	 
</head>

<body>
<table width="60%" align="center" cellpadding="5" cellspacing="6">
  <tr>
    <th scope="col">Note That this Empty can only be Implemented once, Click before Election Started.</th>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="empty_table.php">
      <input type="submit" name="Submit" id="Submit" value="Click To Empty Result Table" />
    </form></td>
  </tr>
</table>
<p>&nbsp; </p>
<table width="100%">
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td align="center"><?php if(isset($message)) echo $message  ?>&nbsp;</td>
  </tr>
</table>
</body>
</html>