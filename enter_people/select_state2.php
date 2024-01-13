<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body topmargin="0">
<table width="100%">
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="80%"><form id="form1" name="form1" method="post" action="print_polling_unit.php">
      <table width="50%" align="left" cellpadding="4" cellspacing="2">
        <tr>
          <td colspan="2" align="center" bgcolor="#FFFFFF">STATE LIST</td>
          </tr>
        <tr>
          <td width="42%" align="right" bgcolor="#B9FFE9">Select State:</td>
          <td width="58%" bgcolor="#B9FFE9"><label for="state2"></label>
            <select name="state2" id="state2">
              <option value="None">Select State---</option>
              
              <?php
			   include("../db/db.php");
			  $sql="SELECT * FROM state";
			  $result=mysql_query($sql) or die(mysql_error());
			  while($rows=mysql_fetch_array($result))
			   {
              echo"<option value='{$rows['state_code']}'>{$rows['state_name']}</option>";
               }
              ?>
              
            </select></td>
        </tr>
        <tr>
          <td bgcolor="#B9FFE9">&nbsp;</td>
          <td bgcolor="#B9FFE9"><input type="submit" name="State" id="State" value="Next" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>