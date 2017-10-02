<?php
require 'db.php';
session_start();
if(isset($_REQUEST['p']))
{
    $p=$_REQUEST['p'];
    $project="sp_".$p;
}
 else {
     $p=104;
     $project="sp_104";
 }
$db_handle=new DBController($project);
if($p==104)
{
    $dt='2017-02-02';
}
else if($p==105)
{
    $dt='2016-12-18';
}
//echo $dt;
$initial= strtotime($dt);
$today=Date("Y-m-d");
//echo $today;
$final= strtotime($today);
$now=$dt;

while($now<$today)
{
    $query="select sum(number) as sumE from worker where date='$now'";
    //echo $query;
    
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $s=$row['sumE'];
            //echo $s;
            $man_array[] = array(
            'label' => $now,
            'value' => $s,
            );
            
        }
    }
    $now = strtotime("+1 day", strtotime($now));
    $now=Date("Y-m-d", $now);
}

?>
<html>
<head>
<title>My first chart using FusionCharts Suite XT</title>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'line',
    renderAt: 'chart-container',
    width: '100%',
    height: '300',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Total Manpower Data",
            "subCaption": "Last week",
            "xAxisName": "Day",
            "yAxisName": "No. of Visitors",

            //Cosmetics
            "lineThickness": "2",
            "paletteColors": "#0075c2",
            "baseFontColor": "#333333",
            "baseFont": "Helvetica Neue,Arial",
            "captionFontSize": "14",
            "subcaptionFontSize": "14",
            "subcaptionFontBold": "0",
            "showBorder": "0",
            "bgColor": "#ffffff",
            "showShadow": "0",
            "canvasBgColor": "#ffffff",
            "canvasBorderAlpha": "0",
            "divlineAlpha": "100",
            "divlineColor": "#999999",
            "divlineThickness": "1",
            "divLineIsDashed": "1",
            "divLineDashLen": "1",
            "divLineGapLen": "1",
            "showXAxisLine": "1",
            "xAxisLineThickness": "1",
            "xAxisLineColor": "#999999",
            "showAlternateHGridColor": "0",

        },
        "data": <?php echo json_encode($man_array);?>
    }
}
);
    fusioncharts.render();
});
</script>
</head>
<body>
  <div id="chart-container">FusionCharts XT will load here!</div>
</body>
</html>

