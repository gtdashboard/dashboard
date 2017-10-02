<?php

    require 'db.php';

    $db_handle=new DBController();
    $key=$_REQUEST['key']; 
    //$key=105;
    $basic="SELECT distinct(work_order_no) FROM wo_numbers WHERE pno='$key' order by work_order_no";
    //echo $basic;
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
    }

?>
