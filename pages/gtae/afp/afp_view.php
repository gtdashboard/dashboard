<?php
            require '../db.php';
            $db_handle=new DBController();
            if(isset($_REQUEST['afp_id']))
            {
                $afp_id=$_REQUEST['afp_id'];
            }
            else
            {
                $afp_id='';
            }
            
            $date="";
            $afp_no="";
            $mpr="";
            $pno="";
            $afp_no="";
            $ptitle="";
            $expense="";
            $amount_afe="";
            $amount_afp="";
            
            $material=0;
            $service=0;
            $contract=0;
            $capital=0;
            $other='';
            
            $partial=0;
            $final=0;
            $previous='';
            $payTo='';
            $remarks='';

            $basic="SELECT * FROM `afp` WHERE id_afp='$afp_id'";
            //echo $basic;
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                foreach($result_basic as $row)
                {
                    $dt=$row['afe_date'];
                    $dt= strtotime($dt);
                    $track=$row['tracking_id'];
                    $date=Date('d.m.Y',$dt);
                    
                    $afp_no=$row['afp_no'];
                    $mpr=$row['mpr_details'];
                    $pno=$row['pno'];
                    $expense=$row['expense'];
                    $amount_afe=$row['afe_amount'];
                    $amount_afp=$row['amount'];

                    $material=$row['material_supply'];
                    $service=$row['service'];
                    $contract=$row['sub_contract'];
                    $capital=$row['capital'];
                    $other=$row['other'];

                    $partial=$row['partial_payment'];
                    $final=$row['final_payment'];
                    $previous=$row['previous_payment'];
                    $payTo=$row['pay_to'];
                    $remarks=$row['remarks'];
                    $ptitle='';
                    $query_ptitle="select project from general where pno=$pno";
                    $result_ptitle=$db_handle->runQuery($query_ptitle);
                    if(!empty($result_ptitle))
                    {
                        foreach($result_ptitle as $row_ptitle)
                        {
                            $ptitle=$row_ptitle['project'];
                        }
                    }
                }
            }
?>
<!DOCTYPE html>
<html>
<?php $title="AFP";?>
<?php require '../head.php'?>
<div class="wrapper">
<?php require '../header.php';?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
    
        <br/>
        <br/>
        <div class="container" style="text-align: center;background-color:gainsboro;font-weight:bold; padding: 2px;border: 1px solid black;">
            AFP Form (<?php if(isset($track)){echo $track;}?>)</div>
        <div class="container" style="text-align: center;height:40px;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Date</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;  &nbsp;<?php echo $date;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">AFP No:</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;<?php echo $afp_no;?></div>
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
                <div class="col-md-2 col-xs-2" ><a href="afp_print.php?track=<?php echo $track;?>" class="btn btn-primary" target="_blank">Print</a></div>
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
<?php require '../scripts.php';?>
</body>
</html>
