<?php 
session_start();
include("../db/db.php");

/*if(isset($_GET['unit_code'])){
	
$unit_code=$_GET['unit_code'];
$unit_name=$_GET['unit_name'];

$_SESSION['unit_code']=$unit_code;
$_SESSION['unit_name']=$unit_name;
}*/

if(isset($_POST['Submit'])){
$AV=$_POST['AV'];
$APC=$_POST['APC'];
$LP=$_POST['LP'];
$PDP=$_POST['PDP'];
$SDP=$_POST['SDP'];	
$unit_code=$_POST['unit_code'];
$unit_name=addslashes($_POST['unit_name']);
$state_code=substr($unit_code,0,2);
$lg_code=substr($unit_code,0,4);
$ward_code=substr($unit_code,0,6);
   //..
     $sql2="SELECT * FROM result WHERE unit_code='$unit_code'";
     $result2=mysql_query($sql2) or die(mysql_error());
	 $num_rows=mysql_num_rows($result2);
	    if($num_rows != 0){
			
	$sql="UPDATE result SET AV='$AV',APC='$APC',LP='$LP',PDP='$PDP',SDP='$SDP',unit_name='$unit_name',ward_code='$ward_code',state_code='$state_code',lg_code='$lg_code' WHERE unit_code='$unit_code'";
mysql_query($sql) or die(mysql_error());
      header("location:polling_unit_menu.php");	
		}
		else
		{
	$sql="INSERT INTO result SET AV='$AV',APC='$APC',LP='$LP',PDP='$PDP',SDP='$SDP',unit_code='$unit_code',unit_name='$unit_name',ward_code='$ward_code',state_code='$state_code',lg_code='$lg_code'";
mysql_query($sql) or die(mysql_error());
header("location:polling_unit_menu.php");		
		}
	 
}

$unit_code=$_GET['unit_code'];
$unit_name=$_GET['unit_name'];

$sql1="SELECT * FROM result WHERE unit_code='$unit_code'";
$result1=mysql_query($sql1) or die(mysql_error());
$rows1=mysql_fetch_array($result1);
$AV=$rows1["AV"];
$APC=$rows1["APC"];
$LP=$rows1["LP"];
$PDP=$rows1["PDP"];
$SDP=$rows1["SDP"];
/*$unit_name=$rows1["unit_name"];
$unit_code=$rows1["unit_code"];*/
//--------------------------------------------------------
if(isset($_POST['Back'])){	
header("location:polling_unit_menu.php");
exit;	
}

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
	font-weight: bold;
}
</style>
</head>

<body>
<table width="100%">
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="50%" align="center">
        <tr>
          <td width="26%">&nbsp;</td>
          <td width="74%">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E3E3E3">AV</td>
          <td bgcolor="#E3E3E3"><label for="AV"></label>
            <input type="text" name="AV" id="AV"  value="<?php echo @$AV ?>"/></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E3E3E3">APC</td>
          <td bgcolor="#E3E3E3"><input name="APC" type="text" id="APC" value="<?php echo @$APC ?>" /></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E3E3E3">LP</td>
          <td bgcolor="#E3E3E3"><input name="LP" type="text" id="LP" value="<?php echo @$LP ?>" /></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E3E3E3">PDP</td>
          <td bgcolor="#E3E3E3"><input name="PDP" type="text" id="PDP" value="<?php echo @$PDP ?>" /></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E3E3E3">SDP</td>
          <td bgcolor="#E3E3E3"><input name="SDP" type="text" id="SDP" value="<?php echo @$SDP ?>" /></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#E3E3E3"><input type="submit" name="Back" id="Back" value="Back" /></td>
          <td bgcolor="#E3E3E3"><input type="submit" name="Submit" id="Submit" value="ADD" />
            <input name="unit_code" type="hidden" id="unit_code" value="<?php echo @$unit_code ?>" />
            <input name="unit_name" type="hidden" id="unit_name" value="<?php echo @$unit_name ?>" /></td>
        </tr>
        <tr>
          <td bgcolor="#E3E3E3">&nbsp;</td>
          <td bgcolor="#E3E3E3">&nbsp;</td>
        </tr>
      </table>
    </form></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>