<?php 
$lg_code=$_GET['q'];
include("../../include/database.php");

$sql = "SELECT * FROM ward WHERE lg_code ='$lg_code'";
$result = $database->query($sql);
 
 
  echo"<select name='ward_code'  id='ward_code' style='background-color: #FFFFFF'>";
	echo"<option value='0'>Select Ward..............</option>";
	while ($row = $database->fetch_array($result))
	{
	extract($row);
	echo"<option value='{$row['ward_code']}'>{$row['ward_name']}</option>";
	}
  echo"</select>";
  ?>