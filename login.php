<html>
<head>
<title>Login</title>
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="form_action.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<style>
    .centered {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transform: -webkit-translate(-50%, -50%);
  transform: -moz-translate(-50%, -50%);
  transform: -ms-translate(-50%, -50%);
}
</style>
</head>
<body background="bgimage.jpg">
    <?php
    require 'db.php';
    session_start();
    if(isset($_REQUEST['project']))
    {
        
        $pro=$_REQUEST['project'];
    }
    else 
    {
        header("Location:index.php");   
    }
    $db_handle=new DBController();
    $basic="select * from general where pno=$pro";
    
    $result_basic=$db_handle->runQuery($basic);
    if(empty($result_basic))
    {
        header("Location:index.php");   
    }
    else {
        $_SESSION['project']=$pro;
    }
    $_SESSION['project']=$pro;
    
       ?>
    <div class="centered">
    <div class="container" style="margin-top:10%;text-align:center;"><h1 style="font-weight:bold;font-size: 50px;text-transform: uppercase;">SP-<?php echo $pro;?></h1></div>
    <div class="container" id="box" style="margin-top:5%;text-align:center;">
        <form action="login_valid_test.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Employee ID" style="margin-top:10px;" name="username"/>
                <input type="password" class="form-control" placeholder="Password" style="margin-top:10px;" name="password" />
                <br/>
                <button class="btn btn-primary" style="width:100%;margin-top: 10px;">Login</button>
             </div>
        </form>
        <br/>
        <label>New User?</label>
        <a class="btn btn-primary" href="" style="width:100%;margin-top: 10px;">Sign Up</a>
    </div>
    <div id="error" class="container"></div>
    </div>
</body>
</html>