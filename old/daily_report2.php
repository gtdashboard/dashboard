<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <title>Daily Report 2</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="form_action.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <style>
            body {
                font-family: "Lato", sans-serif;
            }

            .sidenav {
                 height: 100%;
                 width: 0;
                 position: fixed;
                 z-index: 1;
                 top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
                text-align:center;
            }

        .sidenav a {
             padding: 8px 8px 8px 32px;
             text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s

        }

.sidenav a:hover{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
        </style>
        <script>
function add3()
{
    var ctr3=document.getElementById("cwo").value;
    ctr3++;
    var wo = "wo" + ctr3;
    var tn = "tn" + ctr3;
    var rf = "rf" + ctr3;
    var ag = "ag" + ctr3;
    var ug = "ug" + ctr3;
    var ow = "ow" + ctr3;
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" name="'+ wo +'" class="form-control"/></td><td><textarea row="20" cols="25" name="'+ tn +'"></textarea></td><td><textarea row="10" cols="17" name="'+ rf +'"></textarea></td><td><input type="text" class="form-control" placeholder="AG" name="' + ag + '"/></td><td><input type="text" placeholder="UG" class="form-control" name="'+ ug +'"/></td><td><textarea row="5" cols="17" name="'+ ow +'"></textarea></td></tr>';
    
    $('#table3 > tbody:last-child').append(newTr);
    console.log(newTr);
    $('#cwo').val(ctr3);
}
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
function del(element)
{
  
    $(element).closest("tr").remove();
    
}
</script>
     
    </head>
    <body>
        <div id="mySidenav" class="sidenav">
            <h1 style="color: #818181;"><?php
            session_start();
            if(isset($_GET['dt']))
            {
                $dt=$_GET['dt'];
            }
            else {
                header('Location:view_by_date.php');
            }
            if($_SESSION["user_name"]) 
            {
                echo "User:".$_SESSION['user_name'];
            }
            else 
            {
                header('Location:sp_105_login.php');
            }
            ?></h1>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="new_record.php">Add new Report</a>
        <a href="update_cum.php">Update Cumulative</a>
        <a href="update_existing.php">Update An Existing Record</a>
        <a href="view_by_date.php">View Report By Date</a>
        <a href="upload_signed.php">Upload Signed Document</a>
        <a href="logout.php">Logout</a>
        </div>
        <div class="container" style="width:100%;border:2px solid black;padding:2%;">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <div style="text-align: center;"><h1>Daily Progress Report</h1></div>
            <div class="container" style="width:100%;border:2px solid black;padding:2%;">
            <fieldset>
            <legend style="color:blue;font-weight:bold;text-align: center;">Work Activity</legend>
            <form action="preview2.php?dt=<?php echo $_GET['dt'];?>" method="post">
            <table id="table3" class="table table-striped table-bordered">
            <thead>
                    <tr>
                        <th></th>
                    <th style="text-align: center">Work Order Number</th>
                    <th style="text-align: center">Task Name</th>
                    <th style="text-align: center">Responsible Foreman</th>
                    <th style="text-align: center">AG</th>
                    <th style="text-align: center">UG</th>
                    <th style="text-align: center">Other Work</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require 'db.php';
                        $p=$_SESSION['project'];
                        $db_handle=new DBController($p);
                        $query="select * from work_order,wo_numbers where DATE(date_done) = (select max(date_done) from work_order) and wo_no=id_wo";
                        $result=$db_handle->runQuery($query);
                        $query2="select * from site_info where date_site = (select max(date_site) from site_info)";
                        $result2=$db_handle->runQuery($query2);
                        $i=0;
                        foreach($result as $row)
                        {
                            $i++;
                        ?>
                    <tr>
                        <td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td>
                        <td><input type="text" name="wo<?php echo $i;?>" class="form-control" value="<?php echo $row['work_order_no'];?>"/></td>
                        <td><textarea row="20" cols="25" name="tn<?php echo $i;?>"><?php $m = preg_replace('#(<br */?>\s*)+#i', '<br />', $row['task_name']);$m=str_replace('<br />', "\n", $m);echo $m;?></textarea></td>
                        <td><textarea row="10" cols="17" name="rf<?php echo $i;?>"><?php $n=str_replace('<br />', "\n", $row['foreman']); echo $n; ?></textarea></td>
                        <td><input type="text" class="form-control" placeholder="AG" name="ag<?php echo $i;?>" value="<?php echo $row['ag'];?>"/></td>
                        <td><input type="text" placeholder="UG" class="form-control" name="ug<?php echo $i;?>" value="<?php echo $row['ug'];?>"/></td>
                        <td><textarea row="7" cols="17" name="ow<?php echo $i;?>"><?php $n=str_replace('<br />', "\n", $row['other_works']); echo $n;?></textarea></td>
                    </tr>
                    <?php }
                    $c=$i;
                    foreach ($result2 as $row2)
                    {
                    ?>
                    </tbody>
                </table>
                <input type="hidden" name="cwo" id="cwo" value="<?php echo $c;?>"/>
                <a onclick="add3()" class="btn btn-primary" style="width:100%;">Add Row</a>
                </fieldset>
                </div>
                <div class="container" style="width:100%;border:2px solid black;padding:2%;">
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Site Instruction/Changes in Issued Work Order</legend>
                <textarea style="width: 100%" cols="5" name="instructions"><?php echo $row2['instruction'];?></textarea>
                </fieldset>
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Safety Aspects,Accidents</legend>
                <textarea style="width: 100%" cols="5" name="accidents"><?php echo $row2['accidents'];?></textarea>
                </fieldset>
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Remarks Workshop</legend>
                <textarea style="width: 100%" cols="5" name="remarks"><?php echo $row2['remarks'];?></textarea>
                </fieldset>
                </div>
                <?php }?>
            <button class="btn btn-primary" style="width:90%; margin-top: 2%;margin-left: 4%;">Submit</button>
            </form>
            </div>
    </body>
</html>
