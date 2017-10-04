<?php

    require '../db.php';
    $db_handle=new DBController();
    $update=0;
    $points=$_REQUEST['points'];   
    $id=$_REQUEST['p_id'];
    $sql= "update wo_progress set progress_points=$points where id=$id";
    $result=$db_handle->runUpdate($sql);
    if (!empty($result))
    {
        $update=1;
    }
echo $update;
?>
