<?php 
set_time_limit(0);
session_start();
include("../../include/database.php");
include("../../include/db_function.php");
//$state_code=$_GET['state_code'];
$lg_code=$_GET['lg_code'];
//------------------------------------
$lg_name=lg_name($lg_code);
$state_code=$_SESSION['state_code'];
$state_name=state_name($state_code);

function ward_result($party_name,$ward_code,$state_code){
	global $database;
$sql2="SELECT SUM($party_name) AS tot FROM result WHERE ward_code='$ward_code' AND state_code='$state_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $result=$rows2['tot'];
	  return $result;	
}

function ward_result_others($other_name,$ward_code,$state_code){
	global $database;
$sql2="SELECT SUM($other_name) AS tot FROM result WHERE ward_code='$ward_code' AND state_code='$state_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $result=$rows2['tot'];
	  return $result;	
}

function state_result($party_name,$lg_code){
	global $database;
$sql2="SELECT SUM($party_name) AS tot FROM result WHERE lg_code='$lg_code'";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $result=$rows2['tot'];
	   return $result;	
}
////-----------------------------------------------------------
?>

<?php
    $sqla4="SELECT * FROM party WHERE status IS NOT NULL"; 
    $resa4=$database->query($sqla4) or die($database->error());
    $dataPoints=array();
    $dataPoints1=array();
    $x=1;
    while($rra4=$database->fetch_array($resa4)){
        $party_name_all[]=$party_name=trim($rra4['party_name']);
        $party_result=state_result($party_name,$lg_code);
        $party_result_all[]=number_format($party_result,0); 
        
        $display=$party_name." - ".number_format($party_result); 
        $dataPoints[]=array("x"=> $x, "y"=> $party_result, "indexLabel"=> $display);
        $dataPoints1[]=array("label"=> $display, "y"=> $party_result);
        $x+=1;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SUMMARY RESULT</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 10px;
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
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 9px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>
<script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	animationEnabled: true,
    	exportEnabled: true,
    	theme: "light1", // "light1", "light2", "dark1", "dark2"
    	title:{
    		text: "BAR CHART REPRESENTATION"
    	},
    	axisY:{
    		includeZero: true
    	},
    	data: [{
    		type: "column", //change type to bar, line, area, pie, etc
    		//indexLabel: "{y}", //Shows y value on all Data Points
    		indexLabelFontColor: "#5A5757",
    		indexLabelPlacement: "outside",   
    		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    
    var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        exportEnabled: true,
        title:{
            text: "PIE CHART REPRESENTATION"
        },
        data: [{
            type: "pie",
            showInLegend: "true",
            legendText: "{label}",
            indexLabelFontSize: 16,
            indexLabel: "{label} (#percent%)",
            yValueFormatString: "฿#,##0",
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    chart1.render();
     
    }
    </script>
</head>

<body>
<table width="100%" cellpadding="3">
  <tr>
    <th align="center"><?php echo $state_name ?> STATE  ELECTION </th>
  </tr>
  <tr>
    <th align="center">SUMMARY OF RESULT <?php echo $state_name ?> STATE</th>
  </tr>
  <tr>
    <th align="center"><?php echo $lg_name ?> Local Government Area </th>
  </tr>
</table>
<table width="100%">
  
</table>
<?php 
 
   $sqla="SELECT * FROM party WHERE status IS NOT NULL"; 
   $resa=$database->query($sqla) or die($database->error());
   $number_rows=$database->num_rows($resa);
?>
<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#999999" id="n">
  <tr>
    <th width="2%" rowspan="2" align="center" bgcolor="#E5E5E5">S/N</th>
    <th width="10%" rowspan="2" align="center" bgcolor="#E5E5E5">Ward Name</th>
    <th width="3%" rowspan="2" align="center" bgcolor="#E5E5E5">Ward Code</th>
    <th width="5%" rowspan="2" align="center" bgcolor="#E5E5E5">REG. Voters</th>
    <th width="4%" rowspan="2" align="center" bgcolor="#E5E5E5">NO. of ACC Voters</th>
    <th colspan="<?php echo $number_rows ?>" align="center" bgcolor="#FFFFCC">PARTIES</th>
    <th width="5%" rowspan="2" align="center" bgcolor="#E5E5E5">Total valid Voter</th>
    <th width="5%" rowspan="2" align="center" bgcolor="#E5E5E5">Rejected Voters</th>
    <th width="5%" rowspan="2" align="center" bgcolor="#E5E5E5">Total Voters Cast</th>
  </tr>
  <tr>
    <?php
   $sqla="SELECT * FROM party WHERE status IS NOT NULL"; 
   $resa=$database->query($sqla) or die($database->error());
   while($rra=$database->fetch_array($resa)){ 
   $party_name=$rra['party_name'];
   echo"<th width='5%' align='center' bgcolor='#E5E5E5'>$party_name</th>";
    }
   ?>
  </tr>
   <?php 
  $sql="SELECT * FROM ward WHERE lg_code='$lg_code' AND state_code='$state_code'";
  $result=$database->query($sql) or die($database->error());
  $i=1;
  $total_RV=0;
  $total_AV=0;
  $total_valide=0;
    $tota_voter_cast_g=0;
  $total_rejected_v=0;
  while($rows=$database->fetch_array($result)){
	$ward_code=$rows['ward_code']; 
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'>$i</td>
    <td align='left' bgcolor='#FFFFFF'><a href='summary_result_unit.php?ward_code=$ward_code&lg_code=$lg_code&state_code=$state_code'>{$rows['ward_name']}</a></td>
    <td align='center' bgcolor='#FFFFFF'>{$rows['ward_code']}</td>";
	$RV='RV'; // Registrered Voters
	$AV='AV';  // Accresdited Voters
	$ward_RV=ward_result_others($RV,$ward_code,$state_code);
	$ward_AV=ward_result_others($AV,$ward_code,$state_code);
   echo"<td align='center' bgcolor='#FFFFFF'>$ward_RV</td>
    <td align='center' bgcolor='#FFFFFF'>$ward_AV</td>";
	
   $sqla2="SELECT * FROM party WHERE status IS NOT NULL"; 
   $resa2=$database->query($sqla2) or die($database->error());
   $side_valide_vote=0;
   while($rra2=$database->fetch_array($resa2)){ 
   
	$party_namen=trim($rra2['party_name']);
	
	$ward_total=ward_result($party_namen,$ward_code,$state_code);
    echo"<td align='center' bgcolor='#FF99FF'>$ward_total</td>";
	//total valide votes cast
	$side_valide_vote+=$ward_total;
    }

    echo"<td align='center' bgcolor='#FFFFCC'>$side_valide_vote</td>";
	$RJV='RJV'; //rejected votes
	$ward_RJV=ward_result_others($RJV,$ward_code,$state_code);
    echo"<td align='center' bgcolor='#FFFFFF'>$ward_RJV</td>";
	//total Votes cast
	$total_vote_cast=($side_valide_vote+$ward_RJV);
    echo"<td  align='center' bgcolor='#FFFFFF'>$total_vote_cast</td>";
    echo"</tr>";
  $i++;
  $total_RV+=$ward_RV;
  $total_AV+=$ward_AV;
  
  $total_valide+=$side_valide_vote;
  $tota_voter_cast_g+=$total_vote_cast;
  $total_rejected_v+=$ward_RJV;
  }
  ?>
  <tr align="left">
    <th colspan="3" align='center' bgcolor="#FFFFFF">Total:</th>
    <th align='center' bgcolor="#E5E5E5"><?php echo $total_RV  ?></th>
    <th align='center' bgcolor="#E5E5E5"><?php echo $total_AV ?></th>
<?php
    for($i=0;$i<sizeof($party_name_all);$i++){
        echo"<th bgcolor='#E5E5E5' align='center'>$party_result_all[$i]</th>";
    }
?>
    
    <th align='center' bgcolor="#E5E5E5"><?php echo $total_valide ?></th>
    <th align='center' bgcolor="#E5E5E5"><?php echo $total_rejected_v ?></th>
    <th align='center' bgcolor="#E5E5E5"><?php echo $tota_voter_cast_g ?></th>
  
  </tr>
</table>

<?php 
function total_oth($nn,$state_code){
$sql2="SELECT SUM($nn) AS tot FROM result";
	   $result2=$database->query($sql2) or die($database->error());
	   $rows2=$database->fetch_array($result2);
	   $result=$rows2['tot'];
	   return $result;	
}



?>
<table width="100%">
<tr><td width="34%" valign="top">
        <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#999999" id="n">
          <tr>
            <th colspan="3" align="center" bgcolor="#FFFFCC">SUMMARY RESULT</th>
          </tr>
          <tr>
            <th width="8%" align="center" bgcolor="#FFFFFF">a</th>
            <td width="71%" bgcolor="#FFFFFF">TOTAL NUMBER OF VALID VOTERS </td>
            <th width="21%" align="left" bgcolor="#FFFFFF"><?php echo number_format($total_valide,0) ?></th>
          </tr>
          <tr>
            <th align="center" bgcolor="#FFFFFF">b</th>
            <td bgcolor="#FFFFFF">TOTAL NUMBER OF REJECTED VOTERS</td>

            <th align="left" bgcolor="#FFFFFF"><?php echo number_format($total_rejected_v,0)?></th>
          </tr>
          <tr>
            <th align="center" bgcolor="#FFFFFF">c</th>
            <td bgcolor="#FFFFFF">TOTAL NUMBER OF VOTERS CAST</td>
            <th align="left" bgcolor="#FFFFFF"><?php echo number_format($tota_voter_cast_g,0) ?></th>
          </tr>
          <tr>
            <th align="center" bgcolor="#FFFFFF">d</th>
            <td bgcolor="#FFFFFF">TOTAL NUMBER OF ACCREDITTED VOTERS</td>
            <th align="left" bgcolor="#FFFFFF"><?php echo number_format($total_AV,0) ?></th>
          </tr>
          <tr>
            <th align="center" bgcolor="#FFFFFF">e</th>
            <td bgcolor="#FFFFFF">TOTAL NUMBER OF REGISTERED VOTERS</td>
            <th align="left" bgcolor="#FFFFFF"><?php echo number_format($total_RV,0)  ?></th>
          </tr>
        </table>
    </td>
    <td valign="top">
        <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#999999" id="n">
          <tr>
            <td bgcolor="#FFFFFF"><div id="chartContainer" style="height: 370px; width: 100%;"></div></td>
            <td bgcolor="#FFFFFF"><div id="chartContainer1" style="height: 370px; width: 100%;"></td>
          </tr>
        </table>
    </td>
</tr>
</table>

<p>&nbsp;</p>
<script src="../../canvasjs.min.js"></script>
</body>
</html>