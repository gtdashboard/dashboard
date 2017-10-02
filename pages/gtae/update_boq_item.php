<?php

    require 'db.php';
    session_start();
    $db_handle=new DBController();
    
    $id_boq=$_REQUEST['id_boq']; 
    $arab=$_REQUEST['arab']; 
    $koc=$_REQUEST['koc']; 
    $rem=$_REQUEST['rem']; 
    
    
    $basic="UPDATE `boq_item` SET `arabi_qty`=$arab,`koc_qty`=$koc,`rem_qty`=$rem WHERE `id_boq_item`=$id_boq";
    echo $basic;
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
       echo $result_basic;
       echo "Updated";
    }

?>
