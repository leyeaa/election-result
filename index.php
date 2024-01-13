<?php 
ob_start();
session_start();
include("include/database.php");
include("include/db_function.php");
if(isset($_POST['Submit'])){
$user_name=trim($_POST['user_name']);
$passwords=trim($_POST['pass_word']);
//$pass_word=trim($_POST['pass_word']);
//$state_code=$_POST['state'];

$sql="SELECT * FROM users WHERE user_name='$user_name' AND pass_word='$passwords'";
$result=$database->query($sql);
if($rows=$database->fetch_array($result))
{	
                       //$user_name=$rows["user_name"];
					    $state_code=trim($rows['state_code']);
						$access_level=$rows['access_level'];
						$_SESSION['allow']="Yes";
						$_SESSION['access_level']=$access_level;	
					    switch(@$access_level)
						{
						case"state":
						$_SESSION['state_code']=$state_code;
						header("location:state_user/index.php");
						 break;
						case"admin":
						header("location:admin/index.php");
						 break;
						/*case"user":
						$_SESSION['state_code2']=$state_code;
						header("location:whole_screen/whole_state.php"); 
						 break; 
						case"any":
						$_SESSION['state_code2']=$state_code;
						header("location:whole_screen/overall_result_state.php"); 
						 break;   */
						}

}
else
{
 $message="Invalid Username or Password";
}
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::||| Mobile Election Counting Software:::|||</title>
<link href="csc/csc_sheet.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function validate(){
 var user_name = document.getElementById('user_name').value;
     if(user_name==""){
	 alert("Please Enter Username");
	 document.getElementById('user_name').focus();
	 return false;
	 }
	 
 var pass_word = document.getElementById('pass_word').value;
     if(pass_word==""){
	 alert("Please Your Password");
	 document.getElementById('pass_word').focus();
	 return false;
	 }
}
</script>

<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
#im{background:url(image/bg.gif);
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
</style>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="64%" height="289" align="center" id="n">
  <tr>
    <td align="center"><div id="im">
      <table width="67%" align="center" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
        <tr>
          <th align="left" valign="top" scope="col"><form id="form1" name="form1" method="post" action="index.php">
            <table width="100%">
              <tr>
                <th class="mobile_head" scope="col"> e-Election Management System</th>
              </tr>
              <tr class="inputs">
                <td><fieldset>
                  <legend> Login:</legend>
                  <table width="85%" align="center" cellpadding="4" cellspacing="1" id="n">
                    <tr>
                      <th colspan="2" scope="col"> <?php if(isset($message)) echo $message ?>
                        <?php if(isset($_REQUEST['message'])) echo $_REQUEST['message'] ?></th>
                    </tr>
                    <tr>
                      <td width="42%" align="right" class="inputs">Username:</td>
                      <td width="58%" align="left"><label for="user_name2"></label>
                        <input type="text" name="user_name" id="user_name" />
                        *</td>
                    </tr>
                    <tr>
                      <td align="right" class="inputs">Password:</td>
                      <td align="left"><label for="pass_word"></label>
                        <input type="text" name="pass_word" id="pass_word" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left"><input type="submit" name="Submit" id="Submit" value="Login" onclick=" return validate();"/></td>
                    </tr>
                  </table>
                </fieldset></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
          </form></th>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</body>
</html>