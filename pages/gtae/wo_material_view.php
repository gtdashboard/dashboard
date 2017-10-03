<?php

    require 'db.php';

    $db_handle=new DBController();
    $wo=$_REQUEST['wo'];
    $pno=$_REQUEST['pno'];
    $basic="SELECT * FROM `boq_item`,boq WHERE boq_item.wo_no='$wo' AND (boq.serial_boq=boq_item.item_id) and boq.pno='$pno'";
    //echo $basic;
    $result_basic=$db_handle->runQuery($basic);
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

  <?php require 'header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
  <div class="container">
    <section class="content">
    <div class="row" style="align-content: center;">
    <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Work Order Materials (<?php echo $wo;?>)</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <tr>
            <th>#</th>
            <th>Serial Number</th>
            <th>Item Name</th>
            <th style="width: 40px">SP</th>
            <th>Arabi Qty</th>
            <th>KOC Qty</th>
            <th>Rem Qty</th>
            <th>WO Amount</th>
            <th>Rem Amount</th>
        </tr>
        <?php
            if(!empty($result_basic))
            {
                $i=0;
                $total_wo_sum=0;
                $total_rem_sum=0;
                foreach($result_basic as $row)
                {
                    $i++;
                    $s=$row['serial_boq'];
                    $item=$row['item'];
                    $sp=$row['sp'];
                    $rem=$row['rem_qty'];
                    $arab=$row['arabi_qty'];
                    $koc=$row['koc_qty'];
                    $total_wo=$sp*$arab;
                    $total_wo_sum+=$total_wo;
                    $total_rem=$sp*$rem;
                    $total_rem_sum+=$total_rem;
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$s</td>";
                    echo "<td>$item</td>";
                    echo "<td>$sp</td>";
                    echo "<td>$arab</td>";
                    echo "<td>$koc</td>";
                    echo "<td>$rem</td>";
                    echo "<td>$total_wo</td>";
                    echo "<td>$total_rem</td>";
                    echo "</tr>";
                    
                    
                }
                $ts=number_format($total_wo_sum);
                $tr=number_format($total_rem_sum);
                echo"<tfoot><tr>"
                    ."<th colspan='7' align='center'>Total (KWD)</th>"
                    ."<th>$ts</th>"
                    ."<th>$tr</th>"
                    ."</tr>"
                    ."</tfoot>";

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
<script>
</script>
<script>
</script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>
</html>
