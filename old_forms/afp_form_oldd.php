<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AFP</title>
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
              <h3 class="box-title">AFP Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afp_preview.php" method="post">
              <div class="box-body">
                   <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                  <div class="form-group">
                  <label for="exampleInputEmail1">AFP No.</label>
                  <input type="text" class="form-control"  name="afp_no" placeholder="Enter details">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">MPR/RSC/RSO/REV No.</label>
                  <input type="text" class="form-control" name="mpr" placeholder="Enter details">
                </div>
                  <div class="form-group">
                  <label>Project/Department</label>
                  <select class="form-control" id="pno" name="pno" onchange="test()">
                      <option value="104">SP 104</option>
                      <option value="105">SP 105</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Project Title</label>
                  <input type="text" class="form-control" id="ptitle" name="ptitle" value="Construction of Flowlines & Associated Works in West Kuwait Area">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Expense Head (Budget)</label>
                  <select class="form-control" id="expense" name="expense">
                      <?php
                    require 'db.php';
                    $db_handle=new DBController($p);
                    $basic="SELECT * FROM `budget` ORDER BY budget_info ASC ";
                    $result_basic=$db_handle->runQuery($basic);
                    if(!empty($result_basic))
                    {
                        foreach ($result_basic as $row)
                        {
                            echo "<option value='".$row['budget_info']."&nbsp; &nbsp;(".$row['budget_index'].")'>".$row['budget_info']."  &nbsp; &nbsp;(".$row['budget_index'].")</option>";
                        }
                    }
                      ?>
                  </select>
                 
                </div>
                 
                <div class="form-group">
                  <label for="exampleInputPassword1">AFE Amount</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="afe_amount" placeholder="Digits Only">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nature Of Expense :</label>
                <div class="checkbox">
                  <label>
                      <input type="checkbox" value="service" name="nature[]"> Service
                  </label>
                </div>
                    <div class="checkbox">
                    <label>
                    <input type="checkbox" value="material" name="nature[]"> Material Supply
                  </label>
                    </div>
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" value="contract" name="nature[]"> Sub Contract
                  </label>
                  </div>
                  <div class="checkbox">
                     <label>
                         <input type="checkbox" value="capital" name="nature[]"> Capital Expenditure
                  </label>
                </div>
                  <div class="checkbox">
                     <label>
                    <input type="checkbox" value="other" name="nature[]"> Other
                  </label>
                </div>
              </div>
                  <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="partial" name="payment[]"> Partial Payments
                  </label>
                </div>
                    <div class="checkbox">
                    <label>
                    <input type="checkbox" value="final" name="payment[]"> Final Payments
                  </label>
                    </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Previous Payments</label>
                  <input type="text" class="form-control" name="previous_pay">
                </div>
              </div>
                   <div class="form-group">
                  <label for="exampleInputPassword1">Amount to be paid</label>
                  <input type="text" class="form-control" name="amount">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Pay To</label>
                  <input type="text" class="form-control" name="pay_to">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Remarks</label>
                  <input type="text" class="form-control" name="remarks">
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
     function test()
{
    var pno=document.getElementById("pno").value;
    var ptitle=document.getElementById("ptitle");
    
    if(pno=="104")
    {
        
        document.getElementById("ptitle").value="Construction of Flowlines & Associated works in West Kuwait Area"
    }
    else if(pno=="105")
    {
        document.getElementById("ptitle").value="Construction of Flowlines & Associated works in North Kuwait Area"
    }
  /*  var dataString = 'date_selected='+dt+'&opt='+opt;
    $.ajax({
	type: "POST",
	url: "../update/update_existing_db.php",
	data:dataString,
	beforeSend: function(){
		$("#login").val("Connecting....");
	},
	success: handleData
	});*/
}
</script>
</body>
</html>
