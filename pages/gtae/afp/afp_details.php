<?php

    require '../db.php';

    $db_handle=new DBController();
    $key=$_REQUEST['key']; 
    $basic="SELECT expense,mpr_details,id_afp FROM afp WHERE tracking_id='$key'";
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
    }

?>

