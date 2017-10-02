<html>
<head>
<title>Daily Report</title>
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="form_action.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <title>Daily Report 2</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 
<style>
    body{
        background-image: url('oil.jpg');
        background-size: 100%;
        background-repeat: no-repeat;

    }
</style>
<script>
    $(function() {
               $("#date_selected").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });
function test()
{
    var dt=document.getElementById("date_selected").value;
    var opt=document.getElementById("cat").value;
    var dataString = 'date_selected='+dt+'&opt='+opt;
    $.ajax({
	type: "POST",
	url: "update_existing_db.php",
	data:dataString,
	beforeSend: function(){
		$("#login").val("Connecting....");
	},
	success: handleData
	});
}
function handleData(data)
{
    if(data.length>1)
    {
        console.log(data.length);
        $("#error").text("No Record For that date...Please Pick Another.........");
    }
    else 
    {
        $("#error").text("Record found");
    }
    console.log(data);
}
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
</head>
<body>
    <div class="container" style="width:100%;">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <div id="mySidenav" class="sidenav">
            <h1 style="color: #818181;"><?php
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
    <div class="container" style="margin-top:10%;text-align:center;"><h1 style="font-weight:bold;font-size: 50px;">SPECIAL PROJECTS</h1></div>
    <div class="container" style="margin-top:5%;text-align:center;">
        <form action="next_report.php" method="post">
            <div class="form-group">
                <label for="choose" style="font-weight:bolder;">Choose Report to Update:</label>
                <select name="cat" id="cat" class="form-control" onchange="test()">
                    <option value="1">Daily Report 1</option>
                    <option value="2">Daily Report 2</option>
                </select>
                <label for="choose" style="font-weight:bolder;">Choose a date:</label>
                <input type="text" class="form-control" placeholder="Choose Date" name="date_selected" id="date_selected" onchange="test()"/> 
                <button class="btn btn-primary" id="login" style="width:100%;margin-top: 10px;">Enter</button>
            </div>
        </form>
        <br>
        <br>
        <div id="error" style="width: 100%;color: red"></div>
    </div>
    </div>
</body>
</html>