<?php

    require 'db.php';
    $db_handle=new DBController();
    $key=$_REQUEST['key']; 
    //$key=104;
    $basic="SELECT DISTINCT(wo_numbers.work_order_no) FROM `wo_progress`,wo_numbers WHERE wo_numbers.pno=$key and wo_numbers.id_wo=wo_progress.wo_id";
    //echo $basic;
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
    }

?>

