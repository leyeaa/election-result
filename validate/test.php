
<?php 
$msg2="1234*LP890*ACP789*PDP899";
$arry_msg2=explode("*",$msg2);
$fd=count($arry_msg2);

$unit_id=trim($arry_msg2[0]); //unit_id from here
//LP length is 2
$LPN=$arry_msg2[1];	  
$LP=strtoupper(SUBSTR($LPN,0,2));
//$LP_score=$arry_msg2[1];
$LP_score= preg_replace("/[^0-9]/", "", $arry_msg2[1]);

//$str2 = substr('$LP_score',2);
echo"$str";
exit;

//APC length is 3
$APCN=$arry_msg2[2];	  
$APC=strtoupper(SUBSTR($APCN,0,3));
//$APC_score=SUBSTR($APCN,0,3);
$APC_score=preg_replace("/[^0-9]/", "", $arry_msg2[2]);

//PDP length is 3
$PDPN=$arry_msg2[3];	  
$PDP=strtoupper(SUBSTR($PDPN,0,3));
$PDP_score=preg_replace("/[^0-9]/", "", $arry_msg2[3]);





echo"$PDP_score";
exit;






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