<?php

    require 'db.php';
    $db_handle=new DBController();
    $wo=$_REQUEST['wo'];
    //$wo='FLN/16053333/005';
    $basic="SELECT * FROM `boq_item`,boq WHERE boq_item.wo_no='$wo' AND (boq.serial_boq=boq_item.item_id)";
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
        <h3 class="box-title">Work Order Materials(<?php echo $wo;?>)</h3>
        </div>
        <div class="box-body">
        <table class="table table-bordered" id="table3">
        <tr>
            <th>Serial Number</th>
            <th>Item Name</th>
            <th style="width: 40px">SP</th>
            <th>Arabi Qty</th>
            <th>KOC Qty</th>
            <th>Rem Qty</th>
            <th>WO Amount</th>
            <th>Rem Amount</th>
            <th></th>
        </tr>
        <?php
         if(!empty($result_basic))
            {
                $i=0;
                $total_wo_sum=0;
                $total_rem_sum=0;
                foreach($result_basic as $row)
                {
                    $i++;
                    $id_boq=$row['id_boq_item'];
                    $s=$row['serial_boq'];
                    $item=$row['item'];
                    $sp=$row['sp'];
                    $rem=$row['rem_qty'];
                    $arab=$row['arabi_qty'];
                    $koc=$row['koc_qty'];
                    $total_wo=$sp*$arab;
                    $total_wo_sum+=$total_wo;
                    $total_rem=$sp*$rem;
                    $total_rem_sum+=$total_rem;
        ?>        
        <tr>
            <td><label name='serial<?php echo $i;?>' id="serial<?php echo $i;?>"><?php echo $s;?></label></td>
            <td><label name='item<?php echo $i;?>' id="item<?php echo $i;?>"><?php echo $item;?></label></td>
            <td><label name='sp<?php echo $i;?>' id="sp<?php echo $i;?>"><?php echo $sp;?></label></td>
            <td><input type="text" class="form-control" name="aqty<?php echo $i;?>" id="aqty<?php echo $i;?>" value="<?php echo $arab;?>" placeholder="Enter Qty" onkeyup="change_arab(<?php echo $i;?>)"></td>
            <td><input type="text" class="form-control" name="kqty<?php echo $i;?>" id="kqty<?php echo $i;?>" value="<?php echo $koc;?>" placeholder="Enter Qty" onkeyup="change_koc(<?php echo $i;?>)"></td>
            <td><input type="text" class="form-control" name="rqty<?php echo $i;?>"   id="rqty<?php echo $i;?>" value="<?php echo $rem;?>" placeholder="Enter Qty" onkeyup="change_rem(<?php echo $i;?>)"></td>
            <td><label name='total_wo<?php echo $i;?>' id="total_wo<?php echo $i;?>"><?php echo $total_wo;?></label></td>
            <td><label name='total_rem<?php echo $i;?>' id="total_rem<?php echo $i;?>"><?php echo $total_rem;?></label></td>
            <td><a class="btn" onclick="update_db(<?php echo $i;?>,<?php echo $id_boq;?>)"><i class="fa fa-plus fa-lg"></i></a></td>
            <td><a class="btn" onclick="del(this,<?php echo $id_boq;?>)"><i class="fa fa-trash-o fa-lg"></i></a></td>
        </tr>
            <?php
            //echo $rem;
                }
            
                }?>
        </table>
        </div>
        </form>
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
function del(element,id_del)
{
    console.log("del id is+"+id_del);
    $.ajax({
	type: "POST",
	url: "delete_boq_item.php?key="+id_del,
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
function update_db(id,id_boq)
{
    var arab=document.getElementById("aqty"+id).value;
    var koc=document.getElementById("kqty"+id).value;
    var rem=document.getElementById("rqty"+id).value;
    $.ajax({
	type: "POST",
	url: "update_boq_item.php?id_boq="+id_boq+"&arab="+arab+"&koc="+koc+"&rem="+rem,
        beforeSend: function(){
            console.log("Sending for update");
	},
	success: function(data){
            console.log(data);
            console.log("Update Success");
	}
	});
    
    
}
function change_arab(id)
{
    var arab=document.getElementById("aqty"+id).value;
    var sp=document.getElementById("sp"+id).textContent;
    var total=arab*sp;
    document.getElementById("total_wo"+id).textContent=parseFloat(total).toFixed(2);
    console.log("arab val is "+arab);
}
function change_koc(id)
{
    var koc=document.getElementById("kqty"+id).value;
    document.getElementById("aqty"+id).value=koc;
    var sp=document.getElementById("sp"+id).textContent;
    var total=koc*sp;
    document.getElementById("total_wo"+id).textContent=parseFloat(total).toFixed(2);
    console.log("koc val is "+koc);
}
function change_rem(id)
{
    var rem=document.getElementById("rqty"+id).value;
    var sp=document.getElementById("sp"+id).textContent;
    var total=rem*sp;
    document.getElementById("total_rem"+id).textContent=parseFloat(total).toFixed(2);
    console.log("rem val is "+rem);
}
function add3()
{
    var ctr3=document.getElementById("cwo").value;
    ctr3++;
    var eno = document.getElementById("eno").value;
    var item = document.getElementById("item").textContent;
    var sp = document.getElementById("sp").textContent;
    var aqty= document.getElementById("aqty").value;
    var kqty = document.getElementById("kqty").value;
    var rqty = document.getElementById("rqty").value;
    var total=0;
    var total_rem=0;
    if(aqty!=0)
    {
        total=sp*aqty;
    }
    if(kqty!=0)
    {
        total=sp*aqty;
    }
    if(rqty!=0)
    {
        total_rem=sp*aqty;
    }
    var newTr = '<tr><td id="no"><label>'+ ctr3 +'</label></td>\
            <td><label>'+ eno +'</label></td>\
            <td><label>'+ item +'</label></td>\
            <td><label>'+ sp +'</label></td>\
            <td><label>'+ aqty +'</label></td>\
            <td><label>'+ kqty +'</label></td>\
            <td><label>'+ rqty +'</label></td>\
            <td><label>'+ total +'</label></td>\
            <td><label>'+ total_rem +'</label></td>\
            <td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td></tr>';
    $('#table4 > tbody:first-child').append(newTr);
    console.log(newTr);
    $('#cwo').val(ctr3);
}

</script>
<script>
$("#eno").keyup(function(){
        
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
            document.getElementById("item").textContent=value
        }
        if(key=='sp')
        {
            console.log(value);
            document.getElementById("sp").textContent=value
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

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>
</html>
