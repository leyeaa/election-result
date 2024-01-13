<?php 
ob_start();
session_start();
if($_SESSION['allow']==""){
header("location:../stay_too_long.php");
exit;
}
include("../../include/database.php");
include("../../include/db_function.php");

if(isset($_SESSION['state_code'])){
$state=$_SESSION['state_code'];	
}
$state_name=state_name($state);


if(isset($_POST['Submit'])){
$lg_code=$_POST['lg_code'];
$_SESSION['lg_code']=$lg_code;
header("location:ward_menu.php");
exit;
}
/*
if(isset($_POST['Submit'])){  
  $lg_code=$_POST['lg_code'];
  $ward_code=$_POST['ward_code'];
$_SESSION['lg_code']=$lg_code;
$_SESSION['ward_code']=$ward_code;
header("location:polling_unit_menu.php");
exit;
}*/
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
<title>::: ||| Polling Unit</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
}
</style>
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
<script language="javascript" type="text/javascript">
function validate(){

 var lg_code = document.getElementById('lg_code').value;
     if(lg_code==""){
	 alert("Please Select Logacal Government");
	 document.getElementById('lg_code').focus();
	 return false;
	 }
	 
 var ward_code = document.getElementById('ward_code').value;
     if(ward_code=="0"){
	 alert("Please Select Ward");
	 document.getElementById('ward_code').focus();
	 return false;
	 }
}
</script>
</head>

<body>
<table width="100%">
  <tr>
    <th width="5%" height="98" scope="col">&nbsp;</th>
    <th width="95%" align="left" valign="top" scope="col"><table width="84%" cellpadding="5" cellspacing="1" bgcolor="#999999">
      <tr>
        <th colspan="7" bgcolor="#CCCCCC" class="inputs" scope="col">Local Government and Ward </th>
      </tr>
      <tr>
        <th colspan="7" bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="select_lg.php">
          <table width="100%" align="left" cellpadding="4" cellspacing="1">
            <tr>
              <td align="right" class="inputs">State Name:</td>
              <td align="left" bgcolor="#999999"><label for="textfield"></label>
                <input name="textfield" type="text" disabled="disabled" id="textfield"  value="<?php echo $state_name ?>" size="45"/></td>
            </tr>
            <tr>
              <td width="27%" align="right" class="inputs">Local Government Area:</td>
              <td width="73%" align="left" bgcolor="#999999"><label for="agent_name"></label>
                <label for="senetorial"></label>
                <select name="lg_code" id="lg_code" onChange="return showUser(this.value,0)">
                  <option value="<?php echo @$lg_code ?>"><?php echo @$lg_name?></option>
                  <?php 
                  $sql= "SELECT * FROM lg WHERE state_code='$state'";
                  $result=$database->query($sql);	
                  while($rows=$database->fetch_array($result)){
                  echo"<option value='{$rows['lg_code']}'>{$rows['lg_name']}</option>";
				  }
                  ?>
                  </select></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#999999" class="inputs"><input type="submit" name="Back" id="Back" value="Back" /></td>
              <td align="left" bgcolor="#999999"><label for="textfield4">
                <input type="submit" name="Submit" id="Submit" value="Next" onclick=" return validate();" />
                </label></td>
            </tr>
          </table>
        </form></th>
      </tr>
      
      <tr class="inputs">
        
      </tr>
     
    </table></th>
  </tr>
</table>
</body>
</html>