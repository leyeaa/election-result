<?php 
ob_start();
session_start();
if($_SESSION['allow']==""){
header("location:../stay_too_long.php");
exit;
}
include("../../include/database.php");
include("../../include/db_function.php");


/*if(isset($_POST['State'])){
$state=$_POST['state'];	
$_SESSION['state']=$state;	
}*/
//-------------------------------------
if(isset($_SESSION['state_code'])){
$state=$_SESSION['state_code'];	
}
$state_name=state_name($state);
/////////////////////////////////////////////////////////////
if(isset($_POST['Back'])){
header("location:select_state.php");
exit;	
}

$action="Add";
if(isset($_POST['Submit'])){
	if($_POST['Submit']=="Add"){
	$lg_name=addslashes(ucwords($_POST['lg_name']));
	$security_number=$_POST['security_number'];
	        
	//________________________________ insert into table $database->____________________
	$ss="SELECT state_code FROM lg WHERE state_code ='$state'";
	$re=$database->query($ss);
	$num = $database->num_rows($re)+1;
	$lg_code=$state . $num;
	       if(strlen($num) < 2){
			  $nu=0 .$num; 
	          $lg_code=$state . $nu; 
		   }
	       	
	$sqly="INSERT INTO lg SET lg_name='$lg_name',state_code='$state',lg_code='$lg_code',security_number='$security_number'";	
	$database->query($sqly);
	
	//ooooooooooooooooooooooooo
	$id=$database->inserted_id();
   $ss="UPDATE lg SET lg_code2='$id' WHERE lg_id='$id'";
   $database->query($ss); 
	$lg_name="";
	$senetorial="";	
	$security_number="";
	}
//============================================================================
	if($_POST['Submit']=="Save Change"){
	$lg_name=ucwords($_POST['lg_name']);
	$security_number=$_POST['security_number'];
	$lg_id=$_POST['lg_id'];
	//_________________________ update table $database->___________________
	$sqly="UPDATE lg SET lg_name='$lg_name',security_number='$security_number' WHERE lg_id='$lg_id'";	
	$database->query($sqly);
	$lg_name="";
	$senetorial="";	
	$security_number="";
	$action="Add";
	}
}
//============================================================================
if(isset($_GET['lg_id_edit'])){
$lg_id=$_GET['lg_id_edit'];
$sql= "SELECT * FROM lg WHERE lg_id='$lg_id'";
$result=$database->query($sql);	
$rows=$database->fetch_array($result);
$lg_name=$rows['lg_name'];
$security_number=$rows["security_number"];
$action="Save Change";
}
//==============================================================================
if(isset($_GET['lg_id_delete'])){
	$lg_id=$_GET['lg_id_delete'];
$sqly="DELETE FROM lg WHERE lg_id='$lg_id'";	
$database->query($sqly);
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
function validate(){

 var lg_name = document.getElementById('lg_name_name').value;
     if(lg_name==""){
	 alert("Please Enter Local Government Name");
	 document.getElementById('lg_name').focus();
	 return false;
	 }
	 
 var senetorial = document.getElementById('senetorial').value;
     if(senetorial==""){
	 alert("Please Select Senetorial");
	 document.getElementById('senetorial').focus();
	 return false;
	 }
}
</script>	 
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
}
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 11px;
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
</head>

<body topmargin="0">
<table width="100%" cellpadding="0">
  <tr>
    <th width="6%" scope="col">&nbsp;</th>
    <th width="94%" align="left" valign="top" scope="col"><table width="82%" cellpadding="5" cellspacing="1" bgcolor="#999999">
      <tr>
        <th colspan="6" bgcolor="#CCCCCC" class="inputs" scope="col">Local Government Area</th>
      </tr>
      <tr>
        <th colspan="6" bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="lg_menu.php">
          <table width="100%" cellpadding="3" cellspacing="1">
            <tr>
              <td align="right" bgcolor="#F7F7F7" class="inputs">State Name :</td>
              <td align="left" bgcolor="#F7F7F7"><label for="textfield"></label>
                <input name="textfield" type="text" disabled="disabled" id="textfield" size="40" value="<?php echo $state_name ?>" /></td>
            </tr>
            <tr>
              <td width="46%" align="right" bgcolor="#F7F7F7" class="inputs">Local Government Name :</td>
              <td width="54%" align="left" bgcolor="#F7F7F7"><label for="lg_name"></label>
                <input name="lg_name" type="text" id="lg_name" value="<?php echo @$lg_name ?>" size="35" />
                <input name="lg_id" type="hidden" id="lg_id" value="<?php echo @$lg_id ?>" /></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#F7F7F7" class="inputs">Security Number:</td>
              <td align="left" bgcolor="#F7F7F7"><label>
                <input name="security_number" type="text" id="security_number" value="<?php echo @$security_number ?>" size="35" />
              </label></td>
            </tr>
            <tr>
              <td align="right"><input type="submit" name="Back" id="Back" value="Back" /></td>
              <td align="left"><input type="submit" name="Submit" id="Submit"  onclick="return validate();"  value="<?php echo $action ?>" /></td>
            </tr>
          </table>
        </form></th>
      </tr>
      
      <tr>
        <td width="4%" align="center" bgcolor="#CCCCCC" class="inputs">S/N</td>
        <td width="22%" align="center" bgcolor="#CCCCCC" class="inputs">Local Government Name</td>
       
        <td width="22%" align="center" bgcolor="#CCCCCC" class="inputs">Security Number</td>
        <td colspan="2" align="center" bgcolor="#CCCCCC">&nbsp;</td>
      </tr>
      
      <?php 
      $sql= "SELECT * FROM lg WHERE state_code='$state'";
	  $result=$database->query($sql);
	  $i=1;
	  while($rows=$database->fetch_array($result)){
	  
      echo"<tr class='inputs'>
        <td align='center' bgcolor='#FFFFFF'>$i</td>
        <td align='left' bgcolor='#FFFFFF'>{$rows['lg_name']}</td>
        <td align='left' bgcolor='#FFFFFF'>{$rows['security_number']}  </td>
        
        <td width='8%' align='center' bgcolor='#FFFFFF'><a href='lg_menu.php?lg_id_edit={$rows['lg_id']}'>Edit</a></td>
        <td width='8%' align='center' bgcolor='#FFFFFF'><a href='lg_menu.php?lg_id_delete={$rows['lg_id']}''>Delete</a></td>
      </tr>";
	  $i++;
	  }
      ?>
      
  </table></th>
  </tr>
</table>
</body>
</html>