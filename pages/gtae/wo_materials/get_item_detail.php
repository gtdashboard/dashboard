<?php

    require '../db.php';

    $db_handle=new DBController();
    $key=$_REQUEST['key']; 
    session_start();
    $pno=$_SESSION['pno'];
    $basic="SELECT item,serial_boq,sp FROM boq WHERE serial_boq='$key' and pno='$pno'";
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
    }

?>

