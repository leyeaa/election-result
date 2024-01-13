<?php 
session_start();
include("../../include/database.php");
include("../../include/db_function.php");
//$state_code=$_SESSION['state_code'];
//$state_name=state_name($state_code); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: RESULT :::</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
}
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
}
#bb{
    border-radius:5px;
	width:98%;
    background-color: #f2f2f2;
    padding:3px;
	margin:auto;
	border: 2px solid green;
	height:auto;
}
#n{
 border-radius: 5px;	
 border: 2px solid green;
}
</style>
</head>

<body topmargin="0" rightmargin="0" leftmargin="0" bottommargin="0">
<div id="bb">
<table width="100%">
  <tr height="1000">
    <td width="67%"  valign="top"><iframe id="g" align="" frameborder="0" marginheight="" scrolling="no" marginwidth="" src="all_state.php" width="100%" height="1000"></iframe>&nbsp;</td>
    <td width="33%"  valign="top" bgcolor="#FFFFFF"><p><iframe align="center"  id="w" width="100%"  frameborder="0" src="overall_result_state.php" scrolling="no" height="1000"></iframe></p></td>
  </tr>
</table>
</div>
</body>
</html>