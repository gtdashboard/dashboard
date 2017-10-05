<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php $title="WO Status";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
    <section class="content">
    <div class="row" style="align-content: center;">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Work Order Status Update</h3>
        </div>
            <form role="form" action="wo_status_db.php" method="post">
        <div class="box-body">
        <div class="form-group">
        <label for="exampleInputEmail1">Choose Project Number</label>
        <select class="form-control" id="pno" name="pno">
        <?php
            require '../db.php';
            $db_handle=new DBController($p);
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
             $val='';
            if(isset($_REQUEST['wo_no']))
            {
                $val=$_REQUEST['wo_no'];
            }
        ?>
        </select>
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Choose Work Order Number</label>
        <select class="form-control" name="wo" id="wo" selected='<?php echo $val;?>'>
        <?php
        $basic="SELECT distinct(work_order_no) FROM wo_numbers WHERE pno=$p";
        $result_basic=$db_handle->runQuery($basic);
        if(!empty($result_basic))
        {
            foreach ($result_basic as $row)
            {
                $wno=$row['work_order_no'];
                if(strcmp($wno,$val)==0)
                { 
                    echo "<option value='$wno' selected='selected'>$wno </option>";
                    
                }
                else {
                    echo "<option value='$wno' >$wno </option>";
                }
                
            }
        }
        ?>
        </select>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Select Status</label>
        <select class="form-control" id="status" name="status">
            <option value='0'>Issued</option>
            <option value='1'>Commenced</option>
            <option value='2'>Invoiced</option>
            <option value='3'>Handed Over</option>
            <option value='4'>On hold</option>
            <option value='5'>Cancelled</option>   
        </select>
        </div>
        <div class="form-group">
            <label>Date:</label>
            <div class="input-group date">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker" name="dt" autocomplete="off">
            </div>
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Update</button>
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
<?php require '../scripts.php';?>
<script>
 //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
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
