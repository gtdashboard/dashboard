<?php
    require '../db.php';
    $db_handle=new DBController();
    $m=date('m');
    $y=date('Y');
?>
<!DOCTYPE html>
<html>
<?php $title="Employee";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
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
                            $eno=$row['emp_number'];
                            echo "<tr>";
                           // echo "<td>".$row['emp_number']."</td>";
                            echo "<td><a href='emp_form.php?eno=$eno'>".$row['emp_name']."</a></td>";
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
<?php require '../scripts.php';?>
</body>
</html>
