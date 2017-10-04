<?php
            require '../db.php';
            $db_handle=new DBController();
            if(isset($_REQUEST['track']))
            {
                $track=$_REQUEST['track'];
            }
            else
            {
                $track='';
            }
            
            $date="";
            $afp="";
            $mpr="";
            $pno="";
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

            $basic="SELECT * FROM `afp` WHERE tracking_id='$track'";
            //echo $basic;
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                foreach($result_basic as $row)
                {
                    $dt=$row['afe_date'];
                    $dt= strtotime($dt);
                    
                    $date=Date('d.m.Y',$dt);
                    
                    $afp=$row['afp_no'];
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
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Print</title>
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="../form_action.js"></script>
        <style>
        body{
           -webkit-print-color-adjust: exact; 
        }
        .cell
        {
            border: 1px solid black;
            height:75px;
            text-align: center;
        }
        .text-center
        {
            line-height: 75px;
        }
        .text-pad
        {
            padding-top:10px;
        }
        .small
        {
            font-size: 10px;
        }
        
        </style>
        <script>
           
        </script>
    </head>
    <body style="font-size:20px;">
        <div class="container">
        <div class="row" style="border:2px solid black;padding: 2%;">
            <div class="col-md-2 col-xs-2" style="text-align:right;"><img src="arabi_logo.png" width="50" height="50"/></div>
            <div class="col-md-8 col-xs-8" style="text-align:center;font-weight: bold;">
                    <h4 style="font-weight:bold;">ARABI ENERTECH K.S.C</h4>
                    <h4 style="font-weight:bold;">APPROVAL FOR PAYMENTS (A.F.P)</h4>
                </div>
        </div>
        </div>
        
        <div class="container" style="text-align: center;background-color:gainsboro;font-weight:bold; padding: 2px;border: 1px solid black;">
            ORIGINATOR</div>
        
        <!--<div class="container" style="text-align: center;font-weight:bold; padding: 2px;border: 1px solid black;">
            <div class="row" style="padding:10px;">
                <div class="col-md-2 col-xs-2">W/Order Nos.</div>
                <div class="col-md-6 col-xs-6"><?php echo 'xx';?></div>
                <div class="col-md-2 col-xs-2">Date: <?php echo $dt;?></div>
                <div class="col-md-2 col-xs-2">Day: <?php echo $days[$r];?></div>
            </div>
        </div>-->
        <!--FROM-->
 <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Date</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;  &nbsp;<?php echo $date;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">AFP No:</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;</div>
            </div>
        </div>
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Project No/Department</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;SP - <?php echo $pno;?></div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">MPR/RSC/RSO/REV No</div>
                <div class="col-md-3 col-xs-3" style="border: 1px solid black;line-height:40px;">&nbsp;&nbsp;<?php echo $mpr;?></div>
            </div>
        </div>
        
         <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Project Title</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;font-size: 15px;">&nbsp;<?php echo $ptitle;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Expense Head</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $expense;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
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
        
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Amount to be paid</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo 'KD '.$amount_afp;?></div>
            </div>
        </div>
        
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Pay To</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $payTo;?></div>
            </div>
        </div>
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid black;font-weight:bold;line-height:40px;">Remarks</div>
                <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid black;line-height:40px;text-align: left;">&nbsp;<?php echo $remarks;?></div>
            </div>
        </div>
        
        <!--To-->
        
        <div class="container" style="text-align: center;height:125px">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br/><br><br>Originator</div>
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br><br><br>Project/Dept. Manager</div>
            </div>
        </div>
      
        <br/>
        <div class="container" style="text-align: center;border: 2px solid black;">
            <b>APPROVED BY</b>
        <br/>
        (Approval shall be as per the Levels of Authorization)
        </div>
        <div class="container" style="text-align: center;border: 1px solid black;height:125px">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br><br><br>GM/AGM/DOD</div>
                <div class="col-md-4 col-xs-4" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br><br><br>Chief Operating Officer</div>
                <div class="col-md-4 col-xs-4" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br><br><br>Chairman</div>
            </div>
        </div>
        
        <br/>
        <div class="container" style="text-align: center;border: 2px solid black;">
            <b>FINANCE/ACCOUNTS</b>
        </div>
        <div class="container" style="text-align: center;border: 1px solid black;height:40px">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:40px">Actual Payment Amount</div>
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:40px"></div>
                
            </div>
        </div>
        <div class="container" style="text-align: center;border: 1px solid black;height:125px">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br><br><br>Account Sign</div>
                <div class="col-md-6 col-xs-6" style="padding:10px;font-weight:bold;border: 1px solid black;height:125px"><br><br><br>Finance Head</div>
                
            </div>
        </div>
       <div class="container" style="text-align: justify;border: 2px solid black;padding: 2%;font-size: 15px;">
           <b>Note:</b> &nbsp;  &nbsp; 1. Copy of Approved AFE shall be attached with AFP for Account Processing   
            <br/>
        &nbsp;  &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp;2. Copy of Invoice/Bills shall be attached with AFP.                                                                       
            <br/>       
         &nbsp;  &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp;&nbsp;  &nbsp; &nbsp;3. Related Invoice copy of Client to be attached.                                                                                                                                                                    
            <br/>
            <b>Legend:</b>   &nbsp; &nbsp; &nbsp;    a) MPR- Material Procurement Request,    b) RSC- Request for Sub contract,    c) RSO- Request for Service Order,   
            <br/>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; d) REV- Request For Equipment & Vehicles.  
        </div>
        <br/>
        <div class="container" style="text-align: center;height: 40px;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Document No : qf-fn-01-02
                </div>
                <div class="col-md-1 col-xs-1" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Rev-4    
                </div>
                <div class="col-md-2 col-xs-2" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Date : 19-12-2016 
                </div>
                <div class="col-md-1 col-xs-1" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Issue A	
                </div>
                <div class="col-md-2 col-xs-2" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Date: 01-12-2014
                </div>
                <div class="col-md-2 col-xs-2" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Page 1 of 1
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <h6><?php if(isset($track)){echo $track;}?></h6>
    </body>
</html>
