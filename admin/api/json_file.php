<?php
//error_reporting(0); 
ob_start();
session_start();
include("../../include/database.php");
include("../../include/db_function.php");

/*if(@$_SESSION['users']==""){
redirect();
exit;
}
$budget_year=$_SESSION['budget_year'];
*/

//<a href="../../include/database.php">Untitled Document</a>
if(isset($_POST['Submit'])){	
$ip = gethostbyname('www.google.com');
     $sql="SELECT * FROM polling_unit WHERE unit_id <=20";// WHERE date_created BETWEEN '$datefrom' AND '$dateto'";	
     $result=$database->query($sql);
     $emparray = array();
    while($row =$database->fetch_assoc($result))
    {
	//$emparray[]= preg_replace('/[^a-zA-Z0-9]/',' ', $row['unit_name']);
		//$emparray[] = preg_replace('~&([a-z]{1,2})(\/)(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($row['unit_name'], ENT_COMPAT, 'UTF-8'));
    $Out = htmlspecialchars($row['unit_name']); // str_replace(' ', '-', $string);
	$emparray[] =str_replace('/', ' ', $Out);
	$emparray[] = $row['unit_code'];
    $emparray[] = $row['state_code'];
	$emparray[] = $row['lg_code'];
	$emparray[] = $row['ward_code'];
	$emparray[] = $row['unit_code2'];
	$emparray[] = $row['state_unit_code'];
    }
    echo json_encode($emparray);
    $fp = fopen('empdata.json', 'w');
    fwrite($fp, json_encode($emparray));
    fclose($fp);
 }

ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <input type="submit" name="Submit" id="Submit" value="Submit" />
</form>
</body>
</html>