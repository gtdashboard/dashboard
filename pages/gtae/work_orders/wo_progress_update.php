<?php

    require '../db.php';

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
<?php $title="WO Progress";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
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
            $wo_current_sum="select sum(progress_points) as current_total from wo_progress,wo_weightage where wo_progress.wo_id=$woid and wo_progress.activity_id=wo_weightage.id" ;
            //echo $wo_sum;
            $result_wo=$db_handle->runQuery($wo_current_sum);
            if(!empty($result_wo))
            {
                foreach($result_wo as $row)
                {
                    $current_total=$row['current_total'];
                }
            }
            if($current_total==null)
            {
                $current_total=0;
                $percent=0;
            }
            else {
                $percent=($current_total/$total)*100;
                $percent= round($percent,2);
            }
        ?>
        <tr>
            <th>#</th>
            <th>Activity</th>
            <th>Value</th>
            <th>Current Points</th>
            <th>Given Points</th>
            <th></th>
        </tr>
        <?php
        $wo_p="SELECT wo_progress.id as pid,wo_weightage.id as id,activity,points,progress_points"
                . " FROM wo_progress,wo_weightage WHERE wo_id =$woid and wo_weightage.id=wo_progress.activity_id ";
        $result_p=$db_handle->runQuery($wo_p);
        //echo $wo_p;
        if(!empty($result_p))
        {
            $i=0;
            foreach($result_p as $row)
            {
                $i=$row['id'];
                $pid=$row['pid'];
                $act=$row['activity'];
                $point=$row['points'];
                $progress_points=$row['progress_points'];
                echo "<tr>";
                echo   "<td><label>$i</label></td>";
                echo   "<td><label>$act</label></td>";
                echo   "<td><input type='range' min='0' max='$point' value='$progress_points' class='slider' id='count$i'"
                        . "oninput='showVal(this.value,$i)' onchange='showVal(this.value,$i)'></td>";
                echo   "<td><label id='current$i'>$progress_points</label></td>";
                echo   "<td><label id='tp$i'>$point</label></td>";
                
                echo    "<td><button class='btn' id='add$i' onclick='add_progress($i,$pid)'><i class='fa fa-plus'></i></button></td>";
                echo   "<td><input type='hidden' id='last$i' value='$progress_points' /></td>"
                    . "<td><input type='hidden' id='loaded$i' value='0' /></td>"
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
                <td><label id="percent"><?php echo $percent;?>%</label></td>
            </tr>
        </tfoot>
       </table>
            
        </div>
        </div>
    </div>
    </div>
   
    </section>
    </div>
  </div>
</div>
<?php require '../scripts.php';?>
<script>
function UpdateCurrent(id){
       
        var val=document.getElementById('count'+id).value
        document.getElementById('current'+id).textContent=val;
        var ctotal=document.getElementById('current_total').textContent
        var total=document.getElementById('total').textContent
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
        
        var per=(ct/t)*100;
        per=parseFloat(per).toFixed(2);
        document.getElementById("percent").textContent=per+"%"
    }
function showVal(val,id)
{
    if((document.getElementById("add"+id).disabled == true)||(document.getElementById('loaded'+id).value==0))
    {
        document.getElementById('loaded'+id).value=1
        var last=document.getElementById('last'+id).value
        var ctotal=document.getElementById('current_total').textContent
        var total=document.getElementById('total').textContent
        ct=parseInt(ctotal);
        t=parseInt(total);
        
        ct=ct-last
        document.getElementById('current_total').textContent=ct
        var per=(ct/t)*100;
        per=parseFloat(per).toFixed(2);
        document.getElementById("percent").textContent=per+"%"
        
        document.getElementById("add"+id).disabled = false
    }
    document.getElementById('current'+id).textContent=val;
}
</script>
<script>
function add_progress(id,pid)
{
    var val=document.getElementById('count'+id).value
    console.log("Value = "+val);
    $.ajax({
	type: "POST",
	url: "progress_update_db.php?p_id="+pid+"&points="+val,
	beforeSend: function(){
            console.log("before sending progress id="+pid);
	},
	success: function(data){
            console.log("After->success");
            console.log("Data="+data);
            if(data==1)
            {
                UpdateCurrent(id)
            }
	}
                
	});
}
</script>
</body>
</html>
