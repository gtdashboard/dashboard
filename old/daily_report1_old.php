<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Daily Progress Report</title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="form_action.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script>
        $(window).unload(function () {
        var ctr = document.getElementById("cstaff").value;
        var ctr2 = document.getElementById("cequip").value;
        $('#cstaff').val(ctr); 
        console.log("ctr:",ctr);
        $('#cequip').val(ctr2)}); 
function add()
{
    var ctr = document.getElementById("cstaff").value;
    console.log("ctr:",ctr);
    ctr++;
    var name = "name" + ctr;
    console.log("name:",name);
    var number = "number" + ctr;
    console.log("no:",number);
    var cat = "cat" + ctr;
    console.log("cat:",cat);
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" class="form-control" name="'+ name +'"/></td><td><input type="text" class="form-control" name="'+ number +'"/></td><td><select name="'+ cat +'" class="form-control"><option value="0">Staff</option><option value="1">Skilled1</option><option value="2">Skilled2</option><option value="3">Skilled/Unskilled</option></select></td></tr>';
    console.log("newtr:",newTr);
    $('#table1 > tbody:last-child').append(newTr);
    $('#cstaff').val(ctr);
}
function add2()
{
    var ctr2 = document.getElementById("cequip").value;
    console.log("ctr2:",ctr2);
    ctr2++;
    var name = "type" + ctr2;
    var number = "num" + ctr2;
    var cat = "hrs" + ctr2;
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" class="form-control" name="'+ name +'"/></td><td><input type="text" class="form-control" name="'+ number +'"/></td><td><input type="text" class="form-control" name="'+ cat +'"/></td></tr>';
    console.log("newtr:",newTr);
    $('#table2 > tbody:last-child').append(newTr);
    $('#cequip').val(ctr2);
}
function openNav() {
    document.getElementById("mySidenav").style.width = "50%";
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
                header('Location:login.php');
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
        <?php 
            require 'db.php';
            $p=$_SESSION['project'];
            $db_handle=new DBController($p);
            $query="select * from worker where DATE(date) = (select max(date) from worker) ORDER BY category ASC , designation ASC";
            echo $query;
            $result = $db_handle->runQuery($query);
            $query2="SELECT * FROM equipment WHERE DATE( date_used ) = (SELECT max( date_used ) FROM equipment ) order by type asc ";
            $result2 = $db_handle->runQuery($query2);
        ?>
        <div class="container" style="background-color: white;width:100%;">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        <div class="container" style="text-align: center;"><h1>Daily Progress Report</h1></div>
                <form action="preview_report1.php?dt=<?php echo $dt;?>" method="post">
                <div id="form" class="container" style="border:2px solid black;padding:2%;">
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Weather Information</legend>
                <label for="tmp">Average Temperature:</label>
                <input type="text" class="form-control" name='temp' value="0"/>
                <label for="rain">Rain(hrs):</label>
                <input type="text" class="form-control" name='rain' value="0"/>
                <label for="tmp">Sand Storm(hrs):</label>
                <input type="text" class="form-control" name='storm' value="0"/>
                <label for="tmp">Others:</label>
                <input type="text" class="form-control" name='others' value="0"/>
                </fieldset>
                </div>
            <div class="container" id="form2" style="border:2px solid black;padding:2%;">
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Staff Information</legend>
                <table id="table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                    <th></th>
                    <th style="text-align: center">Designation</th>
                    <th style="text-align: center">Number</th>
                    <th style="text-align: center">Category</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        foreach ($result as $row)
                        {    
                            $i++;
                        ?>
                        <tr>
                        <td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td>
                        <td><input type="text" name="name<?php echo $i;?>" class="form-control" value="<?php echo $row['designation'];?>"/></td>
                        <td><input type="text" class="form-control" name="number<?php echo $i;?>" value="<?php echo $row['number'];?>"/></td>
                        <td>
                            <select class="form-control" name="cat<?php echo $i;?>">
                                <option value="0" <?=$row['category'] == 0 ? ' selected="selected"' : '';?> >Staff</option>
                                <option value="1" <?=$row['category'] == 1 ? ' selected="selected"' : '';?> >Skilled1</option>
                                <option value="2" <?=$row['category'] == 2 ? ' selected="selected"' : '';?> >Skilled2</option>
                                <option value="3" <?=$row['category'] == 3 ? ' selected="selected"' : '';?>>Skilled/Unskilled</option>
                            </select>
                        </td>
                        </tr>
                        <?php
                        }
                        $count_staff=$i;
                        echo $count_staff;
                        ?>
                    </tbody>
                </table>
                <input type="hidden" name="cstaff" id="cstaff" value=<?php echo $count_staff;?> />
                <a onclick="add()" class="btn btn-primary" style="width: 100%;">Add Row</a>
                </fieldset>
            </div>
            <div class="container" id="form2" style="border:2px solid black;padding:2%;">
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Contractor Plants and Equipments</legend>
                <table class="table table-striped table-bordered" id="table2">
                    <thead>
                    <tr>
                    <th></th>
                    <th style="text-align: center">Type</th>
                    <th style="text-align: center">Number</th>
                    <th style="text-align: center">Hours</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    foreach($result2 as $row2)
                    {
                        $i++;
                    ?>
                        <tr>
                        <td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td>
                        <td><input type="text" class="form-control" name="type<?php echo $i;?>" value="<?php echo $row2['type'];?>"/></td>
                        <td><input type="text" class="form-control" name="num<?php echo $i;?>" value="<?php echo $row2['number_equip'];?>"/></td>
                        <td><input type="text" class="form-control" name="hrs<?php echo $i;?>" value="<?php echo $row2['hours'];?>"/></td>
                        </tr>
                    <?php
                    }
                    $count_equip=$i;
                    echo $count_equip;
                    ?>
                    
                    </tbody>
                </table>
                <input type="hidden" name="cequip" id="cequip" value="<?php echo $count_equip;?>" />
                <a onclick="add2()" class="btn btn-primary" style="width:100%;">Add Row</a>
                </fieldset>
            </div>
            <div class="container" style="text-align:center;padding:2%;"><button class="btn btn-primary" style="width:100%;">Submit</button></div>
            </form>
        </div>     
    </body>
</html>
