<?php
    require 'db.php';
    require 'datediff.php';
    $db_handle=new DBController();
    $m=date('m');
    $y=date('Y');
    $query_wk="SELECT `work_order_no` FROM `work_order` WHERE date_done=(SELECT max(date_done) from work_order where pno=104) and pno=104";
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
            $sum=($cum_ag1+$cum_ug1)/1000;
            $wk_array[] = array(
            'label' => $wo,
            'value' => "$sum",
            'color' =>  '#ff8693',
        );
        }
        
    }
    $query_nk="SELECT `work_order_no` FROM `work_order` WHERE date_done=(SELECT max(date_done) from work_order where pno=105) and pno=105";
    $result_nk=$db_handle->runQuery($query_nk);
    if(!empty($result_nk))
    {
        foreach ($result_nk as $row)
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
            $sum=$cum_ag1+$cum_ug1;
            $nk_array[] = array(
            'label' => $wo,
            'value' => "$sum",
            'color' =>  '#ff8693',
            );
        }
        
    }

$today=Date("Y-m-d");
//echo $today;
$final= strtotime($today);
$now='2017-02-02';

while($now<$today)
{
    $query="select sum(number) as sumE from worker where date='$now' and pno=104";
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
            	$man_arraywk[] = array(
            	'label' => $k,
            	'value' => $s,
            	
            	"stepSkipped"=> false,
            	"appliedSmartLabel"=> true,
            	"link" => "print/print_page1.php?dt=$now&p=104"
            	);
            }
            
            
        }
    }
    $now = strtotime("+1 day", strtotime($now));
    $now=Date("Y-m-d", $now);
}

$now='2016-12-18';
while($now<$today)
{
    $query="select sum(number) as sumE from worker where date='$now' and pno=105";
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
            	$man_arraynk[] = array(
            	'label' => $k,
            	'value' => $s,
            	
            	"stepSkipped"=> false,
            	"appliedSmartLabel"=> true,
            	"link" => "print/print_page1.php?dt=$now&p=105"
            	);
            }
            
            
        }
    }
    $now = strtotime("+1 day", strtotime($now));
    $now=Date("Y-m-d", $now);
}
//echo json_encode($man_arraynk);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DashBoard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

 <?php require 'header_main.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container" style="width:100%">
    <!-- Content Header (Page header) -->
    <section class="content-header">
         <!-- =========================================================== --> 
        <div class="row">
        <?php
            $query_basic="SELECT * FROM general";
            $result_basic=$db_handle->runQuery($query_basic);
            foreach ($result_basic as $row) {
               $elapse= elapse($row['commence_date'], $row['finish_date']) ;
        ?>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Contract Value(SP <?php echo $row['pno'];?>)</span>
              <span class="info-box-number"><?php echo $row['contract_value'];?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 12%"></div>
              </div>
                  <span class="progress-description">
                    12% Value Consumed 
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Project Duration(SP <?php echo $row['pno'];?>)</span>
              <span class="info-box-number"><?php echo $row['contract_period'];?></span>

              <div class="progress">
                  <div class="progress-bar" style="width: <?php echo $elapse;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo $elapse;?>% Time Elapsed
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <?php }?>
        </div>

    <div class="row">
    <div class="col-md-6" style="text-align: center;">
        <!-- Line chart -->
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Work Orders NK</h3>
        </div>
        <div class="box-body" >
        <div id="chart-containernk" >FusionCharts XT will load here!</div>
        </div>
        <!-- /.box-body-->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6" style="text-align: center;">
        <!-- Line chart -->
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Work Orders WK</h3>
        </div>
        <div class="box-body" >
        <div id="chart-containerwk" >FusionCharts XT will load here!</div>
        </div>
        <!-- /.box-body-->
        </div>
        <!-- /.box -->
    </div>
    </div>
         
    <div class="row">
    <div class="col-md-6" style="text-align: center;">
        <!-- Line chart -->
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Manpower NK</h3>
        </div>
        <div class="box-body">
        <div id="chart-man-nk" >FusionCharts XT will load here!</div>
        </div>
        <!-- /.box-body-->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6" style="text-align: center;">
    <!-- Line chart -->
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Manpower WK</h3>
        </div>
        <div class="box-body">
        <div id="chart-man-wk" >FusionCharts XT will load here!</div>
        </div>
        <!-- /.box-body-->
        </div>
        <!-- /.box -->
    </div>
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="col-md-4" style="text-align: center;">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Equipment Status</h3>
        </div>
        <div class="box-body" >
        <div id="chart-container" >FusionCharts XT will load here!</div>
        </div>
        </div>
    </div>
    <div class="col-md-4" style="text-align: center;">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Manpower Status</h3>
        </div>
        <div class="box-body" >
        <div id="chart-container2" >FusionCharts XT will load here!</div>
        </div>
        </div>
    </div>
    <div class="col-md-4" style="text-align: center;">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Work Order Status</h3>
        </div>
        <div class="box-body">
        <div id="chart-container5" >FusionCharts XT will load here!</div>
        </div>
        </div>
    </div>
    </div>
    
    <div class="row">
    <div class="col-md-4" style="text-align: center;">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Work Order Values Completed</h3>
        </div>
        <div class="box-body" style="text-align: center;padding: 10px">
        <div id="chart-container4" >FusionCharts XT will load here!</div>
        </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Work Order Completion</h3>
        </div>
        <div class="box-body" style="align-content: center;">
        <div id="chart-container3">FusionCharts XT will load here!</div>
        </div>
        </div>
    </div>
    </div>
    
    <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Procurement</h3>
        </div>
        <div class="box-body" style="align-content: center;">
        <div id="chart-container6">FusionCharts XT will load here!</div>
        </div>
        </div>
    </div> 
    </div>
    
    <div class="row">
    <div class="col-md-4">
        <div class="box">
        <div class="box-header">
        <h3 class="box-title">Residence Expiry This Month</h3>
        </div>
        <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
        <tr>
            <th>Employee Name</th>
            <th>Residence Expiry Date</th>
            <th>Project</th>
        </tr>
        <?php 
            $basic="SELECT * FROM `employee` where res_exp like '$y-$m-%' order by res_exp asc ";
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                foreach ($result_basic as $row)
                {
                    echo "<tr>";
                    //   echo "<td>".$row['emp_number']."</td>";
                    echo "<td>".$row['emp_name']."</td>";
                    //    echo "<td>".$row['designation']."</td>";
                    $d=$row['res_exp'];
                    $t= strtotime($d);
                    $date=Date('d.m.Y',$t);
                    echo "<td>".$date."</td>";
                    echo "<td>".$row['pno']."</td>";
                    echo "</tr>";
                }
            }
        ?>
        </table>
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
        <div class="box-header">
        <h3 class="box-title">Gatepass Expiry This Month</h3>
        </div>
        <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
        <tr>
            <th>Employee Name</th>
            <th>Gate Pass Expiry Date</th>
            <th>Project</th>
        </tr>
        <?php 
            $basic="SELECT * FROM `employee` where gate_pass_exp like '$y-$m-%' order by gate_pass_exp asc";
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                foreach ($result_basic as $row)
                {
                    echo "<tr>";
                    // echo "<td>".$row['emp_number']."</td>";
                    echo "<td>".$row['emp_name']."</td>";
                    // echo "<td>".$row['designation']."</td>";
                    $d=$row['gate_pass_exp'];
                    $t= strtotime($d);
                    $date=Date('d.m.Y',$t);
                    echo "<td>".$date."</td>";
                    echo "<td>".$row['pno']."</td>";
                    echo "</tr>";
                }
            }
        ?>
        </table>
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
        <div class="box-header">
        <h3 class="box-title">Vehicle Expiry This Month</h3>
        </div>
        <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
        <tr>
            <th>Project</th>
            <th>Vehicle</th>
            <th>Plate No</th>
            <th>Dafter Expiry</th>
            <th>Gate Pass Expiry</th>
            <th>TPI Expiry</th>
        </tr>
        <?php 
            $basic="SELECT * FROM `EQUIPMENT` where gate_exp like '$y-$m-%' OR  dafter_exp like '$y-$m-%' or tpi_exp like '$y-$m-%'";
            try
            {
                $result_basic=$db_handle->runQuery($basic);
            }catch(Exception $e){}
            if(!empty($result_basic))
            {
                foreach ($result_basic as $row)
                {
                    echo "<tr>";
                    echo "<td>".$row['pno']."</td>";
                    echo "<td>".$row['vehicle']."</td>";
                    echo "<td>".$row['plate_no']."</td>";
                    $d=$row['dafter_exp'];
                    $t= strtotime($d);
                    $date_daf=Date('d.m.Y',$t);
                    echo "<td>".$date_daf."</td>";
                    $d=$row['gate_exp'];
                    $t= strtotime($d);
                    $date_gate=Date('d.m.Y',$t);
                    echo "<td>".$date_gate."</td>";
                    $d=$row['tpi_exp'];
                    $t= strtotime($d);
                    $date_tpi=Date('d.m.Y',$t);
                    echo "<td>".$date_tpi."</td>";
                    echo "</tr>";
                }
            }
            else {
                    echo "<tr><td>";
                    echo 'No Expiry this Month';
                    echo "</td></tr>";
            }
        ?>
        </table>
        </div>
        </div>
    </div>
    </div>
    </section>
        
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript" src="../../fusion/js/fusioncharts.js"></script>
<script type="text/javascript" src="../../fusion/js/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusion_man_wk = new FusionCharts({
    type: 'area2d',
    renderAt: 'chart-man-wk',
    width: '100%',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
        "caption": "Total Manpower Data Since Mobilization(<?php echo "SP 104";?>)",
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
        "data": <?php echo json_encode($man_arraywk);?>
    }
}
);
    fusion_man_wk.render(); 
    
    
    var fusion_man_nk = new FusionCharts({
    type: 'area2d',
    renderAt: 'chart-man-nk',
    width: '100%',
    height: '180',
    dataFormat: 'json',
    dataSource: {
        "chart": {
        "caption": "Total Manpower Data Since Mobilization(<?php echo "SP 105";?>)",
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
        "data": <?php echo json_encode($man_arraynk);?>
    }
}
);
    fusion_man_nk.render(); 
      
    var fusioncharts3 = new FusionCharts({
    type: 'bar2d',
    renderAt: 'chart-container3',
    "width": "100%",
    "height": '200',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Ongoing Work Order Status (North Kuwait)",
            "yAxisName": "% Completion",
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

        "data": [ {
            "label": "WO 26",
            "value": "67",
            "color":"#ff8693"
        }, {
            "label": "WO 28",
            "value": "93",
            "color":"#ff8693"
            
        }, {
            "label": "WO 31",
            "value": "40",
            "color":"#ff8693"
        }, {
            "label": "WO 40",
            "value": "8",
            "color":"#ff8693"
        }]
    }
}
);
    fusioncharts3.render();
    
     var fusionchartswk = new FusionCharts({
    type: 'bar2d',
    renderAt: 'chart-containerwk',
    "width": "100%",
    "height": '150',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Ongoing Work Order Status (West Kuwait)",
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

        "data": <?php echo json_encode($wk_array);?>
    }
}
);
    fusionchartswk.render();
    
    var fusionchartsnk = new FusionCharts({
    type: 'bar2d',
    renderAt: 'chart-containernk',
    "width": "100%",
    "height": '150',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Ongoing Work Order Status (North Kuwait)",
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

        "data": <?php echo json_encode($nk_array);?>
    }
}
);
    fusionchartsnk.render();
    
    var fusioncharts6 = new FusionCharts({
    type: 'bar2d',
    renderAt: 'chart-container6',
    "width": "100%",
    "height": '200',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": "Procurement",
            "yAxisName": "% Completion",
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

        "data": [ {
            "label": "PO/RSO Value",
            "value": "7000000",
            "color":"#ff8693"
        }, {
            "label": "L/C Issued",
            "value": "5000000",
            "color":"#ff8693"
            
        }, {
            "label": "L/C under process",
            "value": "2000000",
            "color":"#ff8693"
            
        }, {
            "label": "Payments Made",
            "value": "3000000",
            "color":"#ff8693"
        }, {
            "label": "Payments Pending",
            "value": "2000000",
            "color":"#ff8693"
        }]
    }
}
);
    fusioncharts6.render();
    var fusioncharts4 = new FusionCharts({
    type: 'angulargauge',
    renderAt: 'chart-container4',
    width: '300',
    height: '200',
    dataFormat: 'json',
    dataSource: {
        "chart": {
        "caption": "Total Work Order Value",
        "manageresize": "1",
        "origw": "400",
        "origh": "250",
        "managevalueoverlapping": "1",
        "autoaligntickvalues": "1",
        "bgcolor": "ffffff",
        "fillangle": "45",
        "upperlimit": "6577670.704",
        "lowerlimit": "0",
        "majortmnumber": "10",
        "majortmheight": "8",
        "showgaugeborder": "0",
        "gaugeouterradius": "140",
        "gaugeoriginx": "205",
        "gaugeoriginy": "206",
        "gaugeinnerradius": "2",
        "formatnumberscale": "1",
        "numberprefix": "$",
        "decmials": "2",
        "tickmarkdecimals": "1",
        "pivotradius": "17",
        "showpivotborder": "1",
        "pivotbordercolor": "000000",
        "pivotborderthickness": "5",
        "pivotfillmix": "FFFFFF,000000",
        "tickvaluedistance": "10",
        "showborder": "0"
        },
        "colorRange": {
            "color": [
            {
                "minvalue": "0",
                "maxvalue": "2575698",
                "code": "E48739"
            },
            {
                "minvalue": "2575698",
                "maxvalue": "6577670",
                "code": "B41527"
            }
        ]
        },
        "dials": {
            "dial": [{
                "value": "2575698",
                "borderalpha": "0",
                "bgcolor": "000000",
                "basewidth": "28",
                "topwidth": "1",
                "radius": "130"
            }]
        },
    "annotations": {
        "groups": [
            {
                "x": "205",
                "y": "207.5",
                "items": [
                    {
                        "type": "circle",
                        "x": "0",
                        "y": "2.5",
                        "radius": "150",
                        "startangle": "0",
                        "endangle": "180",
                        "fillpattern": "linear",
                        "fillasgradient": "1",
                        "fillcolor": "dddddd,666666",
                        "fillalpha": "100,100",
                        "fillratio": "50,50",
                        "fillangle": "0",
                        "showborder": "1",
                        "bordercolor": "444444",
                        "borderthickness": "2"
                    },
                    {
                        "type": "circle",
                        "x": "0",
                        "y": "0",
                        "radius": "145",
                        "startangle": "0",
                        "endangle": "180",
                        "fillpattern": "linear",
                        "fillasgradient": "1",
                        "fillcolor": "666666,ffffff",
                        "fillalpha": "100,100",
                        "fillratio": "50,50",
                        "fillangle": "0"
                    }
                ]
            }
        ]
    }
    }
}
);
    fusioncharts4.render();
    
     var fusioncharts = new FusionCharts({
    type: 'hlineargauge',
    renderAt: 'chart-container',
    width: '300',
    height: '90',
    dataFormat: 'json',
    dataSource: {
    "chart": {
        "manageresize": "1",
        "bgcolor": "FFFFFF",
        "bordercolor": "DCCEA1",
        "charttopmargin": "0",
        "chartbottommargin": "0",
        "upperlimit": "50",
        "lowerlimit": "0",
        "ticksbelowgauge": "1",
        "tickmarkdistance": "3",
        "valuepadding": "-2",
        "pointerradius": "5",
        "majortmcolor": "000000",
        "majortmnumber": "3",
        "minortmnumber": "4",
        "minortmheight": "4",
        "majortmheight": "8",
        "showshadow": "0",
        "pointerbgcolor": "FFFFFF",
        "pointerbordercolor": "000000",
        "gaugeborderthickness": "3",
        "basefontcolor": "000000",
        "gaugefillmix": "{color},{FFFFFF}",
        "gaugefillratio": "50,50",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "43",
                "code": "f3f718",
                "bordercolor": "f3f718",
                "label": "Existing"
            },
            {
                "minvalue": "43",
                "maxvalue": "48",
                "code": "B40001",
                "bordercolor": "B40001",
                "label": "idle"
            },
            {
                "minvalue": "48",
                "maxvalue": "50",
                "code": "5C8F0E",
                "label": "Proposed"
            }
        ]
    },
    "pointers": {
        "pointer": [
            {
                "value": "43"
            }
        ]
    }
}
}
);
    fusioncharts.render();
    
    
    var fusioncharts2 = new FusionCharts({
    type: 'hlineargauge',
    renderAt: 'chart-container2',
    width: '300',
    height: '90',
    dataFormat: 'json',
    dataSource: {
    "chart": {
        "manageresize": "1",
        "bgcolor": "FFFFFF",
        "bordercolor": "DCCEA1",
        "charttopmargin": "0",
        "chartbottommargin": "0",
        "upperlimit": "450",
        "lowerlimit": "0",
        "ticksbelowgauge": "1",
        "tickmarkdistance": "3",
        "valuepadding": "-2",
        "pointerradius": "5",
        "majortmcolor": "000000",
        "majortmnumber": "3",
        "minortmnumber": "4",
        "minortmheight": "4",
        "majortmheight": "8",
        "showshadow": "0",
        "pointerbgcolor": "FFFFFF",
        "pointerbordercolor": "000000",
        "gaugeborderthickness": "3",
        "basefontcolor": "000000",
        "gaugefillmix": "{color},{FFFFFF}",
        "gaugefillratio": "50,50",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "380",
                "code": "f3f718",
                "bordercolor": "f3f718",
                "label": "Existing"
            },
            {
                "minvalue": "380",
                "maxvalue": "415",
                "code": "B40001",
                "bordercolor": "B40001",
                "label": "idle"
            },
            {
                "minvalue": "415",
                "maxvalue": "450",
                "code": "5C8F0E",
                "label": "Proposed"
            }
        ]
    },
    "pointers": {
        "pointer": [
            {
                "value": "380"
            }
        ]
    }
}
}
);
    fusioncharts2.render();
    var fusioncharts5 = new FusionCharts({
    type: 'hlineargauge',
    renderAt: 'chart-container5',
    width: '300',
    height: '90',
    dataFormat: 'json',
    dataSource: {
    "chart": {
        "manageresize": "1",
        "bgcolor": "FFFFFF",
        "bordercolor": "DCCEA1",
        "charttopmargin": "0",
        "chartbottommargin": "0",
        "upperlimit": "35",
        "lowerlimit": "0",
        "ticksbelowgauge": "1",
        "tickmarkdistance": "3",
        "valuepadding": "-2",
        "pointerradius": "5",
        "majortmcolor": "000000",
        "majortmnumber": "3",
        "minortmnumber": "4",
        "minortmheight": "4",
        "majortmheight": "8",
        "showshadow": "0",
        "pointerbgcolor": "FFFFFF",
        "pointerbordercolor": "000000",
        "gaugeborderthickness": "3",
        "basefontcolor": "000000",
        "gaugefillmix": "{color},{FFFFFF}",
        "gaugefillratio": "50,50",
        "showborder": "0"
    },
    "colorrange": {
        "color": [
            {
                "minvalue": "0",
                "maxvalue": "25",
                "code": "f3f718",
                "bordercolor": "f3f718",
                "label": "Completed"
            },
            {
                "minvalue": "25",
                "maxvalue": "35",
                "code": "B40001",
                "bordercolor": "B40001",
                "label": ""
            }
        ]
    },
    "pointers": {
        "pointer": [
            {
                "value": "25"
            }
        ]
    }
}
}
);
    fusioncharts5.render();
    
});
</script>
<!-- ChartJS 1.0.1 -->
<script src="../../plugins/chartjs/Chart.min.js"></script>
<script>
 
 
</script>

</body>
</html>
