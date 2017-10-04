<?php

require '../db.php';
$db_handle=new DBController();
session_start();
$woid = $_SESSION['woid'];
$present=0;
//echo "Act is:".$_REQUEST['act_id'];
if(isset($_REQUEST['act_id']))
{
    $check=$_REQUEST['act_id'];
    $sql= "SELECT * FROM wo_progress WHERE wo_id = '$woid' and activity_id='$check';";
    //echo $sql;
    $resultCheck=$db_handle->runQuery($sql);        
    if (empty($resultCheck))
    { 
        $sql= "INSERT into wo_progress (activity_id, wo_id, progress_points) values ('$check','$woid','0')";
        //echo $sql;
        $result=$db_handle->runUpdate($sql);
        if (!empty($result))
        {
            $present=1;
        }
    }
}
echo $present;
?>

