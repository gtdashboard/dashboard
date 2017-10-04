<?php

    require '../db.php';

    $db_handle=new DBController();
    $key=$_REQUEST['key']; 
    //$key=104;
    $basic="SELECT distinct(work_order_no),id_wo FROM wo_numbers WHERE pno='$key' ORDER BY `work_order_no` DESC ";
    //echo $basic;
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
    }

?>
