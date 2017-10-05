<?php require '../scripts.php';?>
<script>
function setDetails(id)
{
    console.log("hi");
    $.ajax({
	type: "POST",
	url: "wo_info.php?key="+id,
	beforeSend: function(){
		
	},
	success: handleData
	});
}
function handleData(data)
{
    console.log(data);
    
    if(data.length>5)
    {
        console.log(data.length);
        JSON.parse(data, (key, value) => {
        if(key=='value_wo')
        {
            console.log(value);
            document.getElementById("wo_val").value=value
        }
        if(key=='description')
        {
            console.log(value);
            document.getElementById("desc").value=value
        }
        if(key=='start_f')
        {
            console.log(value);
            document.getElementById("st").value=value;
        }
        if(key=='end_f')
        {
            console.log(value);
            document.getElementById("end").value=value;
            
        }
        if(key=='issue_f')
        {
            console.log(value);
            document.getElementById("issue").value=value;
        }
        if(key=='pno')
        {
            console.log(value);
            document.getElementById('pno').value=value;
        }
        
        });
    }
    else 
    {
        document.getElementById("wo_val").value=''
        document.getElementById("desc").value=''
        document.getElementById("st").value=''
        document.getElementById("end").value=''
        document.getElementById("issue").value=''
        document.getElementById('pno').value=''
    }
    console.log(data);
}
</script>
<!DOCTYPE html>
<html>
<?php $title="New WO";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
    <?php
    $wno='';
    if(isset($_REQUEST['wno']))
    {
        $wno=$_REQUEST['wno'];
        echo "<script type='text/javascript'>setDetails('$wno');</script>";
    }
    ?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
    <section class="content">
        <div class="row" style="align-content: center;">
        <!-- left column -->
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Work Order</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="wo_sum_db.php" method="post">
              <div class="box-body">
                  
              <!-- /.form group -->
                <div class="form-group">
                <label for="exampleInputEmail1">Project No</label>
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
                  <label for="exampleInputEmail1">WO Number</label>
                  <input type="text" class="form-control" name="wo_no" value='<?php echo $wno;?>' placeholder="WO Number" onkeyup="setDetails(this.value)" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">WO Value</label>
                  <input type="text" class="form-control"  name="wo_val" id="wo_val">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea class="form-control"  name="desc" id="desc"></textarea>
                </div>
                <div class="form-group">
                <label>Start Date:</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="st" name="st" autocomplete="off">
                </div>
                </div>
                <div class="form-group">
                <label>End Date</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="end" name="hd" autocomplete="off">
                </div>
                </div>
              <div class="form-group">
                <label>Issue Date</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="issue" name="issue" autocomplete="off">
                </div>
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
         <div class="col-md-2"></div>
      </div>
      <!-- /.row -->
    </section>
    </div>
  </div>
</div>

<script>
    //Date picker
    $('#st').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
    $('#end').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
    $('#issue').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
</script>
<script>
        $("#wo_no").keyup(function(){
        var id=document.getElementById("wo_no").value;
        console.log("id wno");
        console.log(id);
        setDetails(id);
        });
</script>
</body>
</html>
