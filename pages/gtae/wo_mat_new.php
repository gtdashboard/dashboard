<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DashBoard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

 <?php require 'header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
    <section class="content">
    <div class="row" style="align-content: center;">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Work Order Material Details</h3>
        </div>
            <form role="form" action="new_wo_material.php" method="post">
        <div class="box-body">
        <div class="form-group">
        <label for="exampleInputEmail1">Choose Project Number</label>
        <select class="form-control" id="pno" name="pno">
        <?php
            require 'db.php';
            $db_handle=new DBController();
            $basic="SELECT pno FROM general";
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                $i=0;
                foreach ($result_basic as $row)
                {
                    $i++;
                    $pno=$row['pno'];
                    echo "<option value='$pno'>SP $pno</option>";
                    if($i==1)
                    {
                        $p=$pno;
                    }
                }
            }
        ?>
        </select>
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Choose Work Order Number</label>
        <select class="form-control" name="wo" id="wo">
        <?php
        $basic="SELECT distinct(work_order_no) FROM wo_numbers WHERE pno=$p";
        $result_basic=$db_handle->runQuery($basic);
        if(!empty($result_basic))
        {
            foreach ($result_basic as $row)
            {
                $wno=$row['work_order_no'];
                echo "<option value='$wno'>$wno</option>";
            }
        }
        ?>
        </select>
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
        </div>
        </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </section>
    </div>
    </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
$("#pno").change(function(){
        
        $.ajax({
	type: "POST",
	url: "wo_details2.php?key="+$(this).val(),
	beforeSend: function(){
            console.log("Sending..");
	},
	success: handleData
	});
});
function handleData(data)
{
    console.log("in handle data..");
    var select = document.getElementById('wo');
    if(data.length>1)
    {
        document.getElementById("wo").options.length = 0;
        JSON.parse(data, (key, value) => {
        if(key=='work_order_no')
        {
             var opt = document.createElement('option');
            opt.innerHTML = value;
            opt.value = value;
            select.appendChild(opt);
            console.log("wo:"+value);
        }
        });
        //console.log(data.length);
    }
    else 
    {
        document.getElementById("wo").innerHTML = "";
    }
}
</script>
</body>
</html>
