<?php

    require '../db.php';
    session_start();
    $db_handle=new DBController();
    $serial='1.1.8';
    if(isset($_REQUEST['serial']))
    {
        $serial=$_REQUEST['serial'];
    }
    $pno='104';
    if(isset($_REQUEST['pno']))
    {
        $pno=$_REQUEST['pno'];
    }
    $basic="SELECT * FROM `boq_item`,boq WHERE boq_item.item_id='$serial' AND (boq.serial_boq=boq_item.item_id) and boq.pno='$pno'";
    $result_basic=$db_handle->runQuery($basic);
    //echo $basic;
?>
<!DOCTYPE html>
<html>
<?php $title="WO Materials";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
  <div class="container">
    <section class="content">
    <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Material Info (<?php echo $serial;?>)</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered" id="table4">
                <tr>
                <th>Item Number</th>
                <th>Material Name</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Available</th>
                <th>Used</th>
                </tr>
                <tr>
                <?php
                if(!empty($result_basic))
                {
                    $i=0;
                    $total_wo_sum=0;
                    $total_rem_sum=0;
                    $total_wo=0;
                    $total_rem=0;
                    $sum=0;
                    foreach($result_basic as $row)
                    {
                        $s=$row['serial_boq'];
                        $item=$row['item'];
                        $sp=$row['sp'];
                        $est=$row['est_qty'];
                        $unit=$row['unit'];
                        $arab=$row['arabi_qty'];
                        //echo "$sum<br>";
                        $sum+=$arab;
                        
                    }
                    echo "<td>$s</td>";
                    echo "<td>$item</td>";
                    echo "<td>$unit</td>";
                    echo "<td>$sp</td>";
                    echo "<td>$est</td>";
                    echo "<td>$sum</td>";
                }
                ?>
                </tr>
            </table>
        </div>
        </div>
        </div>
    </div>
    <div class="row" style="align-content: center;">
    <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Work Order Materials (<?php echo $serial;?>)</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <tr>
            <th>#</th>
            <th>Work Order</th>
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
                $total_wo=0;
                $total_rem=0;
                foreach($result_basic as $row)
                {
                    $i++;
                    $s=$row['wo_no'];
                    $item=$row['item'];
                    $sp=$row['sp'];
                    $rem=$row['rem_qty'];
                    $arab=$row['arabi_qty'];
                    $koc=$row['koc_qty'];
                    if($koc==0)
                    {
                        $total_wo=$sp*$arab;
                        $total_wo_sum+=$total_wo;
                        $total_rem=$sp*$rem;
                        $total_rem_sum+=$total_rem;
                    }
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$s</td>";
                    echo "<td>$arab</td>";
                    echo "<td>$koc</td>";
                    echo "<td>$rem</td>";
                    echo "<td>$total_wo</td>";
                    echo "<td>$total_rem</td>";
                    echo "</tr>";
                    
                    
                }
                $ts=number_format($total_wo_sum,3);
                $tr=number_format($total_rem_sum,3);
                echo"<tfoot><tr>"
                    ."<th colspan='5' align='center'>Total (KWD)</th>"
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
<?php require '../scripts.php';?>
</body>
</html>
