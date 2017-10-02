<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GTAE</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    
    <!-- Custom Fonts -->
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"  type="text/css"/> 
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js">
    </script>
    <!-- Theme CSS -->
    <link href="../css/agency.css" rel="stylesheet">

   
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
	url: "../update/update_existing_db.php",
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
        $("#error").text("No Record For that date...Click Enter.........");
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
<?php
        session_start();
        if($_SESSION["user_name"]) 
        {
            $name=$_SESSION['user_name'];
        }
        else 
        {
            header('Location:login.php');
        }
    ?>
<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top" style="background-color: #122b40;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">GTAE</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index_home.php">Add</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../print/view.php">View</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../upload/upload.php">Upload signed</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- Header -->
    

     <section id="sign" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Upload Signed Document</h2>
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
            </div>
            </div>
    </section>
    

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/agency.min.js"></script>

</body>

</html>
