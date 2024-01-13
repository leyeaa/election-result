<?php 
 include("../db/db.php");
 if(isset($_GET['validate_id'])){
$msg_id2=$_GET['validate_id'];

$sqlchk="SELECT * FROM MessageIn WHERE Id ='$msg_id2'";
$s=sqlsrv_query($dbconnect,$sqlchk) or die("can not delete");	
$rlt=sqlsrv_fetch_array($s);
$sta=$rlt['status'];
if($sta==""){
$status=1;
}else{
$status="";	
}
$sql="UPDATE MessageIn SET status=? WHERE Id =?";
//$sql="UPDATE polling_unit SET unit_name =?,lg_id=?,ward_id=?,agent_name=?,agent_phone=? WHERE unit_id=?";
$params=array($status,$msg_id2);
sqlsrv_query($dbconnect,$sql,$params) or die("vali");	

header("location:all_messages.php");
exit;

/*$sql="DELETE FROM result WHERE unit_id ='$unit1'";
sqlsrv_query($dbconnect,$sql) or die("can not delete");	*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>