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
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    
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
function del(element)
{
    $(element).closest("tr").remove();
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
                    <li >
                        <a class="page-scroll" href="staff_daily.php">Staff</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="skilled1_daily.php">Skilled1</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="skilled2_daily.php">Skilled2</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="unskilled_daily.php">Unskilled</a>
                    </li>
                    <li class="active">
                        <a class="page-scroll" href="equipment_daily.php">Equipments</a>
                    </li>
                     <li>
                        <a class="page-scroll" href="weather_daily.php">Weather</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index_home.php">Home</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- Header -->
    <?php 
            require '../db.php';
            $p=$_SESSION['project'];
            $db_handle=new DBController();
            if(isset($_GET['dt'])){
                $dt=$_GET['dt'];
            }
            else {
                header("Location:../print/view.php");
            }
            $query="SELECT * FROM equipment WHERE DATE( date_used ) =  '$dt' and pno=$p";
            $result2 = $db_handle->runQuery($query);
            if(empty($result2))
            {
                $query="SELECT * FROM equipment WHERE DATE( date_used ) = (SELECT max( date_used ) FROM equipment ) and pno=$p order by type asc ";
                $result2 = $db_handle->runQuery($query);
            }
        ?>
    <!-- About Section -->
    <section id="add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading">Equipment Report</h3>
                    <div class="container">
                        <form action="equip_insert.php?dt=<?php echo $dt;?>" method="post">
                    <div class="form-group">
                    <div class="container" id="form2">
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
                    $count_equip=0;
                    if(!empty($result2))
                    {
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
                    }
                    
                    //echo $count_equip;
                    ?>
                    
                    </tbody>
                </table>
                <input type="hidden" name="cequip" id="cequip" value="<?php echo $count_equip;?>" />
                <a onclick="add2()" class="btn btn-primary">Add Row</a>
            </div>
                    <button class="btn btn-primary login" style="width:100%;margin-top: 10px;">Submit</button>
                </div>
                </form>
                <br>
                <br>
                <div id="error" style="width: 100%;color: red"></div>
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
