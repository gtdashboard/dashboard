<?php

    require '../db.php';

    $db_handle=new DBController();
    //$p=$_REQUEST['p'];
    $general="select pno,project_location from general";
    $result_general=$db_handle->runQuery($general);
    
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
        <?php
        foreach($result_general as $row_gen)
        {
           // print_r($result_general);
            $pno=$row_gen['pno'];
            $location=$row_gen['project_location'];
            $basic="SELECT * FROM wo_numbers where pno=$pno ORDER BY `work_order_no` DESC";
            //echo $basic;
            $result_basic=$db_handle->runQuery($basic);
                
        ?>
        
    <div class="col-md-6 col-xs-12">
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
                    if(strcmp($row['work_order_no'],'')==0)
                    {
                        continue;
                    }
                    $pno=$row['pno'];
                    $wo_id=$row['id_wo'];
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
                    echo "<td><a href='wo_search.php?wno=$wo_no'>$wo_no</a></td>";
                    echo "<td>$wo_val</td>";
                    echo "<td>$st</td>";
                    echo "<td>$et</td>";
                    $stat="select status from wo_status where wo_status.id_wo=$wo_id and date_inserted=(select max(date_inserted) from  wo_status where wo_status.id_wo=$wo_id)";
                    $result_stat=$db_handle->runQuery($stat);
                    if(empty($result_stat))
                    {
                        echo "<td>Issued</td>";
                    }
                    else {
                        foreach($result_stat as $row_stat)
                        {
                            $status=$row_stat['status'];
                        }
                        if($status==0)
                        {
                            echo "<td><span class='label label-primary'>Issued</span></td>";
                        }
                        else if($status==1)
                        {
                            echo "<td><span class='label label-warning'>Commenced</span></td>";
                        }
                        else if($status==3)
                        {
                            echo "<td><span class='label label-success'>Invoiced</span></td>";
                        }
                        else if($status==2)
                        {
                            echo "<td><span class='label label-info'>Handed Over</span></td>";
                        }
                        else if($status==4)
                        {
                            echo "<td>On Hold</td>";
                        }
                        else if($status==5)
                        {
                            echo "<td><span class='label label-danger'>Cancelled</span></td>";
                        }
                    }

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
<?php require '../scripts.php';?>
</body>
</html>
