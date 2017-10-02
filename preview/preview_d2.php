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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    
    <!-- Custom Fonts -->
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"  type="text/css"/> 
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js">
    </script>
    <!-- Theme CSS -->
    <link href="css/agency.css" rel="stylesheet">
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
           // $name=$_SESSION['user_name'];
        }
        else 
        {
            //header('Location:login.php');
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
                        <a class="page-scroll" href="#add">Add</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#update">Update</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#view">View</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#sign">Upload signed</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- Header -->
    <!-- About Section -->
    <section id="add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="section-heading">Work Order Report</h3>
                    <br/>
                    <div class="container">
           <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Work Order Number</th>
                    <th>Task Number</th>
                    <th>Foreman</th>
                    <th>AG</th>
                    <th>UG</th>
                    <th>Other Work</th>
                </tr>
            </thead>
        <?php
        require 'db.php';
        $p='sp_104';
        $db_handle=new DBController($p);
        if(isset($_GET['dt']))
        {
            $dt=$_GET['dt'];
        }
        $dt='2017-06-04';
        $count=$_POST['cwo'];
        $inst=$_POST['instructions'];
        $acc=$_POST['accidents'];
        $rem=$_POST['remarks'];
        if(isset($_POST['id_site']))
        {
            $id=$_POST['id_site'];
        }
        $query="select * from site_info where date_site='$dt'";
        $result=$db_handle->runQuery($query);
        if(empty($result))
        {
            $query2="insert into site_info(instruction,accidents,remarks,date_site) values ('$inst','$acc','$rem','$dt')";
            echo $query2;
            $result2=$db_handle->runUpdate($query2);
            if($result2)
            {
               //echo 'inserted work_order';
            }
        }
        else
        {
            $query2="UPDATE `site_info` SET `instruction`='$inst',`accidents`='$acc',`remarks`='$rem' WHERE date_site='$dt'";
            echo $query2;
            $result2=$db_handle->runUpdate($query2);
            if($result2)
            {
               //echo 'updated';
            }

        }
        for($i=1;$i<=$count;$i++)
        {
            if((isset($_POST['wo'.$i]))&&(isset($_POST['tn'.$i]))&&(isset($_POST['rf'.$i]))&&(isset($_POST['ag'.$i]))&&(isset($_POST['ug'.$i]))&&(isset($_POST['ow'.$i])))
            {
                $wo=$_POST['wo'.$i];
                $tn=$_POST['tn'.$i];
                $rf=$_POST['rf'.$i];
                $ag=$_POST['ag'.$i];
                $ug=$_POST['ug'.$i];
                $ow=$_POST['ow'.$i];
                if(isset($_POST['id_wo'.$i]))
                {
                    $id=$_POST['id_wo'.$i];
                }
        ?>
            <tr>
                <td><?php echo $wo;?></td>
                <td><?php echo $tn;?></td>
                <td><?php echo $rf;?></td>
                <td><?php echo $ag;?></td>
                <td><?php echo $ug;?></td>
                <td><?php echo $ow;?></td>
            </tr>
        <?php
            $query="select * from work_order where work_order_no='$wo' and date_done='$dt'";
            echo "<br>$query<br>";
            $result=$db_handle->runQuery($query);
            if(empty($result))
            {
                $query="insert into work_order(work_order_no,task_name,foreman,ag,ug,other_works,date_done) values ('$wo','$tn','$rf',$ag,$ug,'$ow','$dt')";
                echo $query;
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                    //echo 'inserted';
                }
            }
            else
            {
                foreach($result as $row)
                {
                    $id=$row['id_work_order'];
                }
                $query="UPDATE `work_order` SET work_order_no='$wo',`task_name`='$tn',`foreman`='$rf',`ag`=$ag,`ug`=$ug,`other_works`='$ow' WHERE id_work_order=".$id;
                echo "<br>$query<br>";
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                   //echo 'updated work_order';
                }
             }
          }
        }
        ?>
        </table>
                </div>
                    <div class="container" style="border: 1px solid black;"><h4>Site Instruction/Changes in Issued Work Order:</h4><?php echo $inst;?></div>
            <div class="container" style="border: 1px solid black;"><h4>Safety Aspects,Accidents:</h4><?php echo $acc;?></div>
            <div class="container" style="border: 1px solid black;"><h4>Remarks Workshop:</h4><?php echo $rem;?></div>
            <a href="print_page2_with_date.php?dt=<?php echo $dt;?>" class="btn btn-primary" style="width:100%;margin-bottom: 2%;margin-top: 2%;">Print</a>
        
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
