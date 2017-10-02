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
  
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
              <div class="box-body">
                <!-- /.form group -->
                <div class="form-group">
                    <div class="row">
                    <div class="col-xs-6">
                    <label for="exampleInputEmail1">Employee Id.</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="eno" id="eno" placeholder="Enter Employee id" value="<?php echo $eno;?>">
                    </div>
                    </div>
                </div>
                <br/>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label for="exampleInputPassword1">Employee Name</label>
                  </div>
                  <div class="col-xs-6">
                  <label  name="ename" id="ename"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                   <label for="exampleInputPassword1">Designation</label>
                  </div>
                  <div class="col-xs-6">
                  <label name="des" id="des"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                   <label for="exampleInputPassword1">Date of Birth</label>
                  </div>
                  <div class="col-xs-6">
                  <label  name="dob" id="dob"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label for="exampleInputPassword1">Join Date</label>
                  </div>
                  <div class="col-xs-6">
                  <label  name="jd" id="jd"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label for="exampleInputPassword1">Project</label>
                  </div>
                  <div class="col-xs-6">
                   <label  id="pno" name="pno" ></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label for="exampleInputPassword1">Residency No.</label>
                  </div>
                  <div class="col-xs-6">
                   <label  id="resNo" name="resNo"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label for="exampleInputPassword1">Passport No.</label>
                  </div>
                  <div class="col-xs-6">
                  <label  id="passNo" name="passNo"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label>Gate Pass Expiry:</label>
                  </div>
                  <div class="col-xs-6">
                 <label  id="gateDate" name="gateDate"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-6"> 
                  <label>Residency Expiry:</label>
                  </div>
                  <div class="col-xs-6">
                 <label  id="resDate" name="resDate"></label>
                  </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
         <div class="col-md-3"></div>
      </div>
    </section>
    </div>
  </div>
</div>
<script>
        $("#eno").keyup(function(){
        var id=document.getElementById("eno").value;
        console.log("id eno");
        console.log(id);
        setDetails(id);
        });
</script>


</body>
</html>
