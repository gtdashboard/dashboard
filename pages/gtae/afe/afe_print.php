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
            $mpr="";
            $pno="";
            $ptitle="";
            $expense="";
            $expected="";
            $amount="";
            
            $material=0;
            $service=0;
            $contract=0;
            $capital=0;
            $other=0;
            $additional=0;
            
           

            $basic="SELECT * FROM `afe` WHERE tracking_id='$track'";
            //echo $basic;
            $result_basic=$db_handle->runQuery($basic);
            if(!empty($result_basic))
            {
                foreach($result_basic as $row)
                {
                    $dt=$row['afe_date'];
                    
                    $dt= strtotime($dt);
                    
                    $date=Date('d.m.Y',$dt);
                    
                    $mpr=$row['mpr_details'];
                    $pno=$row['pno'];
                    $expense=$row['expense'];
                    $amount=$row['afe_amount'];
                    $additional=$row['additional'];

                    $material=$row['material_supply'];
                    $service=$row['service'];
                    $contract=$row['sub_contract'];
                    $capital=$row['capital'];
                    $other=$row['other'];
                    
                    $expected=$row['expected'];
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
            border: 2px solid black;
            height:75px;
            text-align: center;
        }
        .text-center
        {
            line-height: 75px;
        }
        .text-pad
        {
            padding-top:15px;
        }
        .small
        {
            font-size: 15px;
        }
        
        </style>
        <script>
           
        </script>
    </head>
    <body style="font-size:18px;">
        <div class="container">
        <div class="row" style="border:2px solid black;">
            <div class="col-md-2 col-xs-2" style="text-align:right;"><img src="arabi_logo.png" width="70" height="70"/></div>
            <div class="col-md-8 col-xs-8" style="text-align:center;font-weight: bold;">
                    <h4 style="font-weight:bold;">ARABI ENERTECH K.S.C</h4>
                    <h4 style="font-weight:bold;"><u>APPROVAL FOR EXPENSE [ A.F.E ] <?php if($additional){ echo "ADDITIONAL";}?></u></h4>
                </div>
        </div>
        </div>
        
        <div class="container">
        <div class="row" style="height:40px;">
            <div class="col-md-6 col-xs-6" style="text-align:right;height:40px;font-weight: bold;"></div>
            <div class="col-md-3 col-xs-3" style="border: 2px solid black;text-align:center;height:40px;line-height: 40px;font-weight: bold;">
                AFE No.
            </div>
            <div class="col-md-3 col-xs-3" style="border: 2px solid black;text-align:center;height:40px;line-height: 40px;">
                
            </div>
        </div>
        </div>
        
        <div class="container" style="text-align: center;background-color:gainsboro;font-weight:bold; padding: 2px;border: 2px solid black;">
            ORIGINATOR</div>
        <!--FROM-->
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
        
        
        <!--TO-->
        <div class="container" style="text-align: center;height:100px;text-transform: uppercase;">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="font-weight:bold;border: 2px solid black;"><br><br><br>Originator</div>
                <div class="col-md-6 col-xs-6" style="font-weight:bold;border: 2px solid black;"><br><br><br>Project/Dept. Manager</div>
            </div>
        </div>
        
        <br/>
        <div class="container" style="text-align: center;border: 2px solid black;">
            <b>FINANCE/ACCOUNTS</b>
        </div>
        <div class="container" style="text-align: left;height:40px">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="line-height: 40px;font-weight:bold;border: 2px solid black;height:40px;text-transform: uppercase">
                    Budget Status&nbsp;&nbsp;<input type="checkbox"/></div>
                <div class="col-md-8 col-xs-8" style="line-height: 40px;border: 2px solid black;height:40px">Tick mark in the box "√" for the amount under budget and "x" for exceeding budget.</div>
                
            </div>
        </div>
        <div class="container" style="text-align: center;height:40px;font-weight:bold;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="line-height: 40px;font-weight:bold;border: 2px solid black;height:40px;text-transform: uppercase">
                    &nbsp;&nbsp;</div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px">Current Period</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px">Project To Date</div>
                
            </div>
        </div>
        <div class="container" style="text-align: left;height:40px;font-weight:bold;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="line-height: 40px;font-weight:bold;border: 2px solid black;height:40px;">
                    1) Budget Amount</div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                
            </div>
        </div>
        <div class="container" style="text-align: left;height:40px;font-weight:bold;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="line-height: 40px;font-weight:bold;border: 2px solid black;height:40px;">
                    2) AFE Amount</div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                
            </div>
        </div>
        
        <div class="container" style="text-align: left;height:40px;font-weight:bold;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="line-height: 40px;font-weight:bold;border: 2px solid black;height:40px;">
                    3) Amount spend upto Date</div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                
            </div>
        </div>
        
        <div class="container" style="text-align: left;height:50px;font-weight:bold;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="border: 2px solid black;height:50px;">
                    <b>4) Previous AFE Approved</b>
                    <br/>
                    (Committed)
                    <br/>
                </div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:50px"> &nbsp;&nbsp;</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:50px"> &nbsp;&nbsp;</div>
                
            </div>
        </div>
        <div class="container" style="text-align: left;height:40px;font-weight:bold;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="line-height: 40px;font-weight:bold;border: 2px solid black;height:40px;">
                    5) Amount Balance to spend</div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:40px"> &nbsp;&nbsp;</div>
                
            </div>
        </div>
        <div class="container" style="text-align: left;height:80px;font-weight:bold;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="font-weight: normal;border: 2px solid black;height:80px">
                    <b>6) Amount Surplus / Deficent</b>
                    <br/>
                    (Pls.indicate surplus amount by " .     +"
                    <br/>and deficit amount by " -")	
                </div>
                <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:80px"> &nbsp;&nbsp;</div>
                 <div class="col-md-4 col-xs-4" style="line-height: 40px;border: 2px solid black;height:80px"> &nbsp;&nbsp;</div>
                
            </div>
        </div>
        <div class="container" style="text-align: center;height:100px">
            <div class="row">
                <div class="col-md-6 col-xs-6" style="font-weight:bold;border: 2px solid black;"><br><br><br/>Account</div>
                <div class="col-md-6 col-xs-6" style="font-weight:bold;border: 2px solid black;"><br><br/><br/>Finance Head</div>
            </div>
        </div>
        
        <br/>
        <div class="container" style="text-align: center;border: 2px solid black;">
            <b>APPROVED BY</b>
        <br/>
        (Approval shall be as per the Levels of Authorization)
        </div>
        <div class="container" style="text-align: center;height:100px">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="font-weight:bold;border: 2px solid black;"><br><br><br>GM/AGM/DOD</div>
                <div class="col-md-4 col-xs-4" style="font-weight:bold;border: 2px solid black;"><br><br><br>Chief Operating Officer</div>
                <div class="col-md-4 col-xs-4" style="font-weight:bold;border: 2px solid black;"><br><br><br>Chairman</div>
            </div>
        </div>
       <div class="container" style="text-align: justify;border: 2px solid black;">
           <b>Note:</b> &nbsp;  &nbsp; &nbsp;       1. If PO amount exceeds more than 10% of AFE amount or above 1000 KWD, Separate Justification required.                                                                                                                                                               
            <br/>
            <b>Legend:</b>   &nbsp; &nbsp; &nbsp;    a) MPR- Material Procurement Request,    b) RSC- Request for Sub contract,    c) RSO- Request for Service Order,   
            <br/>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; d) REV- Request For Equipment & Vehicles.  
        </div>
        <br/>
        <div class="container" style="text-align: center;height: 40px;font-size: 15px;">
            <div class="row">
                <div class="col-md-4 col-xs-4" style="font-weight:bold;border: 2px solid black;line-height: 40px;">
                Document No : qf-fn--01-01
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
        <h6><?php echo $track;?></h6>
        
    </body>
</html>
