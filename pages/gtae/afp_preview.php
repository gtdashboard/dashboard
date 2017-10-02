<?php
require 'db.php';
session_start();
function track_id($p,$dt)
{
        
    $db_handle=new DBController();
    $dt= strtotime($dt);   
    $date2=date('ymd',$dt);
    $type="AP";
    $track="SP$p$type$date2";
    //echo $track;
    echo "<br>";
    $basic="SELECT * FROM `afp` WHERE tracking_id like '$track%'";
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        foreach($result_basic as $row)
        {
            $track_last=$row['tracking_id'];
           // echo $track_last;
        }
        echo "<br>";
        $serial=substr($track_last, 13,16);
        //echo $serial;
        $serial+=1;
        echo "<br>";
        $serial=str_pad($serial, 3, '0', STR_PAD_LEFT);
        $track.=$serial;
      //  echo "Final Track::".$track;

    }
    else
    {
        $serial=1;
        echo "<br>";
        $serial=str_pad($serial, 3, '0', STR_PAD_LEFT);
        $track.=$serial;
        //echo "Final Track::".$track;
    }
    return $track;
}
$date="";
$afp="";
$mpr="";
$pno="";
$ptitle="";
$expense="";
$amount_afe="";
$amount_afp="";
if(isset($_REQUEST['datepicker']))
{
    
    $date=$_REQUEST['datepicker'];
    $a=date_create($date);
    $dt=date_format($a, 'Y-m-d');
   // echo $dt;
   // echo $date;
   // echo "<br>";
}

if(isset($_REQUEST['mpr']))
{
    $mpr=$_REQUEST['mpr'];
   // echo $mpr;
  //echo "<br>";

}
if(isset($_REQUEST['afp_no']))
{
    $afp=$_REQUEST['afp_no'];
   // echo $afp;
 // echo "<br>";

}
if(isset($_REQUEST['pno']))
{
    $pno=$_REQUEST['pno'];
  //  echo $pno;
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
if(isset($_REQUEST['afe_amount']))
{
    $amount_afe=$_REQUEST['afe_amount'];
    //echo $amount_afe;
   // echo "<br>";
}
$nature="";
$material=0;
$service=0;
$contract=0;
$capital=0;
$other='';
if(isset($_REQUEST['other']))
{
    $other=$_REQUEST['other'];
    //echo $other;
}
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
        echo $value."<br />";
    }
    echo "<br>";
}
$payment="";
$partial=0;
$final=0;
if(isset($_REQUEST['payment']))
{
    $payment=$_REQUEST['payment'];
    foreach ($payment as $value){ 
        if(strcmp($value, 'partial')==0)
        {
            $partial=1;
        }
        if(strcmp($value, 'final')==0)
        {
            $final=1;
        }
        echo $value."<br />";
    }
    echo "<br>";
}
$previous='';
if(isset($_REQUEST['previous_pay']))
{
    $previous=$_REQUEST['previous_pay'];
   // echo $previous;
    echo "<br>";
}
$payTo='';
if(isset($_REQUEST['pay_to']))
{
    $payTo=$_REQUEST['pay_to'];
   // echo $payTo;
    echo "<br>";
}
if(isset($_REQUEST['amount']))
{
    $amount_afp=$_REQUEST['amount'];
  //  echo $amount_afp;
    echo "<br>";
}
$remarks='';
if(isset($_REQUEST['remarks']))
{
    $remarks=$_REQUEST['remarks'];
   // echo $remarks;
    echo "<br>";
}
$db_handle=new DBController();
if(isset($dt)&&isset($pno))
{
        $tracking_id= track_id($pno, $dt);
        $basic="INSERT INTO `afp`(`afp_no`, `afe_date`, `pno`, `afe_amount`, `service`, `sub_contract`, `material_supply`, `capital`, `other`, `partial_payment`, `final_payment`, `previous_payment`, `amount`, `pay_to`, `remarks`,tracking_id,mpr_details,expense) VALUES "
                        . "('$afp','$dt',$pno,$amount_afe,$service,$contract,$material,$capital,'$other',$partial,$final,'$previous',$amount_afp,'$payTo','$remarks','$tracking_id','$mpr','$expense')";
                            //echo $basic;
        $result_basic=$db_handle->runUpdate($basic);
        if(!empty($result_basic))
        {
            echo $result_basic;
        }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DashBoard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <?php require 'header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
    
        <br/>
        <br/>
        <div class="container" style="text-align: center;background-color:gainsboro;font-weight:bold; padding: 2px;border: 1px solid black;">
            AFP Form (<?php if(isset($tracking_id)){echo $tracking_id;}?>)</div>
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Date</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;  &nbsp;<?php echo $date;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">AFP No:</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;</div>
            </div>
        </div>
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Project No/Department</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;SP - <?php echo $pno;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">MPR/RSC/RSO/REV No</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;<?php echo $mpr;?></div>
            </div>
        </div>
        
         <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Project Title</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $ptitle;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Expense Head</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $expense;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">AFE Amount</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo "KD ".$amount_afe;?></div>
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
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;text-transform: uppercase;">Partial Payments &nbsp;<input type="checkbox"  <?php if($partial){echo "checked";}?>/></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;text-transform: uppercase;">Final Payments &nbsp;&nbsp;<input type="checkbox" <?php if($final){echo "checked";}?>/></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Previous Payment</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;</div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Amount to be paid</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo 'KD '.$amount_afp;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Pay To</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $payTo;?></div>
            </div>
        </div>
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Remarks</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $remarks;?></div>
            </div>
        </div>
        <br/>
        <br/>
        <div class="container" style="text-align: left;height:40px;font-size: 15px;">
            <div class="row" >
                <div class="col-md-6 col-xs-6" ></div>
                <div class="col-md-2 col-xs-2" ><a href="afp_print.php?track=<?php echo $tracking_id;?>" class="btn btn-primary" target="_blank">Print</a></div>
                <div class="col-md-4 col-xs-4" ></div>
            </div>
        </div>
        <br/>
        <br/>
        
        
    </div>
    <!-- /.container -->
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
