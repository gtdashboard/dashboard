<!DOCTYPE html>
<html>
<?php $title="WO Material";?>
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
        <h3 class="box-title">Work Order Material Details</h3>
        </div>
        <form role="form" action="wo_material_update.php" method="post">
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
        ?>
        </select>
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Choose Work Order Number</label>
        <select class="form-control" name="wo" id="wo">
        <?php
        $basic="SELECT distinct(wo_no) FROM boq_item WHERE pno=$p";
        $result_basic=$db_handle->runQuery($basic);
        if(!empty($result_basic))
        {
            foreach ($result_basic as $row)
            {
                $wno=$row['wo_no'];
                echo "<option value='$wno'>$wno</option>";
            }
        }
        ?>
        </select>
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
