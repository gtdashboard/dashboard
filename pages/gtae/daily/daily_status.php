<?php
require '../db.php';
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
    $query="select sum(number) as sumE from worker where date='$now' and pno=$p";
    //echo $query;
    
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $s=$row['sumE'];
            //echo $s;
            if($s!=0)
            {
            	$rep=strtotime($now);
            	$k=Date("d.M.Y",$rep);
            	$man_array[] = array(
            	'label' => $k,
            	'value' => $s,
            	
            	"stepSkipped"=> false,
            	"appliedSmartLabel"=> true,
            	"link" => "print/print_page1.php?dt=$now&p=$p"
            	);
            }
            
            
        }
    }
    $now = strtotime("+1 day", strtotime($now));
    $now=Date("Y-m-d", $now);
}
    
    $query_wk="SELECT `work_order_no` FROM `work_order` WHERE date_done=(SELECT max(date_done) from work_order) and pno=$p";
    $result_wk=$db_handle->runQuery($query_wk);
    if(!empty($result_wk))
    {
        foreach ($result_wk as $row)
        {
            $wo1=$row['work_order_no'];
            $wo= substr($wo1,13);
            $wo="WO $wo";
            $cum_query="SELECT sum( ag ) AS cum_ag, sum( ug ) AS cum_ug FROM work_order WHERE work_order_no='$wo1'";
            $cum_result=$db_handle->runQuery($cum_query);
            foreach ($cum_result as $cum_row)
            {
                $cum_ag1=$cum_row['cum_ag'];
                $cum_ug1=$cum_row['cum_ug'];
            }
            $sum=($cum_ag1+$cum_ug1);
            if($p==104)
            {
                $sum/=1000;
            }
            $wo_array[] = array(
            'label' => $wo,
            'value' => "$sum",
            'color' =>  '#ff8693',
        );
        }
        
    }

?>
<!DOCTYPE html>
<html>
<?php $title="Daily Report";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper" >
 
   <br/>
      <div class="container">
        <div id="chart-container">Total Manpower Data Since Mobilization(<?php echo "SP $p";?>)</div>
        <br/>
        <div id="chart-containerwo">Work Order Status(<?php echo "SP $p";?>)</div>  
         </div>
        <br/>
        <div class="container" style="width:60%;background-color: white;">
        <h2 style="width:100%;text-align: center;text-transform: uppercase;">
            <?php echo $project; ?>
        </h2>
        <div id="calendar" ></div>
        
        <br/>
        
        
        <br/>
        
    </div>
    </div>  
    </div>
    <!-- /.container -->
<!-- ./wrapper -->

<?php require '../scripts.php';?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script>
        <script>
            (function ($){ 
                $('#calendar').fullCalendar({
                events: "datainfo.php?p=<?php echo $p?>"
        });
            })(jQuery);
        </script>
<script type="text/javascript" src="../../fusion/js/fusioncharts.js"></script>
<script type="text/javascript" src="../../fusion/js/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'area2d',
    renderAt: 'chart-container',
    width: '100%',
    height: '500',
    dataFormat: 'json',
    dataSource: {
        "chart": {
        "caption": "Total Manpower Data Since Mobilization(<?php echo "SP $p";?>)",
        "xAxisName": "Dates",
        "yAxisName": "No. of Manpower at Site",
         "showValues": "0",
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
        "slantlabels": "1",

        },
        "data": <?php echo json_encode($man_array);?>
    }
}
);
    fusioncharts.render();
    
    var fusionchartswo = new FusionCharts({
    type: 'bar2d',
    renderAt: 'chart-containerwo',
    "width": "100%",
    "height": '200',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Ongoing Work Order Status (<?php echo "SP-$p";?>)",
            "yAxisName": "Completion (Length in km)",
            "paletteColors": "#0075c2",
            "bgColor": "#ffffff",
            "showBorder": "0",
            "showCanvasBorder": "0",
            "usePlotGradientColor": "0",
            "plotBorderAlpha": "10",
            "placeValuesInside": "1",
            "valueFontColor": "#ffffff",
            "showAxisLines": "1",
            "axisLineAlpha": "25",
            "divLineAlpha": "10",
            "alignCaptionWithCanvas": "0",
            "showAlternateVGridColor": "0",
            "captionFontSize": "14",
            "subcaptionFontSize": "14",
            "subcaptionFontBold": "0",
            "toolTipColor": "#ffffff",
            "toolTipBorderThickness": "0",
            "toolTipBgColor": "#000000",
            "toolTipBgAlpha": "80",
            "toolTipBorderRadius": "2",
            "toolTipPadding": "5",
        },

        "data": <?php echo json_encode($wo_array);?>
    }
}
);
    fusionchartswo.render();
});
</script>
</body>
</html>
