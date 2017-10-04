<?php

    require '../db.php';
    session_start();
    $db_handle=new DBController();
    $wo='';
    $pno='';
    if(isset($_REQUEST['wo']))
    {
        $wo=$_REQUEST['wo'];
        $_SESSION['wo']=$wo;
    }
    if(isset($_REQUEST['pno']))
    {
        $pno=$_REQUEST['pno'];
        $_SESSION['pno']=$pno;
    }
    $basic="SELECT * FROM `boq_item`,boq WHERE boq_item.wo_no='$wo' AND (boq.serial_boq=boq_item.item_id) and boq.pno='$pno'";
    $result_basic=$db_handle->runQuery($basic);
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
<?php require '../scripts.php';?>
</body>
</html>
