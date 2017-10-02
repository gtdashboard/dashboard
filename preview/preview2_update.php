<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="form_action.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <title>Preview 2</title>
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    </head>
    <body>
        <div class="container">
            <div class="container" style="text-align: center;font-weight: bold;"><h1>Daily Progress Report</h1></div>
            <fieldset>
            <legend style="color:blue;font-weight:bold;text-align: center;">Work Activity</legend>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Work Order Number</th>
                    <th>Task Number</th>
                    <th>Foreman</th>
                    <th>AG</th>
                    <th>UG</th>
                    <th>Other Work</th>
                </tr>
            </thead>
        <?php
        require 'db.php';
        $db_handle=new DBController();
        if(isset($_GET['dt']))
        {
            $dt=$_GET['dt'];
        }
        $count=$_POST['cwo'];
        $inst=$_POST['instructions'];
        $acc=$_POST['accidents'];
        $rem=$_POST['remarks'];
        if(isset($_POST['id_site']))
        {
            $id=$_POST['id_site'];
        }
        $query="select * from site_info where date_site='$dt'";
        $result=$db_handle->runQuery($query);
        if(empty($result))
        {
            $query2="insert into site_info(instruction,accidents,remarks,date_site) values ('$inst','$acc','$rem','$dt')";
            echo $query2;
            $result2=$db_handle->runUpdate($query2);
            if($result2)
            {
               //echo 'inserted work_order';
            }
        }
        else
        {
            $query2="UPDATE `site_info` SET `instruction`='$inst',`accidents`='$acc',`remarks`='$rem' WHERE date_site='$dt'";
            echo $query2;
            $result2=$db_handle->runUpdate($query2);
            if($result2)
            {
               //echo 'updated';
            }

        }
        for($i=1;$i<=$count;$i++)
        {
            if((isset($_POST['wo'.$i]))&&(isset($_POST['tn'.$i]))&&(isset($_POST['rf'.$i]))&&(isset($_POST['ag'.$i]))&&(isset($_POST['ug'.$i]))&&(isset($_POST['ow'.$i])))
            {
                $wo=$_POST['wo'.$i];
                $tn=$_POST['tn'.$i];
                $rf=$_POST['rf'.$i];
                $ag=$_POST['ag'.$i];
                $ug=$_POST['ug'.$i];
                $ow=$_POST['ow'.$i];
                if(isset($_POST['id_wo'.$i]))
                {
                    $id=$_POST['id_wo'.$i];
                }
        ?>
            <tr>
                <td><?php echo $wo;?></td>
                <td><?php echo $tn;?></td>
                <td><?php echo $rf;?></td>
                <td><?php echo $ag;?></td>
                <td><?php echo $ug;?></td>
                <td><?php echo $ow;?></td>
            </tr>
        <?php
            $query="select * from work_order where work_order_no='$wo' and date_done='$dt'";
            echo "<br>$query<br>";
            $result=$db_handle->runQuery($query);
            if(empty($result))
            {
                $query="insert into work_order(work_order_no,task_name,foreman,ag,ug,other_works,date_done) values ('$wo','$tn','$rf',$ag,$ug,'$ow','$dt')";
                echo $query;
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                    //echo 'inserted';
                }
            }
            else
            {
                foreach($result as $row)
                {
                    $id=$row['id_work_order'];
                }
                $query="UPDATE `work_order` SET work_order_no='$wo',`task_name`='$tn',`foreman`='$rf',`ag`=$ag,`ug`=$ug,`other_works`='$ow' WHERE id_work_order=".$id;
                echo "<br>$query<br>";
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                   //echo 'updated work_order';
                }
             }
          }
        }
        ?>
        </table>
            </fieldset>
            <div class="container" style="border: 1px solid black;"><h4>Site Instruction/Changes in Issued Work Order:</h4><?php echo $inst;?></div>
            <div class="container" style="border: 1px solid black;"><h4>Safety Aspects,Accidents:</h4><?php echo $acc;?></div>
            <div class="container" style="border: 1px solid black;"><h4>Remarks Workshop:</h4><?php echo $rem;?></div>
            <a href="print_page2_with_date.php?dt=<?php echo $dt;?>" class="btn btn-primary" style="width:100%;margin-bottom: 2%;margin-top: 2%;">Print</a>
        
        </div>
    </body>
</html>
