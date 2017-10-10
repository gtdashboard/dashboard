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
    <?php
    $pno=105;
    if(isset($_REQUEST['pno']))
    {
        $pno=$_REQUEST['pno'];
    }
    $query_basic="SELECT * FROM general where pno=$pno";
    $result_basic=$db_handle->runQuery($query_basic);
    foreach ($result_basic as $row) 
    {
        $client=$row['client'];
        $title=$row['project'];
        $loc=$row['project_location'];
        $contract=$row['contract_no'];
        $val=$row['contract_value'];
        $period=$row['contract_period'];
        $cgc=$row['cgc_scope'];
        $signed=$row['contract_signed'];
        $signed= strtotime($signed);
        $signed=date('d M Y',$signed);
        $mob=$row['mob_period'];
        $commence=$row['commence_date'];
        $commence= strtotime($commence);
        $commence=date('d M Y',$commence);
        $finish=$row['finish_date'];
        $finish= strtotime($finish);
        $finish=date('d M Y',$finish);
    }
        
    ?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container" style="width:100%">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row" style="align-content: center;">
        <div class="col-md-1"></div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Project Info</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Project Title</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $title;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Contract Number</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $contract;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Contract Value</label>
                    </div>
                    <div class="col-xs-8">
                        <label>KD <?php echo number_format($val);?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Internal Number</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo "SP $pno";?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Client</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $client;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Project Location</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $loc;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Contract Period</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $period;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Contract Signed</label>
                    </div>
                    <div class="col-xs-8">
                        <label><?php echo $signed;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Commence Date</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $commence;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Finish Date</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $finish;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">CGC Scope</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $cgc;?></label>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-4"> 
                    <label for="">Mob Period</label>
                    </div>
                    <div class="col-xs-8">
                    <label><?php echo $mob;?> Months</label>
                    </div>
                </div>
                <br/>
            </div>
         <div class="col-md-1"></div>
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

</body>
</html>
