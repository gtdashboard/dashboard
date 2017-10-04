<?php
    require '../db.php';
    $db_handle=new DBController();
    $key=$_REQUEST['key'];
    $basic="DELETE FROM `boq_item` WHERE id_boq_item=$key";
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
        echo 'Deleted';
    }
    else
    {
       echo 'Not Deleted'; 
    }
?>
