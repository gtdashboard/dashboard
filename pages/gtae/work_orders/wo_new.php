<!DOCTYPE html>
<html>
<?php $title="New WO";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
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
                  <input type="text" class="form-control" name="wo_no" placeholder="WO Number">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">WO Value</label>
                  <input type="text" class="form-control"  name="wo_val" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea class="form-control"  name="desc" ></textarea>
                </div>
                <div class="form-group">
                <label>Start Date:</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="st" autocomplete="off">
                </div>
                </div>
                <div class="form-group">
                <label>End Date</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker2" name="hd" autocomplete="off">
                </div>
                </div>
              <div class="form-group">
                <label>Issue Date</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker3" name="issue" autocomplete="off">
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
         <div class="col-md-3"></div>
      </div>
      <!-- /.row -->
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
    $('#datepicker2').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
    $('#datepicker3').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
</script>
</body>
</html>
