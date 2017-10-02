<?php
            require '../db.php';
            if(isset($_GET['dt']))
            {
                $dt=$_GET['dt'];
            }
            else 
            {
                header("Location:view.php");
            }
            if(isset($_GET['p']))
            {
                $p=$_GET['p'];
            }
            else 
            {
                session_start();
                $p=$_SESSION['project'];
            }
            $db_handle=new DBController($p);
            $basic="select * from general where pno=$p";
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                foreach($result_basic as $row)
                {
                    $project_name=$row['project'];
                    $contract=$row['contract_no'];
                }
            }
            $query="select * from work_order where date_done='$dt' and pno=$p";
            $result=$db_handle->runQuery($query);
            if(empty($result))
            {
               header("Location:view.php");
            }
            $r=date("w", strtotime($dt));
            $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
            function work_title($dt,$contract,$p)
            {
                $work_title="FLN/$contract/";
                $db_handle=new DBController();
                $query_wo="select count(*) as count from wo_numbers,work_order where DATE(date_done) = '$dt' and wo_no=id_wo and wo_numbers.pno=work_order.pno and work_order.pno=$p";
                
                $result_wo=$db_handle->runQuery($query_wo);
                //print_r($result_wo);
                if(empty($result_wo))
                {
                    $q_wo="select count(distinct(work_order_no)) as count from wo_numbers,work_order where DATE(date_done) = (select max(date_done) from work_order where date_done<'$dt' and pno=$p) and wo_no=id_wo and wo_numbers.pno=work_order.pno and work_order.pno=$p";
                    $result_wo=$db_handle->runQuery($q_wo);
                }
                if(!empty($result_wo))
                {
                     foreach($result_wo as $row)
                    {
                        $count=$row['count'];
                    }
               
                    $q="select * from wo_numbers,work_order where DATE(date_done) = '$dt'  and wo_no=id_wo and wo_numbers.pno=work_order.pno and work_order.pno=$p";
                    
                    $result_no=$db_handle->runQuery($q);
                    if(empty($result_no))
                    {
                        $q="select distinct(work_order_no) from wo_numbers,work_order where DATE(date_done) = (select max(date_done) from work_order where date_done<'$dt') and wo_no=id_wo and wo_numbers.pno=work_order.pno and work_order.pno=$p";
                        $result_no=$db_handle->runQuery($q);
                    }
                    
                    $i=1;
                    // print_r($result_no);
                    if(!empty($result_no))
                    {
                        foreach($result_no as $row)
                        {
                            $k=$row['work_order_no'];
                            $newstring = substr($k, -3);
                            if($i==1)
                            {
                                $work_title=$work_title.$newstring;
                            }
                            else if($i==$count)
                            {
                                $work_title=$work_title." & ".$newstring;
                            }
                            else {
                            $work_title=$work_title.",".$newstring;
                            }
                            $i++;
                        }
                    }
                    return $work_title;
                }
            }
            $i=0;
            $query="select * from work_order,wo_numbers where date_done='$dt' and wo_no=id_wo and wo_numbers.pno=work_order.pno and work_order.pno=$p";
           // echo $query;
            $result=$db_handle->runQuery($query);
       
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Print</title>
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="../form_action.js"></script>
        <style>
        body{
           -webkit-print-color-adjust: exact; 
        }
        .cell
        {
            border: 1px solid black;
            height:120px;
            text-align: center;
        }
        .text-center
        {
            line-height: 120px;
        }
        .text-pad
        {
            padding-top:10px;
        }
        .small
        {
            font-size: 12px;
        }
        
        </style>
        <script>
           
        </script>
    </head>
    <body>
        <div class="container">
        <div class="row" style="border:1px solid black;">
            <div class="col-md-1 col-xs-1" style="text-align:center;padding-top:5%; "><img src="../img/android-icon-192x192.png" width="50" height="50"/></div>
            <div class="col-md-10 col-xs-10" style="text-align:center;font-weight: bold;">
                <u>
                    <h3 style="font-weight:bold;">KUWAIT OIL COMPANY(K.S.C)</h3>
                    <h4 style="font-weight:bold;">ARABI ENERTECH</h4>
                    <h4 style="font-weight:bold;">PROJECT MANAGEMENT TEAM</h4>
                    <h5 style="font-weight:bold;"><?php echo $project_name ?></h5>
                </u>
                </div>
            <div class="col-md-1 col-xs-1" style="text-align:center;padding-top:5%; "><img src="../img/koc_logo_2008.jpg" width="50" height="50"/></div>
        </div>
        </div>
        
        <div class="container" style="text-align: center;background-color:gainsboro;font-weight:bold; padding: 2px;border: 1px solid black;">DAILY PROGRESS REPORT</div>
        <div class="container" style="text-align: center;font-weight:bold; padding: 2px;border: 1px solid black;">
            <div class="row" style="padding:10px;">
                <div class="col-md-2 col-xs-2">W/Order Nos.</div>
                <div class="col-md-6 col-xs-6"><?php echo work_title($dt,$contract,$p);?></div>
                <div class="col-md-2 col-xs-2">Date: <?php echo $dt;?></div>
                <div class="col-md-2 col-xs-2">Day: <?php echo $days[$r];?></div>
            </div>
        </div>
        <div class="container" style="text-align: center;font-weight:bold;height:75px;">
            <div class="row">
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:75px;">W/Order Nos</div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:75px;">Task Name</div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:75px;">Foreman</div>
                <div class="col-md-3 col-xs-3" style="height:75px;">
                <div class="row" >
                <div class="col-xs-12" style="border-bottom:1px solid black;line-height:25px;">Flowline Length</div>
                </div>
                <div class="row" >
                    <div class="col-xs-6" style="border-bottom:1px solid black;line-height:25px;border-right: 1px solid black;">Today</div>
                    <div class="col-xs-6" style="border-bottom: 1px solid black;line-height:25px;">Cum</div>
                </div>
                <div class="row">
                    <div class="col-xs-3" style="border-bottom: 1px solid black;border-right: 1px solid black;line-height:25px;">AG</div>
                    <div class="col-xs-3" style="border-bottom: 1px solid black;border-right: 1px solid black;line-height:25px;">UG</div>
                    <div class="col-xs-3" style="border-bottom: 1px solid black;border-right: 1px solid black;line-height:25px;">AG</div>
                    <div class="col-xs-3" style="border-bottom:1px solid black;line-height:25px;">UG</div>
                </div>
                </div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:75px;">Other Works</div>
            </div>
        </div>
        <?php
         foreach($result as $row)
        {
            $id=$row['wo_no'];
            $wo=$row['work_order_no'];
            $tn=$row['task_name'];
            $fm=$row['foreman'];
            $cum_ag1=0;
            $cum_ug1=0;
            $cum_query="SELECT sum( ag ) AS cum_ag, sum( ug ) AS cum_ug FROM work_order WHERE date_done < '$dt' and wo_no='$id' and pno=$p";
            
            $cum_result=$db_handle->runQuery($cum_query);
            foreach ($cum_result as $cum_row)
            {
                $cum_ag1=$cum_row['cum_ag'];
                $cum_ug1=$cum_row['cum_ug'];
            }
        ?>
        <div class="container" style="text-align: center;">
        <div class="row">
            <div class="col-md-2 col-xs-2 cell text-center" ><?php echo $row['work_order_no'];?></div>
            <div class="col-md-2 col-xs-2 cell text-pad small" ><p><?php echo $row['task_name'];?></p></div>
            <div class="col-md-2 col-xs-2 cell text-pad small" ><?php echo $row['foreman'];?></div>
            <div class="col-md-3 col-xs-3 cell" >
            <div class="row">
            <div class="col-xs-3 cell text-center" ><?php if($row['ag']!=0){echo $row['ag'];}else { echo " ";}?></div>
            <div class="col-xs-3 cell text-center" ><?php if($row['ug']!=0){echo $row['ug'];}else { echo " ";}?></div>
            <div class="col-xs-3 cell text-center" ><?php if($cum_ag1!=0){ echo round($cum_ag1,3); }else { echo " "; }?></div>
            <div class="col-xs-3 cell text-center" ><?php if($cum_ug1!=0){ echo round($cum_ug1,3); }else{ echo " "; }?></div>
            </div>
            </div>
            <div class="col-md-3 col-xs-3 cell text-pad small"><b><?php echo $row['other_works'];?></b></div>
        </div>
        </div>
        <?php 
        $i++;
        }
        $query="select * from site_info where date_site= '$dt' and pno=$p";
        $result2=$db_handle->runQuery($query);
        $rem='';
        $acc='';
        $inst='';
        if(!empty($result2))
        {
            foreach ($result2 as $row2)
            {
                $rem=$row2['remarks'];
                $acc=$row2['accidents'];
                $inst=$row2['instruction'];
            }
        }
?>
        <div class="container" style="border: 1px solid black;font-weight: bold;">
        Site Instruction/Changes in Issued Work Order:
        </div>
        <div class="container" style="border: 1px solid black;height: 75px">
        <?php echo $inst;?>
        </div>
        <div class="container" style="border: 1px solid black;font-weight: bold;">
        Safety Aspects,Accidents:
        </div>
        <div class="container" style="border: 1px solid black;height: 75px">
        <?php echo $acc;?>
        </div>
        <div class="container" style="border: 1px solid black;height:100px">
            <div class="row">
                <div class="col-md-2 col-xs-2" style="font-weight:bold;border: 1px solid black;;height:100px">Remarks Workshop:</div>
                <div class="col-md-8 col-xs-8"><?php echo $rem;?></div>
            </div>
        </div>
        <div class="container" style="border: 1px solid black;height:100px">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:100px">Signed:____________<br><br>Contractor Representative</div>
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:100px">Signed:____________<br><br>KOC Supervisor</div>
            </div>
        </div>
    </body>
</html>
