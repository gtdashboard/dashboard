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
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
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
function delw(element,id)
{
    var dataString = 'id_worker='+id;
     $.ajax({
	type: "POST",
	url: "delete_worker.php",
	data:dataString,
	beforeSend: function(){
		
	},
	success: handleData
	});
    $(element).closest("tr").remove();
}
function dele(element,id)
{
    var dataString = 'id_equip='+id;
     $.ajax({
	type: "POST",
	url: "delete_equip.php",
	data:dataString,
	beforeSend: function(){
		
	},
	success: handleData
	});
    $(element).closest("tr").remove();
}
function del(element)
{
    $(element).closest("tr").remove();
}
function handleData(data)
{
    console.log("data",data);
}
</script>
     
    </head>
    <body>
    <div id="mySidenav" class="sidenav">
            <h1 style="color: #818181;"><?php
            require 'db.php';
            $db_handle=new DBController();
            if(isset($_GET['dt']))
            {
                $dt=$_GET['dt'];
            }
            else {
                 header("Location:update_existing.php");
            }
            $query="select * from worker where DATE(date) = '$dt'";
            $result=$db_handle->runQuery($query);
            if(empty($result))
            {
                header("Location:update_existing.php");
            }
            session_start();
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
        <?php 
            $query2="select * from equipment where DATE(date_used) = '$dt'";
            $result2 = $db_handle->runQuery($query2);
        ?>
        <div class="container" style="background-color: white;width:100%;">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        <div class="container" style="text-align: center;"><h1>Daily Progress Report</h1></div>
                <form action="preview_old.php?dt=<?php echo $dt;?>" method="post">
                <div id="form" class="container" style="border:2px solid black;padding:2%;">
                <fieldset>
                <legend style="color:blue;font-weight:bold;text-align: center;">Weather Information</legend>
                <label for="tmp">Average Temperature:</label>
                <input type="text" class="form-control" name='temp'/>
                <label for="rain">Rain(hrs):</label>
                <input type="text" class="form-control" name='rain'/>
                <label for="tmp">Sand Storm(hrs):</label>
                <input type="text" class="form-control" name='storm'/>
                <label for="tmp">Others:</label>
                <input type="text" class="form-control" name='others'/>
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
                        <input type="hidden" name="id_w<?php echo $i;?>" value="<?php echo $row['id_worker'];?>"/>
                        <tr>
                        <td><a class="btn" onclick="delw(this,'<?php echo $row['id_worker'];?>')"><i class="fa fa-trash-o fa-lg"></i></a></td>
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
                        $i++?>
                        <input type="hidden" name="id_e<?php echo $i;?>" value="<?php echo $row2['id_equip'];?>"/>
                        <tr>
                        <td><a class="btn" onclick="dele(this,'<?php echo $row2['id_equip'];?>')"><i class="fa fa-trash-o fa-lg"></i></a></td>
                        <td><input type="text" class="form-control" name="type<?php echo $i;?>" value="<?php echo $row2['type'];?>"/></td>
                        <td><input type="text" class="form-control" name="num<?php echo $i;?>" value="<?php echo $row2['number_equip'];?>"/></td>
                        <td><input type="text" class="form-control" name="hrs<?php echo $i;?>" value="<?php echo $row2['hours'];?>"/></td>
                    </tr>
                    <?php
                    }
                    $count_equip=$i;
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
        </div>
    </body>
</html>
