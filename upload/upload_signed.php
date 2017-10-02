<html>
<head>
<title>Upload</title>
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"  type="text/css"/> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="form_action.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> 
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
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
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
    <div class="container" style="margin-top:10%;text-align:center;"><h1 style="font-weight:bold;font-size: 50px;">SP-105</h1></div>
    <div class="container" id="box" style="margin-top:5%;text-align:center;">
        <form action="upload_signed_db.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Choose Date" name="date_selected" id="date_selected"/> 
                <input type="file" class="form-control" placeholder="Choose file" style="margin-top:10px;" name="fileToUpload"/>
                <button class="btn btn-primary" style="width:100%;margin-top: 10px;" >Upload</button>
            </div>
        </form>
        <br>
        <br>
        <div id="error" style="width: 100%;color: red"><?php if(isset($_GET['ans'])){echo $_GET['ans'];}?></div>
    </div>
    </div>
</body>
</html>