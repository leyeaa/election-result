<?php
//error_reporting(0);
//============================================================= Connect to mysl_database=======================
$server2 = "localhost";
$user = "root";
$password = "";
$database = "presidential_election";
$con = mysql_connect($server2, $user, $password, $database);
mysql_select_db($database) or die("Cant't Select Database");
//========================================================================================          
?>