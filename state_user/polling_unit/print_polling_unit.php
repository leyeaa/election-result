<?php
ob_start(); 
session_start();
if(isset($_POST['State'])){
$state2=$_POST['state2'];	
$_SESSION['state2']=$state2;
}
//--------------------------------------------------------------------------
$state=$_SESSION['state_code'];
include("../../include/database.php");
include("../../include/db_function.php");
//$state_name=state_name($state2);
$state_name=state_name($state);
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Polling Unit</title>
<script type="text/JavaScript">
var xmlhttp;

function showUser(str)
{
xmlhttp=GetXmlHttpObject();
//var officerID=document.getElementById("officerID").value;
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="unit_ajax.php";
url=url+"?q="+str;
//alert(url);
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
{
//alert(xmlhttp.responseText);
document.getElementById("cboLGA").innerHTML=xmlhttp.responseText;
}
  else{
	  document.getElementById("cboLGA").innerHTML="Processing...";
      }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

</script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}

input[type=text], select {
    padding: 4px 0px;
	 margin: 1px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit]:hover {
    background-color: #45a049;
}

input[type=text]:focus {
    border: 1px solid  #0C0;
	background-color: #FFC;
}


input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 6px 6px;
    margin: 0px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
</head>

<body topmargin="0">
<table width="100%">
  <tr>
    <th width="5%" scope="col">&nbsp;</th>
    <th width="95%" align="left" scope="col"><form id="form1" name="form1" method="post" action="auto_unit2.php" >
      <table width="87%" cellpadding="1" cellspacing="1">
        <tr>
          <th colspan="4" scope="col"><font size="+1" style="font-family:Tahoma, Geneva, sans-serif">To Print Polling Unit by State / Local Government</font></th>
          </tr>
        <tr>
          <td align="right">State Name:</td>
          <td colspan="3"><label for="textfield"></label>
            <input name="textfield" type="text" disabled="disabled" id="textfield" size="45"  value="<?php echo $state_name ?>"/></td>
        </tr>
        <tr>
          <td width="34%" align="right">Select Local Government:</td>
          <td colspan="3"><select name="lg_code" id="lg_code" onchange="return showUser(this.value,0)">
            <option value="0">Select Local Government</option>
            <?php 
                  //$sql= "SELECT * FROM lg WHERE state_code='$state2'";
				   $sql= "SELECT * FROM lg WHERE state_code='$state'";
                  $result=$database->query($sql) or die($database->error());	
                  while($rows=$database->fetch_array($result)){
                  echo"<option value='{$rows['lg_code']}'>{$rows['lg_name']}</option>";
				  }
                  ?>
            </select></td>
        </tr>
        <tr>
          <td align="right">Select Ward:</td>
          <td colspan="3"><div id="cboLGA">
            <select name="ward_code" id="ward_code">
              <option value="0">Select ward </option>
             
            </select>
          </div></td>
        </tr>
        <tr>
          <td align="right">Phone Number to use by agents:</td>
          <td colspan="3"><label for="phone"></label>
            <input name="phone" type="text" id="phone" size="40" /></td>
        </tr>
        <tr>
          <td align="right">Party Name:</td>
          <td colspan="3"><label for="party"></label>
            <select name="party" id="party">
              <option value=""></option>
              
              <?php 
                  //$sql= "SELECT * FROM lg WHERE state_code='$state2'";
				   $sqlp= "SELECT * FROM party";
                  $resultp=$database->query($sqlp);	
                  while($rowsp=$database->fetch_array($resultp)){
                  echo"<option value='{$rowsp['party_name']}'>{$rowsp['party_name']}</option>";
				  }
                  ?>
              
              
            </select></td>
        </tr>
        <tr>
          <td align="right">State ( for state election and others):</td>
          <td width="15%" align="left"><input name="check_state" type="radio" id="radio" value="sta" checked="checked" />
            <label for="check_state"></label>            <label for="check_state"></label></td>
          <td width="17%" align="right">Whole Nigeria:</td>
          <td width="34%"><input type="radio" name="check_state" id="radio2" value="ng" />
            <label for="check_state"></label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3"><input type="submit" name="Submit" id="Submit" value="Print Polling Unit" /></td>
        </tr>
      </table>
    </form></th>
  </tr>
</table>
</body>
</html>