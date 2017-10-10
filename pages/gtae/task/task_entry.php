<?php require '../scripts.php';?>
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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">New Task</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="task_db.php" method="post">
              <div class="box-body">
                <div class="form-group">
                <label for="exampleInputPassword1">Task Name</label>
                <textarea class="form-control" name="tname"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Action By</label>
                  <input type="text" class="form-control"  name="action">
                </div>
                <div class="form-group">
                <label>Deadline:</label>
                <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="dt" name="dt" autocomplete="off">
                </div>
                </div>
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
    $('#dt').datepicker({
      autoclose: true,
      format: 'dd.mm.yyyy'
    });
</script>
</body>
</html>
