<?php
require '../db.php';
session_start();
function track_id($p,$dt)
{
        
    $db_handle=new DBController();
    $dt= strtotime($dt);   
    $date2=date('ymd',$dt);
    $type="AE";
    $track="SP$p$type$date2";
    //echo $track;
   // echo "<br>";
    $basic="SELECT * FROM `afe` WHERE tracking_id like '$track%'";
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        foreach($result_basic as $row)
        {
            $track_last=$row['tracking_id'];
           // echo $track_last;
        }
        //echo "<br>";
        $serial=substr($track_last, 13,16);
        //echo $serial;
        $serial+=1;
        //echo "<br>";
        $serial=str_pad($serial, 3, '0', STR_PAD_LEFT);
        $track.=$serial;
       // echo "Final Track::".$track;

    }
    else
    {
        $serial=1;
        //echo "<br>";
        $serial=str_pad($serial, 3, '0', STR_PAD_LEFT);
        $track.=$serial;
        //echo "Final Track::".$track;
    }
    return $track;
}
$date="";
$mpr="";
$pno="";
$ptitle="";
$expense="";
$expected="";
$amount="";
$additional=0;
$afe=0;
if(isset($_REQUEST['additional']))
{
    
    $add=$_REQUEST['additional'];
    if(strcmp($add, 'additional')==0)
        {
            $additional=1;
        }
}

if(isset($_REQUEST['datepicker']))
{
    
    $date=$_REQUEST['datepicker'];
    $a=date_create($date);
    $dt=date_format($a, 'Y-m-d');
   // echo $dt;
   // echo $date;
    //echo "<br>";
}

if(isset($_REQUEST['mpr']))
{
    $mpr=$_REQUEST['mpr'];
    //echo $mpr;
   // echo "<br>";

}
if(isset($_REQUEST['afe_no']))
{
    $afe=$_REQUEST['afe_no'];
   //echo $mpr;
   // echo "<br>";

}
if(isset($_REQUEST['pno']))
{
    $pno=$_REQUEST['pno'];
   // echo $pno;
   // echo "<br>";
}
if(isset($_REQUEST['ptitle']))
{
    $ptitle=$_REQUEST['ptitle'];
   // echo $ptitle;
   // echo "<br>";
}
if(isset($_REQUEST['expense']))
{
    $expense=$_REQUEST['expense'];
   //echo $expense;
    //echo "<br>";
}
if(isset($_REQUEST['expected']))
{
    $expected=$_REQUEST['expected'];
   // echo $expected;
    //echo "<br>";
}
if(isset($_REQUEST['amount']))
{
    $amount=$_REQUEST['amount'];
    //echo $amount;
    //echo "<br>";
}
$nature="";
$material=0;
$service=0;
$contract=0;
$capital=0;
$other=0;
if(isset($_REQUEST['nature']))
{
    $nature=$_REQUEST['nature'];
    foreach ($nature as $value){ 
        if(strcmp($value, 'service')==0)
        {
            $service=1;
        }
        if(strcmp($value, 'material')==0)
        {
            $material=1;
        }
        if(strcmp($value, 'contract')==0)
        {
            $contract=1;
        }
        if(strcmp($value, 'capital')==0)
        {
            $capital=1;
        }
        if(strcmp($value, 'other')==0)
        {
            $other=1;
        }
       // echo $value."<br />";
    }
  //  echo "<br>";
}
                    $db_handle=new DBController();
                    if(isset($dt)&&isset($pno))
                    {
                        $success=0;
                        $tracking_id= track_id($pno, $dt);
                        $basic="INSERT INTO `afe`(afe_no,`afe_date`, `mpr_details`, `pno`, `afe_amount`, `service`, `sub_contract`, `material_supply`, `capital`, `other`, `expected`,tracking_id,expense,additional) VALUES ('$afe','$dt','$mpr',$pno,$amount,$service,$contract,$material,$capital,$other,'$expected','$tracking_id','$expense',$additional) ";
                        //echo $basic;
                        $result_basic=$db_handle->runUpdate($basic);
                        if(!empty($result_basic))
                        {
                            $success=1;
                            //echo 'inserted';
                            //echo $result_basic;
                        }
                    }
?>
<!DOCTYPE html>
<html>
<?php $title="AFE Form";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper" style="background-color: white;">
    <div class="container">
    <br/>
    <br/>
              <div class="container" style="text-align: center;background-color:gainsboro;font-weight:bold; padding: 2px;border: 1px solid black;">
                  AFE Form (<?php if(isset($tracking_id)){echo $tracking_id;}?>)<?php if(strcmp($afe,'')>0){echo "<br>AFE No: $afe";}?></div>
        <div class="container" style="text-align: left;height:40px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:40px;font-size: 15px;">MPR/RSC/RSO/REV No.</div>
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;line-height:40px;">&nbsp;<?php echo $mpr;?></div>
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:40px;font-size: 15px;">Date</div>
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;line-height:40px;">&nbsp;<?php echo $date;?></div>
      
            </div>
        </div>
        <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:40px;">Project No/Department</div>
                <div class="col-md-9 col-xs-9" style="border: 2px solid black;line-height:40px;">Special Projects - SP <?php echo $pno;?></div>
       
            </div>
        </div>
        
         <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:40px;">Project Title</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 2px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $ptitle;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:40px;">Expense Head (Budget)</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 2px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $expense;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: left;font-size: 15px;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:40px;">AFE Amount</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 2px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo "KD ".$amount;?></div>
            </div>
        </div>
        
         <div class="container" style="text-align: left;font-size: 15px;height:80px;font-weight: bold;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;font-weight:bold;line-height:80px;">Nature of Expense</div>
                
                <div class="col-md-3 col-xs-3 col-sm-3" style="border: 2px solid black;line-height:100px;">
                    <div class="row" style="height:40px;">
                        <div class="col-md-9 col-xs-9 col-sm-9" style="line-height:40px;">Service</div>
                        <div class="col-md-3 col-xs-3 col-sm-3" style="line-height:40px;"><input type="checkbox" <?php if($service){echo "checked";}?>/></div>
                    
                    </div>
                    <div class="row" style="height:40px;">
                        <div class="col-md-9 col-sm-9 col-xs-9" style="line-height:40px;">Material Supply</div>
                         <div class="col-md-3 col-xs-3 col-sm-3" style="line-height:40px;"><input type="checkbox" <?php if($material){echo "checked";}?>/></div>
                    
                    </div>
                </div>
                
                <div class="col-md-3 col-xs-3 col-sm-3" style="border: 2px solid black;line-height:100px;">
                    <div class="row" style="height:40px;">
                        <div class="col-md-9 col-xs-9 col-sm-9" style="line-height:40px;">Sub Contract</div>
                        <div class="col-md-3 col-xs-3 col-sm-3" style="line-height:40px;"><input type="checkbox" <?php if($contract){echo "checked";}?>/></div>
                    
                    </div>
                    <div class="row" style="height:40px;">
                        <div class="col-md-9 col-sm-9 col-xs-9" style="line-height:40px;">Capital Expenditure</div>
                         <div class="col-md-3 col-xs-3 col-sm-3" style="line-height:40px;"><input type="checkbox" <?php if($capital){echo "checked";}?>/></div>
                    
                    </div>
                </div>
                
                <div class="col-md-3 col-xs-3" style="border: 2px solid black;line-height:80px;">
                    <div class="col-md-9 col-sm-9 col-xs-9" style="line-height:80px;">Other</div>
                    <div class="col-md-1 col-xs-1 col-sm-1" style="line-height:80px;"><input type="checkbox" <?php if($other){echo "checked";}?>/></div>
                </div>
            </div>
         </div>
        <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row" >
                <div class="col-md-5 col-xs-5" style="border: 2px solid black;line-height:40px;font-weight: bold;">Expected to spend till end of the project</div>
                <div class="col-md-7 col-xs-7" style="border: 2px solid black;line-height:40px;">&nbsp;<?php echo $expected;?></div>
            </div>
        </div>
        <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row" >
                <div class="col-md-5 col-xs-5" style="border: 2px solid black;line-height:40px;font-weight: bold;">Insertion Status</div>
                <div class="col-md-7 col-xs-7" style="border: 2px solid black;line-height:40px;">&nbsp;<?php if($success){echo 'Inserted';}else{echo 'Not Inserted';}?></div>
            </div>
        </div>
        
        <br/>
        
              <br/>
              
                    <br/>
        <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row" >
                <div class="col-md-6 col-xs-6" ></div>
                <div class="col-md-2 col-xs-2" ><a href="afe_print.php?track=<?php if(isset($tracking_id)){echo $tracking_id;}?>" class="btn btn-primary" target="_blank">Print</a></div>
                <div class="col-md-4 col-xs-4" ></div>
            </div>
        </div>  
        
    </div>
    <!-- /.container -->
  </div>
</div>
<?php require '../scripts.php';?>
</html>
