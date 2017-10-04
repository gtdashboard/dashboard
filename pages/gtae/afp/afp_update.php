<!DOCTYPE html>
<html>
<?php $title="AFP";?>
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
              <h3 class="box-title">AFP Updation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afp_update_db.php" method="post">
              <div class="box-body">
                <!-- /.form group -->
                <div class="form-group">
                <label for="exampleInputEmail1">AFP Track Number</label>
                  <input type="text" class="form-control" name="eno" id="eno" placeholder="Enter Track ID">
                  <input type="hidden" class="form-control" name="afp_id" id="afp_id">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">AFP Title</label>
                  <input type="text" class="form-control"  name="ename" id="ename">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">MPR/RSC/RSO/REV No.</label>
                  <input type="text" class="form-control"  name="mpr" id="mpr">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">AFP Number</label>
                  <input type="text" class="form-control"  name="afp_no" id="afp_no">
                </div>
                
                
                
                
              <!-- /.box-body -->
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
    <!-- /.content -->
        
        
    </div>
    <!-- /.container -->
  </div>
</div>
<?php require '../scripts.php';?>
<script>
    $("#eno").keyup(function(){
        
        $.ajax({
	type: "POST",
	url: "afp_details.php?key="+$(this).val(),
	beforeSend: function(){
		console.log("Sending");
	},
	success: handleData
	});
    });

function handleData(data)
{
    JSON.parse(data, (key, value) => {
        if(key=='expense')
        {
            console.log(value);
            document.getElementById("ename").value=value
        }
        if(key=='id_afp')
        {
            console.log("afp_id = "+value);
            document.getElementById("afp_id").value=value
        }
        if(key=='mpr_details')
        {
            console.log(value);
            document.getElementById("mpr").value=value
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
</script>
</body>
</html>
