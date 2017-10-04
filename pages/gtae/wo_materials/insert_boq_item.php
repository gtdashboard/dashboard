<?php

    require '../db.php';
    session_start();
    $db_handle=new DBController();
    
    $serial=$_REQUEST['serial']; 
    $arab=$_REQUEST['arab']; 
    $koc=$_REQUEST['koc']; 
    $rem=$_REQUEST['rem']; 
    $pno=$_SESSION['pno'];
    $wo=$_SESSION['wo'];
    
    
    $basic="INSERT INTO `boq_item`(`pno`, `item_id`, `wo_no`, `arabi_qty`, `koc_qty`, `rem_qty`) VALUES"
            . " ($pno,'$serial','$wo',$arab,$koc,$rem)";
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
        $basic="select id_boq_item from boq_item where pno=$pno and wo_no='$wo' and item_id='$serial'";
        $result_basic=$db_handle->runQuery($basic);
        if(!empty($result_basic))
        {
            foreach($result_basic as $row)
            {
                $id=$row['id_boq_item'];
            }
            echo $id;
        }
    }

?>
