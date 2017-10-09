<?php
require 'db.php';
session_start();
if(isset($_REQUEST['p']))
{
    $p=$_REQUEST['p'];
    $project="sp_".$p;
}
 else {
     $p=105;
     $project="sp_105";
 }
$db_handle=new DBController();
if($p==104)
{
    $dt='2017-02-02';
}
else if($p==105)
{
    $dt='2016-12-18';
}
$initial= strtotime($dt);
$today=Date("Y-m-d");
$final= strtotime($today);
$now=$dt;
$category='';
$sum='';
while($now<$today)
{
    $query="select sum(number) as sumE from worker where date='$now' and pno=$p";
   // echo $query;
  //  echo "<br>";
    
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $s=$row['sumE'];
            //echo $s;
            if($s!=0)
            {
                if(strcmp($category,'')!=0)
                {
                    $category.='|';
                    $sum.='|';
                }
            	$rep=strtotime($now);
            	$k=Date("M d",$rep);
                $category.="$k";
            	$sum.="$s";
            }
            
            
        }
       // echo json_encode($man_array);
    }
    $now = strtotime("+1 day", strtotime($now));
    $now=Date("Y-m-d", $now);
}
//echo "Cat: ".$category;
//echo "<br>Sum: ".$sum;
?>
<html>
<head>
<title></title>
<script type="text/javascript" src="fusion/js/fusioncharts.js"></script>
<script type="text/javascript" src="fusion/js/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'zoomline',
    renderAt: 'chart-container',
    width: '600',
    height: '400',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Manpower Mobilized",
            "yaxisname": "Manpower",
            "xaxisname": "Date",
            "yaxisminValue": "60",
            "yaxismaxValue": "800",
            "pixelsPerPoint": "0",
            "pixelsPerLabel": "30",
            "lineThickness": "1",
            "compactdatamode": "1",
            "dataseparator": "|",
            "labelHeight": "30",
            "theme": "fint"
        },
        "categories": [{
            "category": "<?php echo $category?>"
        }],
         "dataset": [{
            "seriesname": "SP <?php echo $p?>",
            "data":  "<?php echo $sum?>"
        }]
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