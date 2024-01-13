<?php 
session_start();
include("../db/db.php");

/*if(isset($_GET['ward_code'])){
	
$ward_code=$_GET['ward_code'];
$unit_name=$_GET['unit_name'];

$_SESSION['ward_code']=$ward_code;
$_SESSION['unit_name']=$unit_name;
}*/

if(isset($_POST['Submit'])){
$AV=$_POST['AV'];
$APC=$_POST['APC'];
$LP=$_POST['LP'];
$PDP=$_POST['PDP'];
$SDP=$_POST['SDP'];	
$ward_code=$_POST['ward_code'];
$ward_name=addslashes($_POST['ward_name']);
$state_code=substr($ward_code,0,2);
$lg_code=substr($ward_code,0,4);
$ward_code=substr($ward_code,0,6);
   //..
     $sql2="SELECT * FROM ward_result WHERE ward_code='$ward_code'";
     $result2=mysql_query($sql2) or die(mysql_error());
	 $num_rows=mysql_num_rows($result2);
	    if($num_rows != 0){
			
	$sql="UPDATE ward_result SET AV='$AV',APC='$APC',LP='$LP',PDP='$PDP',SDP='$SDP',ward_code='$ward_code',state_code='$state_code',lg_code='$lg_code' WHERE ward_code='$ward_code'";
mysql_query($sql) or die(mysql_error());
      header("location:ward_menu.php");	
		}
		else
		{
	$sql="INSERT INTO ward_result SET AV='$AV',APC='$APC',LP='$LP',PDP='$PDP',SDP='$SDP',ward_code='$ward_code',state_code='$state_code',lg_code='$lg_code',ward_name='$ward_name'";
mysql_query($sql) or die(mysql_error());
header("location:ward_menu.php");		
		}
	 
}

$ward_code=$_GET['ward_code'];
$ward_name=$_GET['ward_name'];

$sql1="SELECT * FROM ward_result WHERE ward_code='$ward_code'";
$result1=mysql_query($sql1) or die(mysql_error());
$rows1=mysql_fetch_array($result1);
$AV=$rows1["AV"];
$APC=$rows1["APC"];
$LP=$rows1["LP"];
$PDP=$rows1["PDP"];
$SDP=$rows1["SDP"];
/*$unit_name=$rows1["unit_name"];
$ward_code=$rows1["ward_code"];*/
//--------------------------------------------------------
if(isset($_POST['Back'])){	
header("location:ward_menu.php");
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
    <td><form id="form1" name="form1" method="post" action="add_ward.php">
      <table width="50%" align="center">
        <tr>
          <td colspan="2" align="center"><?php echo $ward_name ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="26%" align="right" bgcolor="#E3E3E3">AV</td>
          <td width="74%" bgcolor="#E3E3E3"><label for="AV"></label>
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
            <input name="ward_code" type="hidden" id="ward_code" value="<?php echo @$ward_code ?>" />
            <input name="ward_name" type="hidden" id="ward_name" value="<?php echo @$ward_name ?>" /></td>
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