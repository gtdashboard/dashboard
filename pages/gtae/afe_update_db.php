<?php

    require 'db.php';

    $db_handle=new DBController();
    $afe_id=$_REQUEST['afe_id']; 
    $afe_no=$_REQUEST['afe_no'];
    $basic="UPDATE afe set afe_no='$afe_no'  WHERE id_afe=$afe_id";
    echo $basic;
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
        header("Location:afe_view.php?afe_id=$afe_id");
    }

?>


