<?php

    require 'db.php';

    $db_handle=new DBController();
    $wo=$_REQUEST['wo'];
    session_start();
    $_SESSION['wo']=$wo;
    $wo_no="SELECT id_wo FROM `wo_numbers` where work_order_no='$wo'";
    $result_wo_no=$db_handle->runQuery( $wo_no);
    if(!empty($result_wo_no))
    {
        foreach ($result_wo_no as $row)
        {
            $woid=$row['id_wo'];
        }
        $_SESSION['woid']=$woid;
    }
    $basic="SELECT * FROM `wo_weightage`";
    $result_basic=$db_handle->runQuery($basic);
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
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
    <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Progress of Activities(<?php echo $wo;?>)</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table4">
        <?php
            $wo_sum="select sum(points) as total from wo_progress,wo_weightage where wo_progress.wo_id=$woid and wo_progress.activity_id=wo_weightage.id" ;
            //echo $wo_sum;
            $result_wo=$db_handle->runQuery($wo_sum);
            if(!empty($result_wo))
            {
                foreach($result_wo as $row)
                {
                    $total=$row['total'];
                }
            }
            if($total==null)
            {
                $total=0;
            }
        ?>
        <tr>
            <th>Activity</th>
            <th>Value</th>
            <th>Current Points</th>
            <th>Given Points</th>
            <th></th>
        </tr>
        <?php
        $current_total=0;
        $wo_p="SELECT * FROM wo_progress,wo_weightage WHERE wo_id =$woid and wo_weightage.id=wo_progress.activity_id ";
        $result_p=$db_handle->runQuery($wo_p);
        //echo $wo_p;
        if(!empty($result_p))
        {
            $i=0;
            foreach($result_p as $row)
            {
                $i=$row['id'];
                $act=$row['activity'];
                $point=$row['points'];
                $progress_points=$row['progress_points'];
                echo "<tr>";
                echo   "<td><label>$act</label></td>";
                echo   "<td><input type='range' min='0' max='$point' value='$progress_points' class='slider' id='count$i'"
                        . "oninput='showVal(this.value,$i)' onchange='showVal(this.value,$i)'></td>";
                echo   "<td><label id='current$i'>$progress_points</label></td>";
                echo   "<td><label id='tp$i'>$point</label></td>";
                
                echo    "<td><button class='btn' id='add$i' onclick='UpdateCurrent($i)'><i class='fa fa-plus'></i></button></td>";
                echo   "<td><input type='hidden' id='last$i' value='0' /></td>"
                        . "</tr>";
        ?>
        
        <?php 
            }
        }  
        ?>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td><label id="current_total"><?php echo $current_total; ?></label></td>
                <td><label id="total"><?php echo $total; ?></label></td>
                <td><label id="percent">0%</label></td>
            </tr>
        </tfoot>
       </table>
            
        </div>
        </div>
    </div>
    </section>
    </div>
  </div>
</div>

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
</script>
<script>
    function UpdateCurrent(id){
        var val=document.getElementById('count'+id).value
        document.getElementById('current'+id).textContent=val;
        var ctotal=document.getElementById('current_total').textContent
        var total=document.getElementById('current_total').textContent
        ct=parseInt(ctotal);
        t=parseInt(total);
        console.log("ctotal = "+ctotal);
        console.log("ct = "+ct);
        console.log("val = "+val);
        var v=parseInt(val)
        ct = ct+v;
        document.getElementById('current_total').textContent=ct
        document.getElementById('last'+id).value=v
        document.getElementById("add"+id).disabled = true;
        
        var per=(ct/t);
        console.log("per = "+per);
        document.getElementById("percent").textContent=per+"%"
    }
    function showVal(val,id){
        if(document.getElementById("add"+id).disabled == true)
        {
            var last=document.getElementById('last'+id).value
            var ctotal=document.getElementById('current_total').textContent
            ct=parseInt(ctotal);
            ct=ct-last
            document.getElementById('current_total').textContent=ct
            document.getElementById("add"+id).disabled = false
        }
        document.getElementById('current'+id).textContent=val;
    }
</script>
<script>
function del(element,id)
{
    var total=document.getElementById("total").textContent;
    var point= document.getElementById("point"+id).textContent;
    var t=parseInt(total);
    var p=parseInt(point);
    t=t-p;
    document.getElementById("total").textContent=t
    console.log("del id is+"+id);
    $.ajax({
	type: "POST",
	url: "delete_activity_db.php?key="+id,
        beforeSend: function(){
            console.log("Sending for delete");
	},
	success: function(data){
            console.log(data);
            console.log("Deleted Success");
            $(element).closest("tr").remove();
	}
	});
}
function add3(data,id)
{
    console.log("id = "+id);
    console.log("Data = "+data);
    if(data==1)
    {
            var total=document.getElementById("total").textContent;
            var act = document.getElementById("act"+id).textContent;
            var point= document.getElementById("point"+id).textContent;
            var t=parseInt(total);
            var p=parseInt(point);
            t=t+p;
            console.log("total = "+t)
            var newTr = '<tr>\
                    <td><label>'+ act +'</label></td>\
                    <td><label>'+ point +'</label></td>\
                    <td><a class="btn" onclick="del(this,'+ id +')"><i class="fa fa-trash-o"></i></a></td></tr>';
            $('#table4 > tbody:last-child').append(newTr);
            console.log(newTr);
            document.getElementById("total").textContent=t
    }
}
function add(id)
{
    $.ajax({
	type: "POST",
	url: "wo_activity_db.php?act_id="+id,
	beforeSend: function(){
            console.log("before sending id="+id);
	},
	success: function(data){
            console.log("After->success");
            add3(data,id)
	}
                
	});
}
</script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>
</html>