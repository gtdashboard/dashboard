<?php

    require 'db.php';

    $db_handle=new DBController();
    //$p=$_REQUEST['p'];
    $general="select pno,project_location from general";
    $result_general=$db_handle->runQuery($general);
    
    //$p=105;
   
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <?php require 'header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
  <div class="container">
    <section class="content">
    <div class="row">
        <?php
        foreach($result_general as $row_gen)
        {
           // print_r($result_general);
            $pno=$row_gen['pno'];
            $location=$row_gen['project_location'];
            $basic="SELECT * FROM wo_numbers where pno=$pno";
            //echo $basic;
            $result_basic=$db_handle->runQuery($basic);
                
        ?>
        
    <div class="col-md-6">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title"><?php echo "$location (SP $pno)";?></h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <tr>
            <th>#</th>
            <th>WO Number</th>
            <th>WO Value</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
        <?php
            if(!empty($result_basic))
            {
                $i=0;
                foreach($result_basic as $row)
                {
                    $i++;
                    $pno=$row['pno'];
                    $wo_no=$row['work_order_no'];
                    $wo_val=$row['value'];
                    $wo_val=number_format($wo_val,3);
                    $st=$row['start'];
                    if(strcmp($st, '0000-00-00')==0)
                    {
                        $st="-";
                       
                    }
                    else {
                        $st= strtotime($st);
                        $st= date('d-M-y', $st);
                    }
                    $et=$row['end'];
                    if(strcmp($et, '0000-00-00')==0)
                    {
                        $et="-";
                       
                    }
                    else {
                        $et= strtotime($et);
                        $et= date('d-M-y', $et);
                    }
                    $issue=$row['issue'];
                    if(strcmp($issue, '0000-00-00')==0)
                    {
                        $issue="-";
                       
                    }
                    else {
                        $issue= strtotime($issue);
                        $issue= date('d-M-y', $issue);
                    }
                    
                    //$status=$row['status'];
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$wo_no</td>";
                    echo "<td>$wo_val</td>";
                    echo "<td>$st</td>";
                    echo "<td>$et</td>";
                    echo "<td>Issued</td>";
                   /* if($status==0)
                    {
                        echo "<td>Issued</td>";
                    }
                    else if($status==1)
                    {
                        echo "<td>Commenced</td>";
                    }
                    else if($status==2)
                    {
                        echo "<td>Invoiced</td>";
                    }
                    else if($status==3)
                    {
                        echo "<td>Completed</td>";
                    }
                    else if($status==4)
                    {
                        echo "<td>On Hold</td>";
                    }
                    else if($status==5)
                    {
                        echo "<td>Cancelled</td>";
                    }*/
                    echo "</tr>";
                    
                    
                }
        ?>
       </table>
        </div>
        </div>
    </div>
        <?php
            }
        }
        ?>
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
<script>
</script>
<script>
</script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>
</html>
