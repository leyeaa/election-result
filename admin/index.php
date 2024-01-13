<?php
session_start();
$name='';//$_GET['name']; 
//$_SESSION['name']=$name;
/*$user=$_POST['user'];
$pass_word=$_POST['pass_word'];
if($user== "admin" OR "view" AND $pass_word== "election")
{
//$user=$_GET['user'];
       if($user=="view")
	   {
		header("location:whole_screen/index.php");
        exit;
	   }
	   //--
	   if($user=="state")
	   {
		header("location:whole_screen/whole_state.php");
        exit;
	   }

if($user== "admin")
{
 $go="left_admin.php";
}
else{
  $go="left_user.php";
}	
	
}
else{
	$message="Invalid Username or Password";
header("location:index.php?message=$message");
exit;
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::||| Mobile Election Counting Software :::|||</title>
</head>
<frameset rows="41,*" cols="*" framespacing="0" frameborder="no" border="0" bordercolor="#990000">
  <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="193,*" framespacing="0" frameborder="no" border="0" bordercolor="#990000">
    <frame src="left_admin.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="overall_result/overall_result.php" name="all_page" id="all_page" title="mainFrame" />
  </frameset>
</frameset>
<noframes><body>
</body></noframes>
</html>
