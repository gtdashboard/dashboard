<?php

    require '../db.php';

    $db_handle=new DBController();
    //$p=$_REQUEST['p'];
    $tasks="select * from tasks";
    $result_tasks=$db_handle->runQuery($tasks);
?>
<!DOCTYPE html>
<html>
<?php $title="Task Details";?>
<?php require '../head.php'?>
<div class="wrapper">

  <?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
  <div class="container">
    <section class="content">
    <div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Tasks</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <tr>
            <th>#</th>
            <th>Task Name</th>
            <th>Action By</th>
            <th>Deadline</th>
        </tr>
        <?php
            if(!empty($result_tasks))
            {
                $i=0;
                foreach($result_tasks as $row)
                {
                    $i++;
                    $tname=$row['task_name'];
                    $action=$row['action_by'];
                    $deadline=$row['deadline'];
                    if(strcmp($deadline, '0000-00-00')==0)
                    {
                        $deadline="-";
                       
                    }
                    else {
                        $deadline= strtotime($deadline);
                        $deadline= date('d-M-y', $deadline);
                    }
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$tname</td>";
                    echo "<td>$action</td>";
                    echo "<td>$deadline</td>";
                    echo "</tr>";
                }
        ?>
       </table>
        </div>
        </div>
    </div>
        <?php
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
