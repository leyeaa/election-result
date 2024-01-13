<?php 
ob_start();
session_start();
if($_SESSION['allow']==""){
header("location:../stay_too_long.php");
exit;
}
include("../../include/database.php");
include("../../include/db_function.php");
if(isset($_GET['state_code'])){
$_SESSION['state_code']=$_GET['state_code'];
header("location:../../state_user/index.php");
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
	font-size: 12px;
}
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 13px;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
	color: #F00;
}
a:active {
	text-decoration: none;
}
#bb{
    border-radius:5px;
	width:98%;
    background-color: #f2f2f2;
    padding:3px;
	margin:auto;
	border: 2px solid green;
}
#n{
 border-radius: 5px;	
 border: 2px solid green;
}
</style>
</head>

<body>
<table width="100%">
  <tr>
    <td width="25%">&nbsp;</td>
    <td width="75%"><table width="35%" cellpadding="6" cellspacing="1" bgcolor="#006633" id="n">
      <tr bgcolor="#CCCCCC">
        <td width="18%" align="center">S/N</td>
        <td width="82%" align="center">STATE NAME</td>
      </tr>
      <?php 
       $sql= "SELECT * FROM state";
	  $result=$database->query($sql);
	  $i=1;
	  while($rows=$database->fetch_array($result)){
      echo"<tr>
        <td align='center' bgcolor='#FFFFFF'>$i</td>
        <td bgcolor='#FFFFFF'><a href='../../state_user/index.php?state_code={$rows['state_code']}'target='_parent'>{$rows['state_name']}</a></td>
      </tr>";
	  $i++;
	  }
	  //<td bgcolor='#FFFFFF'><a href='select_state.php?state_code={$rows['state_code']}'target='_parent'>{$rows['state_name']}</a></td>
      ?>
      
    </table></td>
  </tr>
</table>
</body>
</html>