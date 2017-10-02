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
            function work_title($dt,$contract,$p)
            {
                $work_title="FLN/$contract/";
                $db_handle=new DBController();
                $query_wo="select count(*) as count from wo_numbers,work_order where DATE(date_done) = '$dt' and wo_no=id_wo and wo_numbers.pno=work_order.pno and work_order.pno=$p";
                //echo $query_wo;
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
            $r=date("w", strtotime($dt));
            $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday');
            
            
            
            $q="select * from worker where date='$dt' and pno=$p";
            $result=$db_handle->runQuery($q);
            if(empty($result))
            {
                header("Location:view.php");
            }
            $q1="select count(*) from worker where DATE(`date`) = '$dt' and category=0 and pno=$p";
            $result1=$db_handle->runQuery($q);
            
            
            $q="select * from worker where DATE(`date`) = '$dt' and category=0 and pno=$p";
            $result=$db_handle->runQuery($q);
            

            //staff
            $des=array(100);
            $count_staff=array(100);
            for($i=0;$i<100;$i++)
            {
                $des[$i]="";
                $count_staff[$i]=0;
            }
            $cst=0;
            foreach ($result as $row)
            {
                $des[$cst]=$row['designation'];
                $count_staff[$cst]=$row['number'];
                $cst++;
            }
            

            //skilled1
            $des_sk1=array(100);
            $count_sk1=array(100);
            $csk1=0;
            for($i=0;$i<100;$i++)
           {
                $des_sk1[$i]="";
                $count_sk1[$i]=0;
           }
            $q="select * from worker where DATE(`date`) = '$dt' and category=1 and pno=$p";
            $result=$db_handle->runQuery($q);
            foreach ($result as $row)
            {
                $des_sk1[$csk1]=$row['designation'];
                $count_sk1[$csk1]=$row['number'];
                $csk1++;
            }
            

            //skilled2
            $des_sk2=array(100);
            $count_sk2=array(100);
            $csk2=0;
            for($i=0;$i<100;$i++)
            {
                $des_sk2[$i]="";
                $count_sk2[$i]=0;
            }
                $q="select * from worker where DATE(`date`) = '$dt' and category=2 and pno=$p";
                $result=$db_handle->runQuery($q);
                foreach ($result as $row)
                {
                    $des_sk2[$csk2]=$row['designation'];
                    $count_sk2[$csk2]=$row['number'];
                    $csk2++;
                }
                //unskilled
                $des_usk=array(100);
                $count_usk=array(100);
                $cusk=0;
                for($i=0;$i<100;$i++)
                {
                    $des_usk[$i]="";
                    $count_usk[$i]=0;
                }
                $q="select * from worker where DATE(`date`) = '$dt' and category=3 and pno=$p";
                $result=$db_handle->runQuery($q);
                if(!empty($result))
                {
                    foreach ($result as $row)
                    {
                        $des_usk[$cusk]=$row['designation'];
                        $count_usk[$cusk]=$row['number'];
                        $cusk++;
                    }
                }
                //calculate maximum
                $max=$cst;
                if($csk1>$max)
                    $max=$csk1;
                if($csk2>$max)
                    $max=$csk2;
                if($cusk>$max)
                $max=$cusk;
                $count_staff_final=0;
                $count_skilled1_final=0;
                $count_skilled2_final=0;
                $count_unskilled_final=0;
                for($i=0;$i<$cst;$i++)
                {
                    $count_staff_final+=$count_staff[$i];
                }
                for($i=0;$i<$csk1;$i++)
                {
                    $count_skilled1_final+=$count_sk1[$i];
                }
                for($i=0;$i<$csk2;$i++)
                {
                    $count_skilled2_final+=$count_sk2[$i];
                }
                for($i=0;$i<$cusk;$i++)
                {
                    $count_unskilled_final+=$count_usk[$i];
                }
                $total=$count_staff_final+$count_skilled1_final+$count_skilled2_final+$count_unskilled_final;
                $at=0;
                $rain=0;
                $ss=0;
                $ot='';
                
                $query3="select * from weather where date_temp='$dt' and pno=$p";
                $result3=$db_handle->runQuery($query3);
                if(!empty($result3))
                {
                    foreach($result3 as $row3)
                    {
                        $at=$row3['temperature'];
                        $rain=$row3['rain'];
                        $ss=$row3['sandstorm'];
                        $ot=$row3['others'];
                    }
                }
                
            ?>
<!DOCTYPE html>
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
                 /*-webkit-print-color-adjust: exact; */
            }
        </style>
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
        <br>
        <div class="container" style="text-align: center;font-weight:bold;height:30px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;">Average Temp.</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;">Rain(Hrs)</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;">Sand Strom(Hrs)</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;">Others</div>
            </div>
        </div>
        <div class="container" style="text-align: center;font-weight:bold;height:30px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $at;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $rain;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $ss;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $ot;?></div>
            </div>
        </div>
        <br>
        <div class="container" style="text-align:center;font-weight:bold;height:50px;">
            <div class="row">
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:50px;width:19.133%;">Staff</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;width:4.166%;">No</div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:50px;width:19.133%;">Skilled</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;width:4.166%;">No</div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:50px;width:19.133%;">Skilled</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;width:4.166%;">No</div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:50px;width:19.133%;">Unskilled/Skilled</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;width:4.166%;">No</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;width:6.266%;">Total</div>
            </div>
        </div>
        
        <?php
            for($i=0;$i<$max;$i++)
            {
            ?>
            <div class="container" style="text-align:center;height:30px;">
            <div class="row" >
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;"><?php echo $des[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php if(($count_staff[$i]==0)&&($des[$i]=="")){echo " ";}else {echo $count_staff[$i];}?></div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;"><?php echo $des_sk1[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php if(($count_sk1[$i]==0)&&($des_sk1[$i]=="")){echo " ";}else {echo $count_sk1[$i];}?></div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;"><?php echo $des_sk2[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php if(($count_sk2[$i]==0)&&($des_sk2[$i]=="")){echo " ";}else {echo $count_sk2[$i];}?></div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;"><?php echo $des_usk[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php if(($count_usk[$i]==0)&&($des_usk[$i]=="")){echo " ";} else{echo $count_usk[$i];}?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:6.266%;"></div>
            </div>
            </div>
        <?php } ?>
        
        <div class="container" style="text-align:center;height:30px;">
                <div class="row">
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;">Total</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php echo $count_staff_final;?></div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;">Total</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php echo $count_skilled1_final;?></div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;">Total</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php echo $count_skilled2_final;?></div>
                <div class="col-md-2 col-xs-2" style="border: 1px solid black;line-height:30px;height:30px;width:19.133%;">Total</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:4.166%;"><?php echo $count_unskilled_final;?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;width:6.266%;"><?php echo $total;?></div>
                </div>
        </div>
        <br>
        <div class="container" style="text-align:center;font-weight:bold;height:50px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="border: 1px solid black;line-height:50px;">Type</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;">Number</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;">Hours</div>
                <div class="col-md-4 col-xs-4" style="border: 1px solid black;line-height:50px;">Type</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;">Number</div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:50px;">Hours</div>
            </div>
        </div>
            
            <?php
            
                $q="select * from equipment where DATE(`date_used`) = '$dt' and pno=$p";
                $result=$db_handle->runQuery($q);
                if(empty($result))
                {
                   header("Location:view_by_date.php");
                }
                $type=array(30);
                $hours=array(30);
                $number=array(30);
                for($i=0;$i<30;$i++)
                {
                    $type[$i]="";
                    $hours[$i]="";
                    $number[$i]="";
                }
                $i=0;
                foreach($result as $row)
                {
                    $i++;
                    $type[$i]=$row['type'];
                    $hours[$i]=$row['hours'];
                    $number[$i]=$row['number_equip'];
                    
                }
                $count=$i;
                for($i=1;$i<=$count;$i++)
                {
            ?>
            <div class="container" style="text-align:center;height:30px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $type[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $number[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $hours[$i];?></div>
            <?php $i++;?>
                <div class="col-md-4 col-xs-4" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $type[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $number[$i];?></div>
                <div class="col-md-1 col-xs-1" style="border: 1px solid black;line-height:30px;height:30px;"><?php echo $hours[$i];?></div>
            </div>
            </div>
            <?php } ?>
            
</body>
</html>
