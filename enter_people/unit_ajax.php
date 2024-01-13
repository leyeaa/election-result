<?php 
$lg_code=$_GET['q'];
include("../db/db.php");

$sql = "SELECT * FROM ward WHERE lg_code ='$lg_code'";
$result = mysql_query($sql);
 
 
  echo"<select name='ward_code' style='background-color: #FFFFFF'>";
	echo"<option value='0'>Select Ward..............</option>";
	while ($row = mysql_fetch_array($result))
	{
	extract($row);
	echo"<option value='{$row['ward_code']}'>{$row['ward_name']}</option>";
	}
  echo"</select>";
  ?>