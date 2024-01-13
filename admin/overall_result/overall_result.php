 <?php
error_reporting(0);
ob_start();
include("../../include/database.php");
include("../../include/db_function.php");	 
 //include("../validate/check_validate.php");
  
include("../../validate/phone_validate.php");
 
	   function res($party_name){
		 global $database;
	   $sql_SDP="SELECT SUM($party_name) AS party FROM result";
	   $result_SDP=$database->query($sql_SDP) or die($database->error());
	   $rows_SDP=$database->fetch_array($result_SDP);
	   $sum_SDP=$rows_SDP['party'];
	   return $sum_SDP;
	   }
?>
<?php
    $sql="SELECT * FROM party WHERE status IS NOT NULL"; 
    $res=$database->query($sql) or die($database->error());
    $tot=0;
    $total=0;
    $dataPoints=array();
    $dataPoints1=array();
    $x=1;
    while($rr=$database->fetch_array($res)){ 
        $party_name[]=$rr['party_name'];
        $num=res($rr['party_name']);
        $num2[]=number_format($num); 
        $total+=$num;
        $display=$rr['party_name']." - ".number_format($num); 
        $dataPoints[]=array("x"=> $x, "y"=> $num, "indexLabel"=> $display);
        $dataPoints1[]=array("label"=> $display, "y"=> $num);
        $x+=1;
    }
    $total_gr=number_format($total);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5 ; http:overall_result.php">
<title>--</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
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
<body topmargin="0" bottommargin="0">
<table width="80%" align="center" cellpadding="2" cellspacing="2" bgcolor="#CCCCCC" id="n">
  <tr>
    <th colspan="2" align="center" bgcolor="#66FF66" scope="col"><font size="+1" style="font-family:Tahoma, Geneva, sans-serif"> NATION WIDE RESULT SUMMARY</font></th>
  </tr>
  <?php
    for($i=0;$i<sizeof($party_name);$i++){
        echo"<tr>
        <td  width='11%' align='center' bgcolor='#EEEEEE'><font size='+3' style='font-family:Tahoma, Geneva, sans-serif; font-size: 15px; color: #000000;'><b>$party_name[$i]</b></font></td>
        <td align='right' bgcolor='#FFFFFF'><font size='+4' style='font-family:Tahoma, Geneva, sans-serif; color: #000000; font-size: 35px;'><b>$num2[$i]</b></font></td>
      </tr>";
    }
    $total_gr=number_format($total);
  ?>

  <tr>
    <th width="16%" align="right" bgcolor="#FFC1D1"><font size="+3" style="font-family:Tahoma, Geneva, sans-serif; font-size: 18px; color: #000000;">TOTAL:</font></th>
    <td width="84%" align="right" bgcolor="#FFC1D1"><font size="+5" style="font-family:Tahoma, Geneva, sans-serif; font-size: 35px; color: #000000;"><b><?php echo  $total_gr ?></b></font></td>
  </tr>
    <tr>
    <td width="100%" align="right" bgcolor="#FFF" colspan="2">&nbsp;
    </td>
  </tr>
<tr>
    <td width="50%" align="right" bgcolor="#FFF">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </td>
    <td width="50%" align="right" bgcolor="#FFF">
        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script src="../../canvasjs.min.js"></script>
</body>
</html>