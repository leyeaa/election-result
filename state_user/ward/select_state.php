<?php 
/*
$string = "This is some text and numbers 12345 and symbols !£$%^&";
$new_string = ereg_replace("[^A-Za-z]", "", $string);
echo $new_string;*/

?>

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

<body>
<table width="100%">
  <tr>
    <td width="18%">&nbsp;</td>
    <td width="82%"><form id="form1" name="form1" method="post" action="select_lg.php">
      <table width="50%" align="left" cellpadding="4" cellspacing="2">
        <tr>
          <td width="38%" align="right" bgcolor="#E3E3E3">Select State:</td>
          <td width="62%" bgcolor="#E3E3E3"><label for="state"></label>
            <select name="state" id="state">
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
          <td bgcolor="#E3E3E3">&nbsp;</td>
          <td bgcolor="#E3E3E3"><input type="submit" name="State" id="State" value="Next" /></td>
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