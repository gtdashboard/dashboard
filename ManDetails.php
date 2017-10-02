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
$db_handle=new DBController();
if(isset($_REQUEST['dt']))
{
    $dt=$_REQUEST['dt'];
}
else 
{
     $dt='2017-02-02';
}
    $query="select designation,number from worker where date='$dt' and pno=$p order by number desc";
    //echo $query;
    
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $d=$row['designation'];
            $n=$row['number'];
            //echo $s;
            $man_array[] = array(
            'label' => $d,
            'value' => $n,
            );
            
        }
    }
    
    $query="select type,number_equip from equipment where date_used='$dt' and pno=$p order by number_equip desc";
    //echo $query;
    
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $d=$row['type'];
            $n=$row['number_equip'];
            //echo $s;
            $equip_array[] = array(
            'label' => $d,
            'value' => $n,
            );
            
        }
    }
?>
<html>
<head>
<title>Manpower Chart</title>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'column2D',
    renderAt: 'chart-container',
    width: '100%',
    height: '500',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": " Manpower at site",
            "subCaption": "<?php echo $dt;?>",
            "xAxisName": "Designation",
            "yAxisName": "No. present at site",

            "showvalues": "1",
        "plotgradientcolor": "",
        "canvasbgalpha": "0",
        "bgalpha": "0",
        "plotborderalpha": "0",
        "canvasborderalpha": "0",
        "showborder": "0",
        "showalternatehgridcolor": "0",
        "rotatelabels": "1",
        "slantlabels": "1",
        "captionpadding": "20",
        "tooltipbgcolor": "138dd7",
        "tooltipcolor": "ffffff",
        "tooltipbordercolor": "138dd7",
        "showtooltipshadow": "0",
        "palettecolors": "5167c7"

        },
        "data": <?php echo json_encode($man_array);?>
    }
}
);
    fusioncharts.render();
    var fusioncharts2 = new FusionCharts({
    type: 'column2D',
    renderAt: 'chart-container2',
    width: '100%',
    height: '500',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": " Equipments at site",
            "subCaption": "<?php echo $dt;?>",
            "xAxisName": "Equipment",
            "yAxisName": "No. present at site",

            "showvalues": "1",
        "plotgradientcolor": "",
        "canvasbgalpha": "0",
        "bgalpha": "0",
        "plotborderalpha": "0",
        "canvasborderalpha": "0",
        "showborder": "0",
        "showalternatehgridcolor": "0",
        "rotatelabels": "1",
        "slantlabels": "1",
        "captionpadding": "20",
        "tooltipbgcolor": "138dd7",
        "tooltipcolor": "ffffff",
        "tooltipbordercolor": "138dd7",
        "showtooltipshadow": "0",
        "palettecolors": "5167c7"

        },
        "data": <?php echo json_encode($equip_array);?>
    }
}
);
    fusioncharts2.render();
});
</script>
</head>
<body>
  <div id="chart-container">FusionCharts XT will load here!</div>
  <div id="chart-container2">FusionCharts XT will load here!</div>
</body>
</html>

