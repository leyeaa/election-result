<?php
error_reporting(0); 
ob_start();
include("../include/database.php");
include("../include/db_function.php");

$sql="SELECT * FROM result";
$result=$database->query($sql) or die($database->error());
while($rows=$database->fetch_array($result)){
	$unit_code=$rows["unit_code"];
	$lg_code=$rows["lg_code"];
	$ward_code=$rows["ward_code"];
	$state_code=$rows["state_code"];
	//$unit_name=addslashes($rows["unit_name"]);
	$APC=$rows["APC"];
	$AA=$rows["AA"];
	$PDP=$rows["PDP"];
	$AAC=$rows["AAC"];
	$ZLP=$rows["ZLP"];
	$ADC=$rows['ADC'];
	$a = "http://www.elema.org/president_election/presidential_api.php?unit_code=$unit_code&ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code&APC=$APC&AA=$AA&PDP=$PDP&AAC=$AAC&ZLP=$ZLP&ADC=$ADC";
	//$a = "http://www.elema.org/house_rep/rep_api.php?unit_code=$unit_code&ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code&APC=$APC&AA=$AA&PDP=$PDP&AAC=$AAC&ZLP=$ZLP&ADC=$ADC";
	//$a = "http://www.elema.org/senate/senate_api.php?unit_code=$unit_code&ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code&APC=$APC&AA=$AA&PDP=$PDP&AAC=$AAC&ZLP=$ZLP&ADC=$ADC";
	//echo $a.'<br />';
	
	echo '<iframe src="'.$a.'"  height="0" width="0"></iframe>';
}
ob_end_flush();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="3">
<title>::: UPLOAD DATA :::</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 24px;
	color: #F00;
}
</style>
</head>

<body>
<iframe src="<?php //echo $a; ?>"  height="0" width="0"></iframe>
<p>&nbsp;</p>
<table width="100%" cellpadding="5" cellspacing="1">
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">DO NOT CLOSE THIS PAGE THIS </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">THIS UPLOAD TO ONLINE</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
