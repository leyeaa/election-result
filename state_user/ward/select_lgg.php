 <?php 
ob_start();
session_start();
if(isset($_SESSION['state_code'])){
$state_code=$_SESSION['state_code'];	
}

include("../../include/database.php");
include("../../include/db_function.php");

$state_name=state_name($state_code);

if(isset($_POST['LG'])){
$lg_code=$_POST['lg_code'];
$_SESSION['lg_code']=$lg_code;
header("location:ward_menu.php");
exit;
}


if(isset($_POST['Back'])){
header("location:../body.php");
exit;	
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
	font-size: 11px;
}
</style>
</head>

<body>
<table width="100%">
  <tr>
    <th width="12%" scope="col">&nbsp;</th>
    <th width="88%" align="left" valign="top" scope="col"><table width="73%" cellpadding="4" cellspacing="1" bgcolor="#999999">
      <tr>
        <th colspan="5" bgcolor="#CCCCCC" class="inputs" scope="col">List of Local Government</th>
      </tr>
      <tr>
        <th colspan="5" bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="select_lg.php">
          <table width="100%" cellpadding="4" cellspacing="1">
            <tr>
              <td align="right" bgcolor="#F3F3F3" class="inputs">State Name:</td>
              <td width="62%" align="left" bgcolor="#F3F3F3"><label for="textfield"></label>
                <input name="textfield" type="text" disabled="disabled" id="textfield"  value="<?php echo $state_name ?>" size="45"/></td>
            </tr>
            <tr>
              <td width="38%" align="right" bgcolor="#F3F3F3" class="inputs">Local Government:</td>
              <td align="left" bgcolor="#F3F3F3"><label for="ward_agent_phone"></label>
                <label for="lg_code"></label>
                <select name="lg_code" id="lg_code">
                  <option value="<?php echo @$lg_code ?>"><?php echo @$lg_name?></option>
                  <?php 
                  $sql= "SELECT * FROM lg WHERE state_code='$state_code'";
                  $result=$database->query($sql);	
                  while($rows=$database->fetch_array($result)){
                  echo"<option value='{$rows['lg_code']}'>{$rows['lg_name']}</option>";
				  }
                  ?>
                </select></td>
              </tr>
            <tr>
              <td align="right"><input type="submit" name="Back" id="Back" value="Back" /></td>
              <td align="left"><input type="submit" name="LG" id="LG" value="Next" /></td>
              </tr>
          </table>
        </form></th>
      </tr>
      
      
    </table></th>
  </tr>
</table>
</body>
</html>