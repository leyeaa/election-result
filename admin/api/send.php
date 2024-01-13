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
/*if($ip != 'www.google.com') {
 
} else {
 $message="This Computer is not connected to Internet..."; 

 header("location:select_date_upload.php?message=$message");
 exit;
}*/  
 $from=2000;
  $result= data_to($from);
   var_dump($result);
 }
 
 
 
 function data_to($from){
	  global $database;
    $sql="SELECT * FROM polling_unit WHERE state_code=13";//polling_unit WHERE unit_id <=600";// WHERE date_created BETWEEN '$datefrom' AND '$dateto'";	
    $result=$database->query($sql);
	//$num_rows=$database->num_rows($result);
   //if($num_rows >=1)
   //{
    $emparray = array();
    while($row =$database->fetch_assoc($result))
    {
	//$emparray[] = htmlspecialchars($row['unit_name']);
	$Out = htmlspecialchars($row['unit_name']); // str_replace(' ', '-', $string);
	$emparray[] =str_replace('/', ' ', $Out);
	$emparray[] = $row['unit_code'];
    $emparray[] = $row['state_code'];
	$emparray[] = $row['lg_code'];
	$emparray[] = $row['ward_code'];
	$emparray[] = $row['unit_code2'];
	$emparray[] = $row['state_unit_code'];
    }
	$SuccessfulResponse = array("status" => "success",
    "data" => $emparray);
	$data=json_encode(array("info" => $SuccessfulResponse));
     //$url='http://localhost/oop_card/api/employment.php';
	 //$url='https://www.ondoagapp.org/ag_expenditure/api_from_finance/tax.php';
	 $url='http://www.ondobyelection.com/admin/api/insert.php'; //http://www.ondobyelection.com/admin/api/
	 //$url='http://localhost/2018_ag/ag_expenditure/api_from_finance/tax.php';
	 //echo"$data";
    $result=send_data($url,$data);
   }    
 //}
 
//[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[
function send_data($url,$data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    $headers = array(
      'Content-Type: application/json',
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //dont torch this place.
    $exec = curl_exec ($ch);
    if ($exec):
        $result = json_decode($exec, true);
    else:
        $result = curl_error($ch);
    endif;
    curl_close ($ch);
    return $result;
}

//---------
function yuu($url,$data){
$content = json_encode($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
		array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //curl error SSL certificate problem, verify that the CA cert is OK

$result		= curl_exec($curl);
$response	= json_decode($result);
var_dump($response);
curl_close($curl);		
}
//=====================================	
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