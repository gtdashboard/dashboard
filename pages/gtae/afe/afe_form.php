<!DOCTYPE html>
<html>
<?php $title="AFE Form";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
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
              <h3 class="box-title">AFE Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afe_preview.php" method="post">
              <div class="box-body">
                   <div class="checkbox">
                  <label>
                         <input type="checkbox" value="additional" name="additional"> Additional AFE
                  </label>
                </div>
                  <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                  <label for="exampleInputEmail1">AFE No.</label>
                  <input type="text" class="form-control" name="afe_no" placeholder="Optional">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">MPR/RSC/RSO/REV No.</label>
                  <input type="text" class="form-control" name="mpr" placeholder="Enter details">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Choose Project Number</label>
                <select class="form-control" id="pno" name="pno" onchange="test()">
                <?php
                    require '../db.php';
                    $db_handle=new DBController($p);
                    $basic="SELECT pno,project FROM general";
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
                                $ptitle=$row['project'];
                            }
                        }
                    }
                ?>
                </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Project Title</label>
                  <input type="text" class="form-control" id="ptitle" name="ptitle" value="<?php echo $ptitle;?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Expense Head (Budget)</label>
                  <select class="form-control" id="expense" name="expense">
                    <?php
                    $basic="SELECT * FROM `budget` ORDER BY budget_info ASC ";
                    $result_basic=$db_handle->runQuery($basic);
                    if(!empty($result_basic))
                    {
                        foreach ($result_basic as $row)
                        {
                            echo "<option value='".$row['budget_info']."&nbsp; &nbsp;(".$row['budget_index'].")'>".$row['budget_info']."  &nbsp; &nbsp;(".$row['budget_index'].")</option>";
                        }
                    }
                      ?>
                  </select>
                 
                </div>
                 
                <div class="form-group">
                  <label for="exampleInputPassword1">AFE Amount</label>
                  <input type="text" class="form-control" id="amount" name="amount" placeholder="digits only">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nature Of Expense :</label>
                <div class="checkbox">
                  <label>
                      <input type="checkbox" value="service" name="nature[]"> Service
                  </label>
                </div>
                    <div class="checkbox">
                    <label>
                    <input type="checkbox" value="material" name="nature[]"> Material Supply
                  </label>
                    </div>
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" value="contract" name="nature[]"> Sub Contract
                  </label>
                  </div>
                  <div class="checkbox">
                  <label>
                         <input type="checkbox" value="capital" name="nature[]"> Capital Expenditure
                  </label>
                </div>
                  <div class="checkbox">
                     <label>
                    <input type="checkbox" value="other" name="nature[]"> Other
                  </label>
                </div>
              </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Expected to spend till end of the project</label>
                  <input type="text" class="form-control" name="expected">
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
    <!-- /.container -->
  </div>
</div>
<?php require '../scripts.php';?>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
function test()
{
    var pno=document.getElementById("pno").value;
    var ptitle=document.getElementById("ptitle");
    
    if(pno=="104")
    {
        
        document.getElementById("ptitle").value="Construction of Flowlines & Associated works in West Kuwait Area"
    }
    else if(pno=="105")
    {
        document.getElementById("ptitle").value="Construction of Flowlines & Associated works in North Kuwait Area"
    }
  /*  var dataString = 'date_selected='+dt+'&opt='+opt;
    $.ajax({
	type: "POST",
	url: "../update/update_existing_db.php",
	data:dataString,
	beforeSend: function(){
		$("#login").val("Connecting....");
	},
	success: handleData
	});*/
}
</script>
</body>
</html>
