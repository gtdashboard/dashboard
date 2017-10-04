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
              <h3 class="box-title">Employee Data Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afe_preview.php" method="post">
              <div class="box-body">
                <!-- /.form group -->
                <div class="form-group">
                <label for="exampleInputEmail1">Employee Id.</label>
                  <input type="text" class="form-control" name="eno" id="eno" placeholder="Enter Employee id">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Employee Name</label>
                  <input type="text" class="form-control"  name="ename" id="ename">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Designation</label>
                  <input type="text" class="form-control"  name="des" id="des">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Date of Birth</label>
                  <input type="text" class="form-control"  name="dob" id="dob">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Join Date</label>
                  <input type="text" class="form-control"  name="jd" id="jd">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Project</label>
                  <select class="form-control" id="pno" name="pno" >
                      <?php
                       require 'db.php';

                        $db_handle=new DBController();
                        
                        $basic="SELECT distinct(pno) FROM employee";
                        $result_basic=$db_handle->runQuery($basic);
                        if(!empty($result_basic))
                        {
                            foreach($result_basic as $row)
                            {
                                echo "<option value='".$row['pno']."'>".$row['pno']."</option>";
                            }
                        }
                      ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Residency No.</label>
                  <input type="text" class="form-control" id="resNo" name="resNo">
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Passport No.</label>
                  <input type="text" class="form-control" id="passNo" name="passNo">
                </div>
                <div class="form-group">
                <label>Gate Pass Expiry:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" class="form-control pull-right" id="gateDate" name="gateDate">
                </div>
                <!-- /.input group -->
                </div>
                <div class="form-group">
                <label>Residency Expiry:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" class="form-control pull-right" id="resDate" name="resDate">
                </div>
                <!-- /.input group -->
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
    $('#gateDate').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
    $('#resDate').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
     function test()
{
    
}
    $("#eno").keyup(function(){
        
        $.ajax({
	type: "POST",
	url: "emp_details.php?key="+$(this).val(),
	beforeSend: function(){
		
	},
	success: handleData
	});
    });

function handleData(data)
{
    JSON.parse(data, (key, value) => {
        if(key=='emp_name')
        {
            console.log(value);
            document.getElementById("ename").value=value
        }
        if(key=='civil_id')
        {
            console.log(value);
            document.getElementById("resNo").value=value
        }
        if(key=='pass_no')
        {
            console.log(value);
            document.getElementById("passNo").value=value
        }
        if(key=='pass_no')
        {
            console.log(value);
            document.getElementById("passNo").value=value
        }
        if(key=='designation')
        {
            console.log(value);
            document.getElementById("des").value=value
        }
        if(key=='res_exp')
        {
            console.log(value);
            if(value!='0000-00-00')
            {
                var date=new Date(value);
                var day = date.getDate();
                var monthIndex = date.getMonth()+1;
                 if(monthIndex<=9)
                {
                    monthIndex='0'+monthIndex;
                }
                var year = date.getFullYear();
                var final=day+"."+monthIndex+"."+year;
                document.getElementById("resDate").value=final
                console.log("Day:"+final);
            }
            
            
        }
        if(key=='gate_pass_exp')
        {
            console.log(value);
            if(value!='0000-00-00')
            {
                var date=new Date(value);
                var day = date.getDate();
                var monthIndex = date.getMonth()+1;
                 if(monthIndex<=9)
                {
                    monthIndex='0'+monthIndex;
                }
                var year = date.getFullYear();
                var final=day+"."+monthIndex+"."+year;
                document.getElementById("gateDate").value=final
                console.log("Day:"+final);
            }
            
        }
        if(key=='dob')
        {
            console.log(value);
            if(value!='0000-00-00')
            {
                var date=new Date(value);
                var day = date.getDate();
                var monthIndex = date.getMonth()+1;
                 if(monthIndex<=9)
                {
                    monthIndex='0'+monthIndex;
                }
                var year = date.getFullYear();
                var final=day+"."+monthIndex+"."+year;
                document.getElementById("dob").value=final
                console.log("Day:"+final);
            }
        }
        if(key=='join_date')
        {
            console.log(value);
            if(value!='0000-00-00')
            {
                var date=new Date(value);
                var day = date.getDate();

                var monthIndex = date.getMonth()+1;
                if(monthIndex<=9)
                {
                    monthIndex='0'+monthIndex;
                }
                var year = date.getFullYear();
                var final=day+"."+monthIndex+"."+year;
                document.getElementById("jd").value=final
                console.log("Day:"+final);
            }
        }
        if(key=='pno')
        {
            console.log(value);
            document.getElementById('pno').value=value;
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
