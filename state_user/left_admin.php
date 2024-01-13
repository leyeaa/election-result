<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
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
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
	color: #900;
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
<table width="100%" cellpadding="8" cellspacing="1"   bgcolor="#666666" id="n">
  <tr>
    <th align="center" bgcolor="#2DFFFF" class="mobile_head" scope="col">STATE MENU</th>
  </tr>
  <tr>
    <th align="center" bgcolor="#F0FFFF" scope="col"><span ><a href="local_government/lg_menu.php" target="all_page">Add Local Government</a></span></th>
  </tr>
  <tr>
    <td align="center" bgcolor="#F0FFFF"><span ><a href="ward/select_lg.php" target="all_page">Add Ward</a></span></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F0FFFF"><span ><a href="polling_unit/select_lg.php" target="all_page">Add Polling Units / Result </a></span></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F0FFFF"><a href="polling_unit/print_polling_unit.php" target="all_page">Print Polling Unit</a></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F0FFFF"><a href="wrong_entry/all_messages.php" target="all_page">Validation</a></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#F0FFFF"><a href="overall/overall_result.php" target="all_page"> State Result Overall</a></td>
  </tr>
  
   <tr>
    <td align="center" bgcolor="#F0FFFF"><a href="overall_result/summary_result.php" target="_blank">Summary Result</a></td>
  </tr>
   <tr>
     <td align="center" bgcolor="#F0FFFF"><a href="whole_screen/result.php" target="_blank">Whole Result</a></td>
   </tr>
  <tr>
    <td align="center" bgcolor="#F0FFFF"><a href="../logout.php" target="_parent">LogOut</a></td>
  </tr>
  
  <?php 
  if($_SESSION['access_level']=='admin'){
	 echo"<tr>
    <td align='center' bgcolor='#2DFFFF'><a href='../admin/index.php' target='_parent'>Back to Admin</a></td>
  </tr>";
  }else{
	
    }
  
  ?>
  
 
  
  
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>