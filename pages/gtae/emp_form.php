<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DashBoard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
</head>
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
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
function setDetails(id)
{
    console.log("hi");
    $.ajax({
	type: "POST",
	url: "emp_details.php?key="+id,
	beforeSend: function(){
		
	},
	success: handleData
	});
}
function handleData(data)
{
    JSON.parse(data, (key, value) => {
        if(key=='emp_name')
        {
            console.log(value);
            document.getElementById("ename").textContent=value
        }
        if(key=='civil_id')
        {
            console.log(value);
            document.getElementById("resNo").textContent=value
        }
        if(key=='pass_no')
        {
            console.log(value);
            document.getElementById("passNo").textContent=value
        }
        if(key=='pass_no')
        {
            console.log(value);
            document.getElementById("passNo").textContent=value
        }
        if(key=='designation')
        {
            console.log(value);
            document.getElementById("des").textContent=value
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
                document.getElementById("resDate").textContent=final
                console.log("Day:"+final);
            }
            else
            {
                document.getElementById("resDate").textContent='';
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
                document.getElementById("gateDate").textContent=final
                console.log("Day:"+final);
            }
            else
            {
                document.getElementById("gateDate").textContent='';
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
                document.getElementById("dob").textContent=final
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
                document.getElementById("jd").textContent=final
                console.log("Day:"+final);
            }
        }
        if(key=='pno')
        {
            console.log(value);
            document.getElementById('pno').textContent=value;
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
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

   <?php require 'header.php';?>
    <?php
    $eno='';
    if(isset($_REQUEST['eno']))
    {
        $eno=$_REQUEST['eno'];
        echo "<script type='text/javascript'>setDetails($eno);</script>";
    }
    ?>
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
              <h3 class="box-title">Employee Data Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="emp_db.php" method="post">
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
