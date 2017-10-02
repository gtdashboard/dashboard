<?php
    require 'db.php';
    $db_handle=new DBController();
    $m=date('m');
    $y=date('Y');
    $query_wk="SELECT `work_order_no` FROM `work_order` WHERE date_done=(SELECT max(date_done) from work_order) and pno=104";
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
    $query_nk="SELECT `work_order_no` FROM `work_order` WHERE date_done=(SELECT max(date_done) from work_order) and pno=105";
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
            <a href="top_home.php" class="navbar-brand"><b>GTAE</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Finance<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="afe_form.php">New AFE</a></li>
                <li class="divider"></li>
                <li><a href="afp_form.php">New AFP</a></li>
                <li class="divider"></li>
                <li><a href="afe_update.php">Track AFE</a></li>
                <li class="divider"></li>
                <li><a href="afp_update.php">Track AFP</a></li>
                <li class="divider"></li>
                <li><a href="#">View Issued Payments</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daily Report<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Enter New Report</a></li>
                <li class="divider"></li>
                <li><a href="daily_status.php">View Daily Status</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employee<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="emp_form.php">Enter New Employee</a></li>
                <li class="divider"></li>
                <li><a href="emp_form.php">Update Renewed Status</a></li>
                <li class="divider"></li>
                <li><a href="emp_expiry.php">View Expiry Status</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Equipment<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Enter New Equipment</a></li>
                <li class="divider"></li>
                <li><a href="#">Update Renewed Status</a></li>
                 <li class="divider"></li>
                 <li><a href="#" style="">View Expiry Status</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Material<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Material Status</a></li>
                <li class="divider"></li>
                <li><a href="#">Edit Material Status</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <!-- The message -->
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li><!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>
              </ul>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
      <div class="container" style="width:100%">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
         <!-- =========================================================== -->   
          <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Contract Value</span>
              <span class="info-box-number">53,444,444</span>

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
              <span class="info-box-text">Project Duration</span>
              <span class="info-box-number">60 Months</span>

              <div class="progress">
                <div class="progress-bar" style="width: 8%"></div>
              </div>
                  <span class="progress-description">
                    8% Time Elapsed
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Work Order Issued</span>
              <span class="info-box-number">35</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Work Order Completed</span>
              <span class="info-box-number">25</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
    <div class="col-md-4" style="text-align: center;">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Equipment Status</h3>
            </div>
              <div class="box-body" style="text-align: center;padding: 10%">
                <div id="chart-container" >FusionCharts XT will load here!</div>
            
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
    </div>
    <div class="col-md-4" style="text-align: center;">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Manpower Status</h3>
            </div>
              <div class="box-body" style="text-align: center;padding: 10%">
                <div id="chart-container2" >FusionCharts XT will load here!</div>
            
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
    </div>
        
        <!-- /.col -->
        
        <div class="col-md-4" style="text-align: center;">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Work Order Status</h3>
            </div>
              <div class="box-body" style="text-align: center;padding: 10%">
                <div id="chart-container5" >FusionCharts XT will load here!</div>
            
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
      <div class="row">
    <div class="col-md-6" style="text-align: center;">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Work Orders NK</h3>
            </div>
              <div class="box-body" style="text-align: center;padding: 10%">
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
              <div class="box-body" style="text-align: center;padding: 10%">
                <div id="chart-containerwk" >FusionCharts XT will load here!</div>
            
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
    </div>
    </div>
    <div class="row">
    <div class="col-md-4" style="text-align: center;">
          <!-- Line chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Work Order Values Completed</h3>
            </div>
              <div class="box-body" style="text-align: center;padding: 10px">
                <div id="chart-container4" >FusionCharts XT will load here!</div>
            
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
    </div>
        <div class="col-md-8">
          <!-- interactive chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Work Order Completion</h3>
            </div>
            <div class="box-body" style="align-content: center;">
             <div id="chart-container3">FusionCharts XT will load here!</div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
         <div class="col-md-12">
          <!-- interactive chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Procurement</h3>
            </div>
            <div class="box-body" style="align-content: center;">
             <div id="chart-container6">FusionCharts XT will load here!</div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div> 
      </div>
      <div class="row">
        <div class="col-xs-4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Residence Expiry This Month</h3>
            </div>
            <!-- /.box-header -->
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-xs-4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Gatepass Expiry This Month</h3>

             
            </div>
            <!-- /.box-header -->
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-xs-4">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Vehicle Expiry This Month</h3>

              
            </div>
            <!-- /.box-header -->
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
    
      
      <!-- /.row -->
    </section>
        
        
    </div>
    <!-- /.container -->
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
    "height": '200',
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
    "height": '200',
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

 var pieChartCanvas = $("#myChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 35,
        color: "#f56954",
        highlight: "#f56954",
        label: "Idle"
      },
      {
        value: 415,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "Available"
      },
      {
        value: 450,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "Alloted"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Pie(PieData);
 //var skillsChart = new Chart(context).Pie(pieData);
</script>

</body>
</html>
