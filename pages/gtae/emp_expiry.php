<?php
    require 'db.php';
    $db_handle=new DBController();
    $m=date('m');
    $y=date('Y');
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

   <?php require 'header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
        <br/>
        <br/>
        <h3 style="width: 100%;text-align: center;">Employee Status</h3>
  <div class="row">
        <div class="col-xs-6">
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
                            $eno=$row['emp_number'];
                            echo "<tr>";
                         //   echo "<td>".$row['emp_number']."</td>";
                            echo "<td><a href='emp_form.php?eno=$eno'>".$row['emp_name']."</a></td>";
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

        <div class="col-xs-6">
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
</body>
</html>
