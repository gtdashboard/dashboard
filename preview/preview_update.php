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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="form_action.js"></script>
        <title>Preview</title>
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <style>
        @media print
        {
            table { page-break-after:auto; }
            tr    { page-break-inside:avoid; page-break-after:auto; }
            td    { page-break-inside:avoid; page-break-after:auto; }
            thead { display:table-header-group; }
            tfoot { display:table-footer-group; }
        }
        </style>
    </head>
    <body>
        <?php
           require 'db.php';
           session_start();
           $p=$_SESSION['project'];
           $db_handle=new DBController($p);
           if(isset($_GET['dt']))
           {
               $dt=$_GET['dt'];
           }
        ?>
        <div class="container">
        <div style="text-align: center;"><h3><?php echo date("d-m-Y");?></h3></div>
        <?php 
        $temp=$_POST['temp'];
        $rain=$_POST['rain'];
        $storm=$_POST['storm'];
        $o=$_POST['others'];
        $query="update equipment set type='$name',number_equip=$des,hours=$cat where id_equip=$id";
        $result=$db_handle->runUpdate($query);
        if($result)
        {
            //echo 'updated';
        }
        ?>
        <table id="table_staff" class="table table-striped table-bordered">
            <thead>
            <th style="text-align: center">Temperature</th>
            <th style="text-align: center">Rain(Hrs)</th>
            <th style="text-align: center">Storm(Hrs)</th>
            <th style="text-align: center">Others</th>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center"><?php echo $temp;?></td>
                    <td style="text-align: center"><?php echo $rain;?></td>
                    <td style="text-align: center"><?php echo $storm;?></td>
                    <td style="text-align: center"><?php echo $o;?></td>
                </tr>
            </tbody>
        </table>
        <table id="table_staff" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th style="text-align: center">Staff</th>
            <th style="text-align: center">No</th>
            <th style="text-align: center">Skilled</th>
            <th style="text-align: center">No</th>
            <th style="text-align: center">Skilled</th>
            <th style="text-align: center">No</th>
            <th style="text-align: center">Unskilled/Skilled</th>
            <th style="text-align: center">No</th>
        <tr>
        </thead>
        <tbody>
        <?php
        $count_staff=$_POST["cstaff"];
        //echo "$count_staff";
        $count_st=0;
        $count_sk1=0;
        $count_sk2=0;
        $count_usk=0;
        $staff=array(20);
        $skilled1=array(20);
        $skilled2=array(20);
        $unskilled=array(20);
        $count_st_array=array(20);
        $count_sk1_array=array(20);
        $count_sk2_array=array(20);
        $count_usk_array=array(20);
        for($i=0;$i<20;$i++)
        {
            $staff[$i]="";
            $count_st_array[$i]=0;
        }
        for($i=0;$i<20;$i++)
        {
            $skilled1[$i]="";
            $count_sk1_array[$i]=0;
        }
        for($i=0;$i<20;$i++)
        {
            $skilled2[$i]="";
            $count_sk2_array[$i]=0;
        }
        for($i=0;$i<20;$i++)
        {
            $unskilled[$i]="";
            $count_usk_array[$i]=0;
        }
        for($i=1;$i<=$count_staff;$i++)
        {
            if((isset($_POST['name'.$i]))&&(isset($_POST['number'.$i]))&&(isset($_POST['cat'.$i])))
            {
                $name=$_POST['name'.$i];
                $num=$_POST['number'.$i];
                $cat=$_POST['cat'.$i];
                $id=$_POST['id_w'.$i];
                $query="update worker set category=$cat,designation='$name',number=$num where id_worker=$id";
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                        //echo 'updated';
                }
                if($cat==0)
                {
                     $staff[$count_st]=$name;
                    $count_st_array[$count_st]=$num;
                    $count_st++;
                }
                if($cat==1)
                {
                    $skilled1[$count_sk1]=$name;
                    $count_sk1_array[$count_sk1]=$num;
                    $count_sk1++;
                }
                if($cat==2)
                {
                    $skilled2[$count_sk2]=$name;
                    $count_sk2_array[$count_sk2]=$num;
                    $count_sk2++;
                }
                if($cat==3)
                {
                    $unskilled[$count_usk]=$name;
                    $count_usk_array[$count_usk]=$num;
                    $count_usk++;
                }
            }
            //echo "<tr id='row".$count."'><td style='text-align: center'>$name</td><td style='text-align: center'>$des</td></tr>";
        }
        $max=$count_st;
        if($count_sk1>$max)
            $max=$count_sk1;
        if($count_sk2>$max)
            $max=$count_sk2;
        if($count_usk>$max)
            $max=$count_usk;
        for($i=0;$i<$max;$i++)
        {
            echo "<tr>";
            echo "<td style='text-align: center'>$staff[$i]</td>";
            if($staff[$i]=="")
            {
                echo "<td></td>";
            }
            else
            {
                echo "<td style='text-align: center'>$count_st_array[$i]</td>";
            }
            echo "<td style='text-align: center'>$skilled1[$i]</td>";
            if($skilled1[$i]=="")
            {
                echo "<td></td>";
            }
            else
            {
                echo "<td style='text-align: center'>$count_sk1_array[$i]</td>";
            }
            echo "<td>$skilled2[$i]</td>";
            if($skilled2[$i]=="")
            {
                echo "<td></td>";
            }
            else
            {
                echo "<td style='text-align: center'>$count_sk2_array[$i]</td>";
            }
            echo "<td>$unskilled[$i]</td>";
            if($unskilled[$i]=="")
            {
                echo "<td></td>";
            }
            else
            {
               echo "<td style='text-align: center'>$count_usk_array[$i]</td>";
            }
            
            echo "</tr>";
        }
        ?>
        </tbody>
        <tfoot>
            <?php
                $count_staff_final=0;
                $count_skilled1_final=0;
                $count_skilled2_final=0;
                $count_unskilled_final=0;
                for($i=0;$i<20;$i++)
                {
                    $count_staff_final+=$count_st_array[$i];
                    $count_skilled1_final+=$count_sk1_array[$i];
                    $count_skilled2_final+=$count_sk2_array[$i];
                    $count_unskilled_final+=$count_usk_array[$i];
                }
                echo "<tr>";
                echo "<td style='text-align: center'>Total</td>";
                echo "<td style='text-align: center'>$count_staff_final</td>";
                echo "<td style='text-align: center'>Total</td>";
                echo "<td style='text-align: center'>$count_skilled1_final</td>";
                echo "<td style='text-align: center'>Total</td>";
                echo "<td style='text-align: center'>$count_skilled2_final</td>";
                echo "<td style='text-align: center'>Total</td>";
                echo "<td style='text-align: center'>$count_unskilled_final</td>";
                echo "</tr>"
            ?>
        </tfoot>
        </table>
        <table id="table_staff" class="table table-striped table-bordered">
            <thead>
            <th style='text-align: center'>Type</th>
            <th style='text-align: center'>Number</th>
            <th style='text-align: center'>Hours</th>
            </thead>
        <tbody>
        <?php
        $count_equip=$_POST["cequip"];
        //echo "$count_equip";
        for($i=1;$i<=$count_equip;$i++)
        {
            if((isset($_POST['type'.$i]))&&(isset($_POST['num'.$i]))&&(isset($_POST['hrs'.$i])))
            {
                $name=$_POST['type'.$i];
                $des=$_POST['num'.$i];
                $cat=$_POST['hrs'.$i];
                $id2=$_POST['id_e'.$i];
                $query="update equipment set type='$name',number_equip=$des,hours=$cat where id_equip=$id2";
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                    //echo 'updated';
                }
                echo "<tr>";
                echo "<td style='text-align: center'>$name</td>";
                echo "<td style='text-align: center'>$des</td>";
                echo "<td style='text-align: center'>$cat</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
        </table>
        <a href="print_page1_with_date.php?dt=<?php echo $dt;?>" class="btn btn-primary" style="width:100%;margin-bottom: 2%;margin-top: 2%;">Print</a>
        </div>
    </body>
</html>
