<?php
    require 'db.php';
    require 'datediff.php';
    $db_handle=new DBController();
    $m=date('m');
    $y=date('Y');
    $today=Date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" sizes="16x16" href="arabi_logo_header.png">
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
  
  <style>
/* Tooltip container */
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
 
    /* Position the tooltip text - see examples below! */
    position: absolute;
    z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>
  
  <script type="text/javascript" src="../../fusion/js/fusioncharts.js"></script>
  <script type="text/javascript" src="../../fusion/js/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-purple  layout-top-nav">
<div class="wrapper">

 <?php require 'header_main.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container" style="width:100%">
    <!-- Content Header (Page header) -->
    <section class="content-header">
         <!-- ======================PROJECT INFO=============================== --> 
        <div class="row">
        <?php
            $query_basic="SELECT * FROM general";
            $result_basic=$db_handle->runQuery($query_basic);
            foreach ($result_basic as $row) 
            {
               $elapse= elapse($row['commence_date'], $row['finish_date']) ;
               $elapse_days= elapse_days($row['commence_date'], $row['finish_date']) ;
               $pno=$row['pno'];
               $query_consumed="select sum(value) as total_inv from wo_numbers,wo_status where pno='" . $row['pno'] . 
               "' and wo_numbers.id_wo=wo_status.id_wo and status=3";
               $result_consumed=$db_handle->runQuery($query_consumed);
               foreach ($result_consumed as $row_consumed) 
                {
                   $consumed_percentage=$row_consumed['total_inv']/$row['contract_value']*100;
                   $consumed_amt = $row_consumed['total_inv'];
                }
        ?>
        <a href="project_info.php?pno=<?php echo $pno;?>">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-gray"  title="Work orders Invoiced: <?php echo number_format($consumed_amt);?>">
            <span class="info-box-icon"><i class="fa fa-usd"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Contract Value(SP <?php echo $row['pno'];?>)</span>
            <span class="info-box-number"><?php echo number_format($row['contract_value']);?></span>

            <div class="progress">
            <div class="progress-bar" style="width: <?php echo number_format($consumed_percentage);?>%"></div>
            </div>
            <span class="progress-description">
	    <?php echo number_format($consumed_percentage);?>% Value Invoiced 
            </span>
            </div>
        </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-purple" title="Days Elapsed: <?php echo number_format($elapse_days);?>">
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
          </div>
        </div>
        </a>
        <?php }?>
    </div>
    
    <!-- ======================WORK ORDER CHARTS=============================== --> 
    <div class="row">
    <?php
            $query_basic="SELECT * FROM general";
            $result_basic=$db_handle->runQuery($query_basic);
            foreach ($result_basic as $row_project) 
            {
                $pno=$row_project['pno'];
              
                $query_wo="SELECT distinct(wo_numbers.work_order_no) as work_order_no,wo_status.id_wo as id_wo,wo_numbers.start as start_date,wo_numbers.end as end_date  "
                            . "FROM wo_status,wo_numbers "
                            . "WHERE STATUS =1 AND wo_status.id_wo NOT IN (SELECT id_wo FROM wo_status WHERE STATUS >1) and wo_numbers.pno=$pno and wo_status.id_wo=wo_numbers.id_wo ORDER BY work_order_no";

    
                $result_wo=$db_handle->runQuery($query_wo);
                if(!empty($wo_array))
                {
                    unset($wo_array);
                }
                if(!empty($wo_label_array))
                {
                    unset($wo_label_array);
                }
                if(!empty($wo_time_array))
                {
                    unset($wo_time_array);
                }
                $wo_array[]=array();
                $wo_label_array[]=array();
                $wo_time_array[]=array();

                if(!empty($result_wo))
                {
                    foreach ($result_wo as $row)
                    {
                        $wo1=$row['work_order_no'];
                        $wo_start_date= $row['start_date'];
                        $wo_end_date = $row['end_date'];
                        $id_wo=$row['id_wo'];
                        $wo= substr($wo1,13);
                        $wo="WO $wo";
                        $total_query="SELECT "
                                . "(SELECT SUM( progress_points ) FROM wo_progress WHERE wo_id =$id_wo)"
                                . "/"
                                . "( SELECT SUM( points )"
                                . " FROM wo_weightage "
                                . "WHERE id IN(SELECT `activity_id` FROM `wo_progress` WHERE `wo_id` =$id_wo)) *100 as total";
                        $total_result=$db_handle->runQuery($total_query);
                        foreach ($total_result as $row)
                        {
                           $total= number_format($row['total'], 2);
                        }
                        $time_percentage = number_format(((time() - strtotime($wo_start_date))/(24*60*60))/ ((strtotime($wo_end_date)-strtotime($wo_start_date))/(24*60*60))*100);

                        $wo_label_array[] = array('label' => "$wo",);
                        $wo_array[] = array('value' => "$total", "link" => "work_orders/wo_search.php?wno=$wo1");
                        $wo_time_array[] = array('value' => "$time_percentage", "link" => "work_orders/wo_search.php?wno=$wo1");


                    }

            }
    ?>
    <div class="col-md-6" style="text-align: center;">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Work Orders (<?php echo $row_project['project_location'];?>)</h3>
        </div>
        <div class="box-body" >
        <div id="wo_chart<?php echo $pno;?>" >Work Orders will load here!</div>
        <script type="text/javascript">
        FusionCharts.ready(function(){
            console.log("fusion here for wo");
            var fusionchartswo = new FusionCharts({
                type: 'mscolumn3d',
                renderAt: 'wo_chart<?php echo $pno;?>',
                "width": "100%",
                "height": '250',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Ongoing Work Order Status (SP <?php echo $pno;?> )",
                        "yAxisName": "% Completion",
                        "numbersuffix": "%",
                        "plotFillAlpha": "80",
                        "paletteColors": "#0075c2,#605ca8",
                        "baseFontColor": "#333333",
                        "baseFont": "Helvetica Neue,Arial",
                        "captionFontSize": "14",
                        "subcaptionFontSize": "14",
                        "subcaptionFontBold": "0",
                        "showBorder": "0",
                        "bgColor": "#ffffff",
                        "showShadow": "1",
                        "canvasBgColor": "#ffffff",
                        "canvasBorderAlpha": "0",
                        "divlineAlpha": "100",
                        "divlineColor": "#999999",
                        "divlineThickness": "1",
                        "yAxisMaxValue": "110",
                        "divLineIsDashed": "1",
                        "divLineDashLen": "1",
                        "divLineGapLen": "1",
                        "usePlotGradientColor": "0",
                        "showplotborder": "0",
                        "valueFontColor": "#000000",
                        "showHoverEffect": "1",
                        "showvalues": "0",
                        "rotateValues": "1",
                        "showXAxisLine": "1",
                        "xAxisLineThickness": "1",
                        "xAxisLineColor": "#999999",
                        "showAlternateHGridColor": "0",
                        "legendBgAlpha": "0",
                        "legendBorderAlpha": "0",
                        "legendShadow": "0",
                        "legendItemFontSize": "10",
                        "legendItemFontColor": "#666666"
                },
                "categories": [
                    {
                        "category": <?php echo json_encode($wo_label_array);?>
                    }
                ],
                "dataset": [
                    {
                        "seriesname": "Progress Percentage",
                        "data": <?php echo json_encode($wo_array);?>
                    },
                    {
                        "seriesname": "Time Percentage",
                        "data": <?php echo json_encode($wo_time_array);?>
                    }
                ],

                "trendlines": [
                    {
                        "line": [
                            {
                                "startvalue": "100",
                                "color": "#0075c2",
                                "displayvalue": "100%",
                                "valueOnRight": "1",
                                "thickness": "1",
                                "showBelow": "1",
                                "tooltext": "100%"
                            }
                        ]
                    }
                ]






                }
            }
            );
        fusionchartswo.render();
        });
        </script>
        </div>
        </div>
    </div>
    <?php }?>
    </div>
    
    <!-- ======================WORK ORDER VALUE VS INVOICED GAUGE=============================== --> 
    <div class="row">
    <?php
        $query_basic="SELECT * FROM general";
        $result_basic=$db_handle->runQuery($query_basic);
        foreach ($result_basic as $row) {
        $pno=$row['pno'];
        $wo_amount_query="select sum(value) as total_am from wo_numbers where pno=$pno";
        $result_amount=$db_handle->runQuery($wo_amount_query);
        if(!empty($result_amount))
        {
            foreach ($result_amount as $row_amount)
            {
                $total_am=$row_amount['total_am'];
                $total_am = floor($total_am);
            }
        }
       
        $wo_inv_query="select sum(value) as total_inv from wo_numbers,wo_status where pno=$pno and wo_numbers.id_wo=wo_status.id_wo and status=3";
        $result_inv=$db_handle->runQuery($wo_inv_query);
        if(!empty($result_inv))
        {
            foreach ($result_inv as $row_inv)
            {
                $total_inv=$row_inv['total_inv'];
            }
        }
        
    ?>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Total Work Order Value(SP <?php echo $pno;?>)</h3>
        </div>
            <div class="box-body" style="text-align:center;" >
        <div id="chart<?php echo $pno;?>">FusionCharts <?php echo $pno;?> will load here!</div>
        </div>
        </div>
    <script type="text/javascript">
        FusionCharts.ready(function(){
            console.log("fusion here");
            var fusionchartsxx = new FusionCharts({
            type: 'angulargauge',
            renderAt: 'chart<?php echo $pno;?>',
            width: '450',
            height: '250',
            dataFormat: 'json',
            dataSource: {
                "chart": {
                "caption": "",
                "manageresize": "1",
                "origw": "400",
                "origh": "250",
                "managevalueoverlapping": "1",
                "autoaligntickvalues": "1",
                "bgcolor": "ffffff",
                "fillangle": "45",
                "upperlimit": "<?php echo $total_am;?>",
                "lowerlimit": "0",
                "majortmnumber": "10",
                "majortmheight": "8",
                "showgaugeborder": "0",
                "gaugeouterradius": "140",
                "gaugeoriginx": "205",
                "gaugeoriginy": "206",
                "gaugeinnerradius": "2",
                "formatnumberscale": "1",
                "numberprefix": "KD ",
                "decmials": "2",
                "tickmarkdecimals": "0",
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
                        "maxvalue": "<?php echo $total_inv;?>",
                        "code": "605ca8"
                    },
                    {
                        "minvalue": "<?php echo $total_inv;?>",
                        "maxvalue": "<?php echo $total_am;?>",
                        "code": "d2d6de"
                    }
                ]
                },
                "dials": {
                    "dial": [{
                        "value": "<?php echo $total_inv;?>",
                        "borderalpha": "0",
                        "bgcolor": "000000",
                        "basewidth": "28",
                        "topwidth": "1",
                        "radius": "130"
                    }]
                },"annotations": {
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
    fusionchartsxx.render();
    });
    </script>
    </div>
    <?php }?>
    </div>

    
    <!-- ======================THREE STATUS CHARTS FOR EQUIPMENT,MANPOWER AND WORK ORDER=============================== --> 

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
    
    
    <!-- ======================PROCUREMENT CHARTS=============================== --> 
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
    
    <!-- ======================RESIDENCY,EQUIPMENT,GATEPASS EXPIRY TABLE=============================== --> 
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
<script type="text/javascript">
  FusionCharts.ready(function(){
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
            "color":"#605ca8"
        }, {
            "label": "L/C Issued",
            "value": "5000000",
            "color":"#605ca8"
            
        }, {
            "label": "L/C under process",
            "value": "2000000",
            "color":"#605ca8"
            
        }, {
            "label": "Payments Made",
            "value": "3000000",
            "color":"#605ca8"
        }, {
            "label": "Payments Pending",
            "value": "2000000",
            "color":"#605ca8"
        }]
    }
}
);
    fusioncharts6.render();
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
                "code": "605ca8",
                "bordercolor": "605ca8",
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
                "code": "605ca8",
                "bordercolor": "605ca8",
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
                "code": "605ca8",
                "bordercolor": "605ca8",
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
