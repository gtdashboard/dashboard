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
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    
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
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" name="'+ wo +'" class="form-control"/></td><td><textarea row="20" cols="25" name="'+ tn +'"></textarea></td><td><textarea row="10" cols="17" name="'+ rf +'"></textarea></td><td><input type="text" class="form-control" placeholder="AG" name="' + ag + '" value="0"/></td><td><input type="text" placeholder="UG" class="form-control" name="'+ ug +'" value="0"/></td><td><textarea row="5" cols="17" name="'+ ow +'"></textarea></td></tr>';
    
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
        if(isset($_SESSION["user_name"])) 
        {
            $name=$_SESSION['user_name'];
        }
        else 
        {
            header('Location:../login.php');
        }
        if(isset($_REQUEST["dt"])) 
        {
            
        }
        else {
            header("Location:../print/view.php");
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
                        <a class="page-scroll" href="../index_home.php">Home</a>
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
            <form action="work_order_insert.php?dt=<?php echo $_GET['dt'];?>" method="post">
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
                        require '../db.php';
                        $p=$_SESSION['project'];
                        $db_handle=new DBController();
                         if(isset($_GET['dt']))
                        {
                            $dt=$_GET['dt'];
                        }
                        $query="select * from work_order,wo_numbers where DATE(date_done) = '$dt' and wo_no=id_wo and work_order.pno=$p";
                        $result=$db_handle->runQuery($query);
                        $query2="select * from site_info where date_site = '$dt' and pno=$p";
                        $result2=$db_handle->runQuery($query2);
                        if(empty($result))
                        {
                             $query="select * from work_order,wo_numbers where DATE(date_done) = (select max(date_done) from work_order where pno=$p) and wo_no=id_wo and work_order.pno=$p";
                             $result=$db_handle->runQuery($query);
                             $query2="select * from site_info where date_site = (select max(date_site) from site_info where pno=$p) and pno=$p";
                             $result2=$db_handle->runQuery($query2);
                        }
                       
                        $i=0;
                        if(!empty($result))
                        {
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
                        }
                    $c=$i;
                    $inst='';
                    $acc='';
                    $rem='';
                    if(!empty($result2))
                    {
                        foreach ($result2 as $row2)
                        {
                            $inst=$row2['instruction'];
                            $acc=$row2['accidents'];
                            $rem=$row2['remarks'];
                        }
                    }
                    
                    ?>
                    </tbody>
                </table>
                <input type="hidden" name="cwo" id="cwo" value="<?php echo $c;?>"/>
                <a onclick="add3()" class="btn btn-primary">Add Row</a>
               
                </div>
                    <br/>
                    <br/>
                <div class="container" >
                <label style="color:blue;font-weight:bold;text-align: center;">
                    Site Instruction/Changes in Issued Work Order</label>
                    <hr>
                <textarea style="width: 100%" cols="5" name="instructions"><?php echo $inst;?></textarea>
                
                
                <label style="color:blue;font-weight:bold;text-align: center;">Safety Aspects,Accidents</label>
                <textarea style="width: 100%" cols="5" name="accidents"><?php echo $acc;?></textarea>
                
             
                <label style="color:blue;font-weight:bold;text-align: center;">Remarks Workshop</label>
                <textarea style="width: 100%" cols="5" name="remarks"><?php echo $rem;?></textarea>
                </div>
            <button class="btn btn-primary" style="width:90%; margin-top: 2%;margin-left: 4%;">Submit</button>
            </form>
               
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
