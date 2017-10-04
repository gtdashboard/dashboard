<?php

    require '../db.php';
    session_start();
    $db_handle=new DBController();
    $afp_id=$_REQUEST['afp_id']; 
    $afp_no=$_REQUEST['afp_no'];
    $basic="UPDATE afp set afp_no='$afp_no'  WHERE id_afp=$afp_id";
    echo $basic;
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
        echo 'updated';
        echo json_encode($result_basic);
        header("Location:afp_view.php?afp_id=$afp_id");
    }

?>

