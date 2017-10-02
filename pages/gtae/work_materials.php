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
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Work Order Materials</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afe_preview.php" method="post">
                <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="table3">
                <tr>
                  <th>#</th>
                  <th>Serial Number</th>
                  <th>Item Name</th>
                  <th style="width: 40px">SP</th>
                  <th>Arabi Qty</th>
                  <th>KOC Qty</th>
                  <th>Rem Qty</th>
                  <th></th>
                </tr>
                <tr>
                  <td id="no"><label>1</label></td>
                  <td><input type="text" class="form-control" name="eno1" id="eno1" placeholder="Enter Item ID"></td>
                  <td><label name='item1' id="item1"></label></td>
                  <td><label name='sp1' id="sp1"></label></td>
                  <td><input type="text" class="form-control" name="aqty1"  placeholder="Enter Qty"></td>
                  <td><input type="text" class="form-control" name="kqty1"  placeholder="Enter Qty"></td>
                  <td><input type="text" class="form-control" name="rqty1"  placeholder="Enter Qty"></td>
                  <td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td>
                </tr>
            </table>
                <?php $c=1;?>
                <input type="hidden" name="cwo" id="cwo" value="<?php echo $c;?>"/>
                <a onclick="add3()" class="btn"><i class="fa fa-plus-circle fa-lg"></i></a>
            </div>
            <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
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
function add3()
{
    var ctr3=document.getElementById("cwo").value;
    ctr3++;
    var no = "no" + ctr3;
    var eno = "eno" + ctr3;
    var eid="#eno"+ctr3;
    var item = "item" + ctr3;
    var sp = "sp" + ctr3;
    var aqty= "aqty" + ctr3;
    var kqty = "kqty" + ctr3;
    var rqty = "rqty" + ctr3;
    var newTr = '<tr><td id="no"><label id="'+ no +'">'+ ctr3 +'</label></td>\
            <td><input type="text" class="form-control" name="'+ eno +'" id="'+ eno +'" placeholder="Enter Item ID"></td>\
            <td><label name="'+ item +'" id="'+ item +'"></label></td>\
            <td><label name="'+ sp +'" id="'+ sp +'"></label></td>\
            <td><input type="text" class="form-control" name="'+ aqty +'"  placeholder="Enter Qty"></td>\
            <td><input type="text" class="form-control" name="'+ kqty +'"  placeholder="Enter Qty"></td>\
            <td><input type="text" class="form-control" name="'+ rqty +'" placeholder="Enter Qty"></td>\
             <td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td></tr>';
    $('#table3 > tbody:last-child').append(newTr);
    console.log(newTr);
    $('#cwo').val(ctr3);
    
    //jquery
    
    $(eid).keyup(function(){
        
        $.ajax({
	type: "POST",
	url: "get_item_detail.php?key="+$(this).val(),
	beforeSend: function(){
		
	},
	success: function(data) {
                JSON.parse(data, (key, value) => {
                    if(key=='item')
                    {
                        console.log(value);
                        document.getElementById(item).textContent=value
                    }
                    if(key=='sp')
                    {
                        console.log(value);
                        document.getElementById(sp).textContent=value
                    }
        
    });
            }
	});
    });
    
    
}


</script>
<script>
$("#eno1").keyup(function(){
        
        $.ajax({
	type: "POST",
	url: "get_item_detail.php?key="+$(this).val(),
	beforeSend: function(){
		
	},
	success: handleData
	});
    });
function handleData(data)
{
    JSON.parse(data, (key, value) => {
        if(key=='item')
        {
            console.log(value);
            document.getElementById("item1").textContent=value
        }
        if(key=='sp')
        {
            console.log(value);
            document.getElementById("sp1").textContent=value
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

function del(element)
{
  
    $(element).closest("tr").remove();
    
}
</script>
 
</body>
</html>
