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
        <!-- left column -->
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">AFP Updation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afe_preview.php" method="post">
              <div class="box-body">
                <!-- /.form group -->
                <div class="form-group">
                <label for="exampleInputEmail1">AFP Track Number</label>
                  <input type="text" class="form-control" name="eno" id="eno" placeholder="Enter Track ID">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">AFP Title</label>
                  <input type="text" class="form-control"  name="ename" id="ename">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">MPR/RSC/RSO/REV No.</label>
                  <input type="text" class="form-control"  name="mpr" id="mpr">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">AFP Number</label>
                  <input type="text" class="form-control"  name="afe_no" id="afe_no">
                </div>
                
                
                
                
              <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
         <div class="col-md-3"></div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
        
        
    </div>
    <!-- /.container -->
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
    $("#eno").keyup(function(){
        
        $.ajax({
	type: "POST",
	url: "afp_details.php?key="+$(this).val(),
	beforeSend: function(){
		
	},
	success: handleData
	});
    });

function handleData(data)
{
    JSON.parse(data, (key, value) => {
        if(key=='expense')
        {
            console.log(value);
            document.getElementById("ename").value=value
        }
        if(key=='mpr_details')
        {
            console.log(value);
            document.getElementById("mpr").value=value
        }
        
    });
    if(data.length>1)
    {
        console.log(data.length);
    }
    else 
    {
    }
    console.log(data);
}
</script>
</body>
</html>
