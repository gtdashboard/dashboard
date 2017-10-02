<html>
<head>
<title>Logout</title>
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="form_action.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</head>
<body>
    <?php
    session_start();
    unset($_SESSION['project']);
    unset($_SESSION['user_name']);
    unset($_SESSION['userid']);
    ?>
    <div class="container" style="margin-top:10%;text-align:center;"><h1 style="font-weight:bold;font-size: 50px;">Successfully Logged Out</h1></div>
    <div class="container" id="box" style="margin-top:5%;text-align:center;">
        <form action="index.php" method="post">
            <div class="form-group">
                <button class="btn btn-primary" style="width:100%;margin-top: 10px;">Login to Continue</button>
            </div>
        </form>
    </div>
    <div id="error" class="container"></div>
</body>
</html>