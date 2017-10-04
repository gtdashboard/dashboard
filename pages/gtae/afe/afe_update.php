<!DOCTYPE html>
<html>
<?php $title="AFE";?>
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
              <h3 class="box-title">AFE Updation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="afe_update_db.php" method="post">
              <div class="box-body">
                <!-- /.form group -->
                <div class="form-group">
                <label for="exampleInputEmail1">AFE Track Number</label>
                  <input type="text" class="form-control" name="eno" id="eno" placeholder="Enter Track ID">
                  <input type="hidden" class="form-control" name="afe_id" id="afe_id">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">AFE Title</label>
                  <input type="text" class="form-control"  name="ename" id="ename">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">MPR/RSC/RSO/REV No.</label>
                  <input type="text" class="form-control"  name="mpr" id="mpr">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">AFE Number</label>
                  <input type="text" class="form-control"  name="afe_no" id="afe_no">
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
	url: "afe_details.php?key="+$(this).val(),
	beforeSend: function(){
		
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
        if(key=='id_afe')
        {
            console.log("afe_id = "+value);
            document.getElementById("afe_id").value=value
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
