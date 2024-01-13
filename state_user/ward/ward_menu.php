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
	
$lg_code=$_SESSION['lg_code'];



 
		  $sql2= "SELECT * FROM lg WHERE lg_code='$lg_code'";
          $result2=$database->query($sql2);	
          $rows2=$database->fetch_array($result2);
          $lg_name=$rows2['lg_name'];


$action="Add";
if(isset($_POST['Submit'])){
	if($_POST['Submit']=="Add"){
	$ward_name=addslashes(ucwords($_POST['ward_name']));
	//$ward_agent_name=ucwords($_POST['ward_agent_name']);
	$security_number=$_POST['security_number'];
	//----------------------
	  $ss="SELECT lg_code FROM ward WHERE lg_code ='$lg_code'";
	  $re=$database->query($ss);
	  $num = $database->num_rows($re)+1;
	  $ward_code=$lg_code . $num;
	       if(strlen($num) < 2){
			  $nu=0 .$num; 
	          $ward_code=$lg_code . $nu; 
		   }
	
	$sqly="INSERT INTO ward SET ward_name='$ward_name',lg_code='$lg_code',state_code='$state',ward_code='$ward_code',security_number='$security_number'";	
	$database->query($sqly);
	$ward_name="";
	$lg_code="";
	$security_number="";
	//...................................
	$id=$database->inserted_id();
   $ss="UPDATE ward SET ward_code2='$id' WHERE ward_id='$id'";
   $database->query($ss); 
	}
//============================================================================
	if($_POST['Submit']=="Save Change"){
	$ward_name=addslashes(ucwords($_POST['ward_name']));
	//$lg_id=$_POST['lg_id'];
	$ward_id=$_POST['ward_id'];
	//$ward_agent_name=ucwords($_POST['ward_agent_name']);
	$security_number=$_POST['security_number'];
	$sqly="UPDATE ward SET ward_name='$ward_name',security_number='$security_number' WHERE ward_id='$ward_id'";
	$database->query($sqly);	
	$ward_name="";
	$lg_code="";
	$security_number="";	
	$action="Add";
	}
}
//============================================================================
if(isset($_GET['ward_id_edit'])){
$ward_id=$_GET['ward_id_edit'];
$sql= "SELECT * FROM ward WHERE ward_id='$ward_id'";
$result=$database->query($sql);	
$rows=$database->fetch_array($result);
$ward_name=$rows['ward_name'];
$lg_code=$rows['lg_code'];
$security_number=$rows['security_number'];
//==================================
          $sql2= "SELECT * FROM lg WHERE lg_code='$lg_code'";
          $result2=$database->query($sql2);	
          $rows2=$database->fetch_array($result2);
          $lg_name=$rows2['lg_name'];
$action="Save Change";
}
//==============================================================================
if(isset($_GET['ward_id_delete'])){
	$ward_id=$_GET['ward_id_delete'];
$sqly="DELETE FROM ward WHERE ward_id ='$ward_id'";
$database->query($sqly);
}
//---------------------------------
if(isset($_POST['Back'])){
header("location:select_lg.php");
exit;	
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
}
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
}
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
</style>

<script language="javascript" type="text/javascript">
function validate(){

 var ward_name = document.getElementById('ward_name').value;
     if(ward_name==""){
	 alert("Please Enter ward name");
	 document.getElementById('ward_name').focus();
	 return false;
	 }
	 
 /*var pass_word = document.getElementById('pass_word').value;
     if(pass_word==""){
	 alert("Please Your Password");
	 document.getElementById('pass_word').focus();
	 return false;
	 }*/
}
</script>
</head>

<body topmargin="0">
<table width="100%">
  <tr>
    <th width="4%" scope="col">&nbsp;</th>
    <th width="96%" align="left" valign="top" scope="col"><table width="94%" cellpadding="5" cellspacing="1" bgcolor="#999999">
      <tr>
        <th colspan="5" bgcolor="#CCCCCC" class="inputs" scope="col">List of Ward</th>
      </tr>
      <tr>
        <th colspan="5" bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="ward_menu.php">
          <table width="100%" cellpadding="4" cellspacing="1">
            
            <tr>
              <td align="right" bgcolor="#F3F3F3" class="inputs">State Name:</td>
              <td colspan="2" align="left" bgcolor="#F3F3F3"><input name="textfield" type="text" disabled="disabled" id="textfield"  value="<?php echo @$state_name ?>" size="45"/></td>
              <td align="left" bgcolor="#F3F3F3">&nbsp;</td>
            </tr>
            <tr>
              <td width="17%" align="right" bgcolor="#F3F3F3" class="inputs">Ward Name:</td>
              <td width="36%" align="left" bgcolor="#F3F3F3"><label for="ward_name"></label>
                <input name="ward_name" type="text" id="ward_name" value="<?php echo @$ward_name ?>" size="40" /></td>
              <td width="22%" align="right" bgcolor="#F3F3F3" class="inputs">Security Number:</td>
              <td width="25%" align="left" bgcolor="#F3F3F3"><label for="security_number"></label>
                <input name="security_number" type="text" id="security_number" value="<?php echo @$security_number ?>" /></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#F3F3F3" class="inputs">Local Government:</td>
              <td align="left" bgcolor="#F3F3F3"><label for="ward_agent_phone"></label>
                <label for="lg_id"></label>
                <select name="lg_code" id="lg_code" disabled="disabled">
                  <option value="<?php echo @$lg_code ?>"><?php echo @$lg_name?></option>
                  <?php 
                  $sql= "SELECT * FROM lg";
                  $result=$database->query($sql);	
                  while($rows=$database->fetch_array($result)){
                  echo"<option value='{$rows['lg_code']}'>{$rows['lg_name']}</option>";
				  }
                  ?>
                  </select>
                <input name="ward_id" type="hidden" id="ward_id" value="<?php echo @$ward_id ?>" /></td>
              <td align="right" bgcolor="#F3F3F3" class="inputs">&nbsp;</td>
              <td align="left" bgcolor="#F3F3F3"><label for="textfield3"></label></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td colspan="2" align="center"><input type="submit" name="Back" id="Back" value="Back" />                <input type="submit" name="Submit" onclick=" return validate();" id="Submit" value="<?php echo $action ?>" /></td>
              <td align="left">&nbsp;</td>
            </tr>
          </table>
        </form></th>
      </tr>
      
      <tr class="inputs">
        <td width="7%" align="center" bgcolor="#CCCCCC">S/N</td>
        <td width="40%" align="center" bgcolor="#CCCCCC">Ward Name</td>
        <td width="37%" align="center" bgcolor="#CCCCCC">Security Number</td>
        <td colspan="2" align="center" bgcolor="#CCCCCC">&nbsp;</td>
      </tr>
      
      
      <?php 
	  
	
		  $sql2= "SELECT * FROM lg WHERE state_code='$state'";
          $result2=$database->query($sql2);	
		  $ii=1;
          while($rows2=$database->fetch_array($result2)){
          $lg_name2=$rows2['lg_name'];
		  $lg_code1=$rows2['lg_code']; 
	  
	  echo"<tr class='inputs'>
        <td align='center' bgcolor='#FFFFCC'></td>
        <th colspan='4' align='center' bgcolor='#FFFFCC'>$lg_name2</th>
        </tr>";
	  
      $sql= "SELECT * FROM ward WHERE lg_code='$lg_code1'";
	  $result=$database->query($sql);
	  $i=1;
	  while($rows=$database->fetch_array($result)){
		 
		 //====================================================================
     echo" <tr class='inputs'>
        <td align='center' bgcolor='#FFFFFF'>$i</td>
        <td align='left' bgcolor='#FFFFFF'><a href='add_ward.php?ward_code={$rows['ward_code']}&ward_name={$rows['ward_name']}'>{$rows['ward_name']}</a></td>
        <td align='left' bgcolor='#FFFFFF'>{$rows['security_number']}</td>
        <td width='8%' align='center' bgcolor='#FFFFFF'><a href='ward_menu.php?ward_id_edit={$rows['ward_id']}'>Edit</a></td>
        <td width='8%' align='center' bgcolor='#FFFFFF'><a href='ward_menu.php?ward_id_delete={$rows['ward_id']}'>Delete</a></td>
      </tr>";
	  $i++;
	  }
	  $ii++;
	  }
	  
	  
      ?>
    </table></th>
  </tr>
</table>
</body>
</html>