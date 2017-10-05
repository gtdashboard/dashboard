<?php

    require '../db.php';

    $db_handle=new DBController();
    //$p=$_REQUEST['p'];
    $afe="select tracking_id,pno,afe_amount,expense,mpr_details from afe";
    $result_afe=$db_handle->runQuery($afe);
    $afp="select tracking_id,pno,amount,expense,mpr_details from afp";
    $result_afp=$db_handle->runQuery($afp);
    
    //$p=105;
   
?>
<!DOCTYPE html>
<html>
<?php $title="WO Details";?>
<?php require '../head.php'?>
<div class="wrapper">

  <?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
  <div class="container">
    <section class="content">
    <div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">AFE</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <tr>
            <th>#</th>
            <th>AFE Tracking ID </th>
            <th>Expense</th>
            <th>AFE Amount</th>
            <th>MPR</th>
            <th>Project</th>
        </tr>
        <?php
        
            if(!empty($result_afe))
            {
                $i=0;
                foreach($result_afe as $row)
                {
                    $i++;
                    $pno=$row['pno'];
                    $expense=$row['expense'];
                    $mpr=$row['mpr_details'];
                    $amount=$row['afe_amount'];
                    $track=$row['tracking_id'];
                   
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td><a href=''>$track</a></td>";
                    echo "<td>$expense</td>";
                    echo "<td>KD $amount</td>";
                    echo "<td>$mpr</td>";
                    echo "<td>$pno</td>";
                    
                }
            }
        ?>
       </table>
        </div>
        </div>
    </div>
        <div class="col-md-6 col-xs-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">AFP</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <tr>
            <th>#</th>
            <th>AFP Tracking ID </th>
            <th>Expense</th>
            <th>AFP Amount</th>
            <th>MPR</th>
            <th>Project</th>
        </tr>
        <?php
        
            if(!empty($result_afp))
            {
                $i=0;
                foreach($result_afp as $row)
                {
                    $i++;
                    $pno=$row['pno'];
                    $expense=$row['expense'];
                    $mpr=$row['mpr_details'];
                    $amount=$row['amount'];
                    $track=$row['tracking_id'];
                   
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td><a href=''>$track</a></td>";
                    echo "<td>$expense</td>";
                    echo "<td>KD $amount</td>";
                    echo "<td>$mpr</td>";
                    echo "<td>$pno</td>";
                    
                }
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
<?php require '../scripts.php';?>
</body>
</html>
