<?php 
ob_start();
//error_reporting(0);
session_start();
include("../../include/database.php");
include("../../include/db_function.php");
/*if(isset($_GET['search'])){
$search=$_GET['search'];	
}*/
$state_code=$_SESSION['state_code'];
$lg_code=$_SESSION['lg_code'];
$state_name=state_name($state_code);
if(isset($_GET['search'])){
$unit_code=$_GET['search'];
//$unit_code=trim($_POST['unit_code']);
$sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit_code' AND state_code='$state_code'";
	  $resulp=$database->query($sqlp) or die($database->error());
	  if($rowp=$database->fetch_array($resulp)){
	  $unit_name=addslashes($rowp['unit_name']);
	  $lg_code=$rowp['lg_code'];
	  $ward_code=$rowp['ward_code'];
	  $state_code=$rowp['state_code'];
	  $state_unit_code=$rowp['state_unit_code'];
	  $unit_code=$rowp['unit_code'];
	  $lg_name=lg_name($lg_code);
	  $ward_name=ward_name($ward_code);
	  //$go="True";
	  //-----------------------------------
	   $ck="SELECT * FROM result WHERE unit_code='$unit_code' AND state_code='$state_code'";
	   $rk=$database->query($ck) or die($database->error());
	      $roo=$database->fetch_array($rk);  
	  }
	  else{
		$message="Invalide Polling Unit Code"; 
		$go="No";  
	  }
	
}
///
if(isset($_POST['Submit'])){ 
 $score=$_POST['score'];
 $unit_code=trim($_POST['unit_code']);
	 //--------------------------------------------------------------------------
       $ck="SELECT * FROM result WHERE unit_code='$unit_code' AND state_code='$state_code'";
	   $rk=$database->query($ck);
	   if($ro=$database->fetch_array($rk)){
		   //notting is inside the result table
		   foreach($score as $key => $value){
			$yy="UPDATE result SET $key='$value' WHERE unit_code='$unit_code' AND state_code='$state_code'";
			$database->query($yy);		
		   }
	    }
	    else{
	   // insert into
	     $sqlp= "SELECT * FROM polling_unit WHERE unit_code='$unit_code' AND state_code='$state_code'";
	     $resulp=$database->query($sqlp) or die($database->error());
	     $rowp=$database->fetch_array($resulp);
	     $unit_name=addslashes($rowp['unit_name']);
	     $lg_code=$rowp['lg_code'];
	     $ward_code=$rowp['ward_code'];
	     //$state_code=28;
	     $gg="INSERT INTO result SET unit_code='$unit_code',lg_code='$lg_code',ward_code='$ward_code',state_code='$state_code'";
	     $database->query($gg) or die($database->error()); 
		 //===================
		 foreach($score as $key => $value){
			$yy="UPDATE result SET $key='$value' WHERE unit_code='$unit_code' AND state_code='$state_code'";
			$database->query($yy) or die($database->error());		
		 }	
   }
	header("location:polling_unit_menu.php");
	exit;
	  	
}
 if(isset($_POST['Back'])){
	header("location:polling_unit_menu.php");
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

<body>
<table width="100%" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%"><form id="form1" name="form1" method="post" action="enter_result.php">
      <table width="91%" cellpadding="2" cellspacing="1" id="n">
        <tr>
          <th width="35%" align="right" bgcolor="#DFDFDF">State Name:</th>
          <th width="65%" align="left" bgcolor="#DFDFDF"><?php echo @$state_name ?> </th>
          </tr>
        <tr>
          <td colspan="2" align="center"><?php if(isset($message)) echo $message ?></td>
          </tr>
        <tr>
          <th colspan="2" align="right"><hr /></th>
        </tr>
        <tr>
          <th align="right" bgcolor="#DFDFDF">            Local Government:</th>
          <td bgcolor="#DFDFDF"><?php echo @$lg_name ?>&nbsp;</td>
        </tr>
        <tr>
          <th align="right" bgcolor="#DFDFDF">Ward:</th>
          <td bgcolor="#DFDFDF"><?php echo @$ward_name ?>&nbsp;</td>
        </tr>
        <tr>
          <th align="right" bgcolor="#DFDFDF">Pollling Unit:</th>
          <td bgcolor="#DFDFDF"><?php echo @$unit_name ?></td>
        </tr>
        <tr>
          <th align="right" bgcolor="#DFDFDF">Polling Unit Code:</th>
          <td bgcolor="#DFDFDF"><label for="textfield"></label>
            <input name="textfield" type="text" disabled="disabled"id="textfield"  value="<?php echo @$unit_code ?>" />
            <input type="hidden" name="unit_code" id="unit_code"  value="<?php echo @$unit_code ?>"/></td>
        </tr>
        <?php 
		$se="SELECT * FROM party ORDER BY status";
		$re=$database->query($se);
		while($ro=$database->fetch_array($re)){
			$party_name=$ro["party_name"];
			$label=$ro['label'];
			
       echo"<tr>
          <th align='right'>$label:</th>
          <td><label for='score[]'></label>
            <input type='text' name='score[$party_name]' value='{$roo[$party_name]}' id='score[$party_name]'  size='5'/></td>
          </tr>";
		   }
          ?>
        <tr>
          <td align="right"><input type="submit" name="Back" id="Back" value="Back" /></td>
          <td><input type="submit" name="Submit" id="Submit" value="ADD / EDIT" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>