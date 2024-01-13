<?php 
ob_start();
session_start();
if($_SESSION['allow']==""){
header("location:../stay_too_long.php");
exit;
}
//-----------------
function pre($length) {
		$salt = "0000000000000";
		$len = strlen($salt);
		$makepass="";
		mt_srand(10000000*(double)microtime());
		for ($i = 0; $i < $length; $i++)
		$makepass .= $salt[mt_rand(0,$len - 1)];
		return $makepass;
	    }
	
function pr_no($form_number){
$len=strlen($form_number);
$remi=(4-$len);
$number= pre($remi);
return $number . $form_number;
}	
//------------------------------------------------------------
include("../../include/database.php");
include("../../include/db_function.php");

$state=$_SESSION['state_code'];
$ward_code=$_SESSION['ward_code'];	
$lg_code=$_SESSION['lg_code'];


     $sql3= "SELECT * FROM lg WHERE lg_code='$lg_code'";
     $result3=$database->query($sql3);	
     $rows3=$database->fetch_array($result3);
     $lg_name=$rows3['lg_name'];
	 //----------------------------------------------------------------
	  $sql4="SELECT * FROM ward WHERE ward_code='$ward_code'";
          $result4=$database->query($sql4) or die($database->error());	
          $rows4=$database->fetch_array($result4);
          $ward_name=$rows4['ward_name'];
//select ident_current('table_name');
$state_name=state_name($state);

$action="Add";

if(isset($_POST['Submit'])){

  if($_POST['Submit']=="Add"){
  $unit_name=addslashes(ucwords($_POST['unit_name']));
  $agent_name=addslashes(ucwords($_POST['agent_name']));
  $agent_phone=addslashes($_POST['agent_phone']);
  $no_register_voters=$_POST['no_register_voters'];
  if($no_register_voters==''){
  $no_register_voters=0;  
  }else{  
  }
  //-----------
  $ss="SELECT ward_code FROM polling_unit WHERE ward_code ='$ward_code'";
	$re=$database->query($ss);
	$num = $database->num_rows($re)+1;
	$unit_code=$ward_code . $num;
	       if(strlen($num) < 2){
			  $nu=0 .$num; 
	          $unit_code=$ward_code . $nu; 
		   }
		   
  //................................
   $gg="SELECT state_code FROM polling_unit WHERE state_code='$state'";
   $gr=$database->query($gg);
   $num_state=$database->num_rows($gr);
    if($num_state < 1){
	 $num_state2=$num_state + 1;	
	}
	else{
	  $num_state2=$num_state + 1;	
	}
	
	 $new_num_state2=pr_no($num_state2);
	 
	/* 
	 echo"$new_num_state2";
	 exit;*/
	//----------------- if phone is empty
		$pre_no="+234";
	    $agent_b = substr($agent_phone,1,10);
	    $new_agent_phone = $pre_no . $agent_b;
		 $sqly="INSERT INTO polling_unit SET unit_name ='$unit_name',unit_code='$unit_code',lg_code='$lg_code',ward_code='$ward_code',state_code='$state',agent_name='$agent_name',agent_phone='$new_agent_phone',state_unit_code='$new_num_state2',no_register_voters='$no_register_voters'";
   $database->query($sqly); 
   //------------------------------------------
   $id=$database->inserted_id();
  $ss="UPDATE polling_unit SET unit_code2='$id' WHERE unit_id='$id'";
   $database->query($ss); 
   	
  $unit_name="";
  $lg_code="";
  $ward_code="";
  $agent_name="";
  $agent_phone="";
  $no_register_voters="";	      
 } 		   
  
//============================================================================
	if($_POST['Submit']=="Save"){
	$unit_name=addslashes(ucwords($_POST['unit_name']));
    //$lg_id=$_POST['lg_id'];
    //$ward_id=$_POST['ward_id'];
    $agent_name=ucwords($_POST['agent_name']);
    $agent_phone=$_POST['agent_phone'];
    $unit_id=$_POST['unit_id'];
	$no_register_voters=$_POST['no_register_voters'];
	   $pre_no="+234";
	   $agent_b = substr($agent_phone,1,10);
	   $new_agent_phone = $pre_no . $agent_b;
	  //__________________________________________ update mysql table ___________________________________
	   $sqly="UPDATE polling_unit SET unit_name ='$unit_name',agent_name='$agent_name',agent_phone='$new_agent_phone',no_register_voters='$no_register_voters' WHERE unit_id='$unit_id'";
       $database->query($sqly); 	
	   $unit_name="";
       $lg_code="";
       $ward_code="";
       $agent_name="";
       $agent_phone="";	
	   $no_register_voters=="";
	   $action="Add";
	   $message="Save Thank you";
	 }
	
	 
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
 if(isset($_POST['Edit_phone'])){
	 
	 
 }
	
}
//====================================== Edit and Delete secsion ======================================
if(isset($_GET['unit_id_edit'])){
$unit_id=$_GET['unit_id_edit'];
$sql= "SELECT * FROM polling_unit WHERE unit_id='$unit_id'";
$result=$database->query($sql);	
$rows=$database->fetch_array($result);
$unit_name=$rows['unit_name'];
$agent_name=$rows['agent_name'];
$no_register_voters=$rows['no_register_voters'];
$agent_phone1=$rows['agent_phone'];
if($agent_phone1=="+234")
{
$agent_phone="";
}
else
{ 
       $pre_no="0";
  	   $agent_b = substr($agent_phone1,4,10);
	   $agent_phone = $pre_no . $agent_b;   
}
$action="Save";		


}
//==============================================================================
if(isset($_GET['unit_id_delete'])){
	$unit_id=$_GET['unit_id_delete'];
//_______________________ Delete mysql table _____________________________________________
$sqly="DELETE FROM polling_unit WHERE unit_id='$unit_id'";
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
<title>::: ||| Polling Unit</title>
<link href="../csc/csc_sheet.css" rel="stylesheet" type="text/css" />
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

 var unit_name = document.getElementById('unit_name').value;
     if(unit_name==""){
	 alert("Please Enter Unit Name");
	 document.getElementById('unit_name').focus();
	 return false;
	 }
	 
 /*var ward_code = document.getElementById('ward_code').value;
     if(ward_code=="0"){
	 alert("Please Select Ward");
	 document.getElementById('ward_code').focus();
	 return false;
	 }*/
}
</script>
<style type="text/css">
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #03C;
}
a:hover {
	text-decoration: underline;
	color: #F00;
}
a:active {
	text-decoration: none;
}
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
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

<body topmargin="0">
<table width="100%">
  <tr>
    <th width="2%" scope="col">&nbsp;</th>
    <th width="98%" align="left" valign="top" scope="col"><table width="99%" cellpadding="5" cellspacing="1" bgcolor="#999999" id="n">
      <tr>
        <th colspan="7" bgcolor="#CCCCCC" class="inputs" scope="col"> Polling Unit</th>
      </tr>
      <tr>
        <th colspan="7" bgcolor="#FFFFFF" scope="col"><form id="form1" name="form1" method="post" action="polling_unit_menu.php">
          <table width="100%" cellpadding="1" cellspacing="1" id="n">
            
            <tr>
              <td colspan="4" align="center" class="inputs"><?php  if(isset($message)) echo $message ?></td>
              </tr>
            <tr>
              <td width="18%" align="right" class="inputs">State Name</td>
              <td colspan="2" align="left"><label for="textfield"></label>
                <input name="textfield" type="text" disabled="disabled" id="textfield" value="<?php echo@$state_name ?>" size="45" /></td>
              <td width="28%" align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="inputs">Polling Unit Name:</td>
              <td width="31%" align="left"><label for="unit_name"></label>
                <input name="unit_name" type="text" id="unit_name" value="<?php echo @$unit_name ?>" size="30" /></td>
              <td width="23%" align="right"><span class="inputs">Person incharge:</span></td>
              <td align="left"><input name="agent_name" type="text" id="textfield4" value="<?php echo @$agent_name ?>" /></td>
            </tr>
            <tr>
              <td align="right" class="inputs">Local Government Area:</td>
              <td align="left"><label for="agent_name"></label>
                <label for="senetorial"></label>
                <select name="lg_code" id="lg_code" onChange="return showUser(this.value,0)" disabled="disabled">
                  <option value="<?php echo $lg_code ?>"><?php echo @$lg_name?></option>
                  <?php 
                  $sql= "SELECT * FROM lg";
                  $result=$database->query($sql) or die($database->error());	
                  while($rows=$database->fetch_array($result)){
                  echo"<option value='{$rows['lg_code']}'>{$rows['lg_name']}</option>";
				  }
                  ?>
                </select></td>
              <td align="right"><span class="inputs">Agent's  Phone Number:</span></td>
              <td align="left"><input name="agent_phone" type="text" id="agent_phone" value="<?php echo @$agent_phone ?>" /></td>
            </tr>
            <tr>
              <td height="24" align="right" class="inputs">Ward:</td>
              <td align="left"><label for="ward_id"></label>
                <div id="cboLGA">
                  <select name="ward_code" id="ward_code" disabled="disabled">
                    <option value="<?php echo @$ward_id ?>"><?php echo @$ward_name?></option>
                    <?php 
                  $sql= "SELECT * FROM ward";
                  $result=$database->query($sql);	
                  while($rows=$database->fetch_array($result)){
                  echo"<option value='{$rows['ward_code']}'>{$rows['ward_name']}</option>";
				  }
                  ?>
                  </select>
                </div></td>
              <td align="right"><p>No register voters</p></td>
              <td align="left"><label>
                <input name="no_register_voters" type="text" id="no_register_voters" value="<?php echo @$no_register_voters ?>" />
              </label></td>
            </tr>
            <tr>
              <td align="right" class="inputs">&nbsp;</td>
              <td colspan="2" align="right"><label for="textfield4">
                <input type="submit" name="Back" id="Back" value="Back" />
                <input type="submit" name="Submit" id="Submit" value="<?php echo $action ?>" onclick=" return validate();"/>
                <input name="unit_id" type="hidden" id="unit_id" value="<?php echo @$unit_id ?>" />
              Uncheck to Edit Number:</label></td>
              <td align="left"><input name="Edit_phone" type="checkbox" id="Edit_phone" value="edit_phone" /></td>
            </tr>
          </table>
        </form></th>
      </tr>
      
      <tr class="inputs">
        <td width="4%" align="center" bgcolor="#CCCCCC">S/N</td>
        <td width="7%" align="center" bgcolor="#CCCCCC">  Code</td>
        <td width="39%" align="center" bgcolor="#CCCCCC">Polling Units Name</td>
        <td width="18%" align="center" bgcolor="#CCCCCC">Ward  Name</td>
        <td width="23%" align="center" bgcolor="#CCCCCC">Person incharge Name/Phone No</td>
        <td width="9%" colspan="2" align="center" bgcolor="#CCCCCC">&nbsp;</td>
      </tr>
      <?php 
	  $ward_code=$_SESSION['ward_code'];
      $sql= "SELECT * FROM polling_unit WHERE ward_code='$ward_code'";
	  $result=$database->query($sql);
	  $i=1;
	  while($rows=$database->fetch_array($result)){
         /* $lg_id=$rows["lg_id"];
		  $sql2= "SELECT * FROM lg WHERE lg_id='$lg_id'";
          $result2=$database->query($dbconnect,$sql2) or die($database->error());	
          $rows2=$database->fetch_array($result2);
          $lg_name2=$rows2['lg_name'];*/
		  $ward_code=$rows["ward_code"];
		  $sql4="SELECT * FROM ward WHERE ward_code='$ward_code'";
          $result4=$database->query($sql4);	
          $rows4=$database->fetch_array($result4);
          $ward_name2=$rows4['ward_name'];
		  
      echo"<tr class='inputs'>
        <td align='center' bgcolor='#FFFFFF'>$i</td>
        <td align='center' bgcolor='#FFFFFF'>{$rows['unit_code']}</td>
        <td bgcolor='#FFFFFF'><a href='enter_result.php?search={$rows['unit_code']}&unit_name={$rows['unit_name']}'>{$rows['unit_name']}<a</td>
        <td align='left' bgcolor='#FFFFFF'>$ward_name2</td>
        <td align='center' bgcolor='#FFFFFF'>{$rows['agent_name']} || {$rows['agent_phone']}</td>
        <td width='6%' align='center' bgcolor='#FFFFFF'><a href='polling_unit_menu.php?unit_id_edit={$rows['unit_id']}'>Edit</a></td>
        <td width='6%' align='center' bgcolor='#FFFFFF'><a href='polling_unit_menu.php?unit_id_delete={$rows['unit_id']}'>Delete</a></td>
      </tr>";
      $i++;
	  }
	  ?>
    </table></th>
  </tr>
</table>
</body>
</html>