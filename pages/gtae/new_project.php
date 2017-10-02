<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AFE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <section class="content">
        <div class="row" style="align-content: center;">
        <!-- left column -->
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Project</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afe_preview.php" method="post">
              <div class="box-body">
                  
              <!-- /.form group -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Internal Ref. No.</label>
                  <input type="text" class="form-control" name="irn" placeholder="Enter details">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Project Title</label>
                  <input type="text" class="form-control" id="ptitle" name="ptitle" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Client</label>
                  <input type="text" class="form-control" id="client" name="client" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Project Location</label>
                  <input type="text" class="form-control" id="ploc" name="ploc" >
                </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Contract No.</label>
                  <input type="text" class="form-control" id="cno" name="cno" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contract Value</label>
                  <input type="text" class="form-control" id="cno" name="cno" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contract Period</label>
                  <input type="text" class="form-control" id="cno" name="cno" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">CGC Scope</label>
                  <input type="text" class="form-control" id="cno" name="cno" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mob Period</label>
                  <input type="text" class="form-control" id="cno" name="cno" >
                </div>
                <div class="form-group">
                <label>Commence Date:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" autocomplete="off">
                    </div>
                </div>
              <div class="form-group">
                <label>Finish Date:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="text" class="form-control pull-right" id="datepicker2" name="datepicker2" autocomplete="off">
                    </div>
                </div>
              <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
    $('#datepicker2').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
</script>
</body>
</html>
