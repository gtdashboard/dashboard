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
    console.log("Main Data"+data);
    
    if(data.length>5)
    {
        //console.log(data.length);
        JSON.parse(data, (key, value) => {
        if(key=='work_order_no')
        {
            //console.log(value);
            document.getElementById("wo_num").textContent=value
        }
        if(key=='value')
        {
            //console.log(value);
            document.getElementById("wo_val").textContent="KD "+value
        }
        if(key=='description')
        {
            //console.log(value);
            document.getElementById("desc").textContent=value
        }
        if(key=='start')
        {
            //console.log(value);
            document.getElementById("st").textContent=value;
        }
        if(key=='end')
        {
            //console.log(value);
            document.getElementById("end").textContent=value;
            
        }
        if(key=='issue')
        {
            //console.log(value);
            document.getElementById("issue").textContent=value;
        }
        if(key=='pno')
        {
            //console.log(value);
            document.getElementById('pno').textContent="SP "+value;
        }
        if(key=='status')
        {
            console.log(value);
            document.getElementById('status').textContent=value;
        }
        if(key=='commence_dt')
        {
            addStatus("Commenced",value)
        }
        if(key=='cancel_dt')
        {
            addStatus("Canceled",value)
        }
        if(key=='onhold_dt')
        {
            addStatus("Onhold",value)
        }
        if(key=='handover_dt')
        {
            addStatus("Handover",value)
        }
        if(key=='invoice_dt')
        {
            addStatus("Invoiced",value)
        }
        });
    }
    else 
    {
        document.getElementById("wo_num").textContent=document.getElementById("wno").value
        document.getElementById("wo_val").textContent=''
        document.getElementById("desc").textContent=''
        document.getElementById("st").textContent=''
        document.getElementById("end").textContent=''
        document.getElementById("issue").textContent=''
        document.getElementById('status').textContent=''
        document.getElementById('pno').textContent=''
        $( "#status_info" ).empty();
    }
    //console.log(data);
}
function addStatus(title,date)
{
    console.log("Title :"+title+" Date : " +date);
    var str='<div class="form-group" id='+title+'><div class="row"><div class="col-xs-4"><label>'+title+'</label></div><div class="col-xs-8"><label>'+date+'</label></div></div></div>';
    if ($('#status_info').find('#'+title).length) {
    // found!
    }
    else
    {
        $( "#status_info" ).append(str);
    }
    
}
</script>
<!DOCTYPE html>
<html>
<?php $title="Work Order";?>
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
        <div class="col-md-1"></div>
        <div class="col-md-9">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Work Order Info</h3>
            </div>
              <div class="box-body">
                <!-- /.form group -->
                <form action="wo_new.php" method="get">
                <div class="form-group">
                    <div class="row">
                    <div class="col-xs-4">
                    <label for="exampleInputEmail1">WO No.</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="wno" id="wno" placeholder="WO No." value="<?php echo $wno;?>" autocomplete="off" onkeyup="setDetails(this.value)">
                         
                    </div>
                    <div class="col-xs-2">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                    </div>
                </div>
                
                <hr/>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                  <label for="exampleInputPassword1">WO Number</label>
                  </div>
                  <div class="col-xs-8">
                  <label  name="wo_num" id="wo_num"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                  <label for="exampleInputPassword1">WO Value</label>
                  </div>
                  <div class="col-xs-8">
                  <label  name="wo_val" id="wo_val"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                   <label for="exampleInputPassword1">Description</label>
                  </div>
                  <div class="col-xs-8">
                  <label name="desc" id="desc"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                   <label for="exampleInputPassword1">Start Date</label>
                  </div>
                  <div class="col-xs-8">
                  <label  name="st" id="st"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                  <label for="exampleInputPassword1">Completion Date</label>
                  </div>
                  <div class="col-xs-8">
                  <label  name="end" id="end"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                  <label for="exampleInputPassword1">Project</label>
                  </div>
                  <div class="col-xs-8">
                   <label  id="pno" name="pno" ></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                  <label for="exampleInputPassword1">Issue Date</label>
                  </div>
                  <div class="col-xs-8">
                   <label  id="issue" name="issue"></label>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-4"> 
                  <label for="exampleInputPassword1">Status</label>
                  </div>
                  <div class="col-xs-8">
                  <label  id="status" name="status"></label>
                  </div>
                  </div>
                </div>
                <div id="status_info"></div>
                </form>
              </div>
          </div>
        </div>
         <div class="col-md-1"></div>
      </div>
    </section>
    </div>
  </div>
</div>
<script>
        $("#wno").keyup(function(){
        var id=document.getElementById("wno").value;
        console.log("id wno");
        console.log(id);
        setDetails(id);
        });
</script>


</body>
</html>
