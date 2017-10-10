<?php
    require '../db.php';
    $db_handle=new DBController();
    if(isset($_POST['tname']))
    {
        $tname=$_POST['tname'];
    }
    if(isset($_POST['action']))
    {
        $action=$_POST['action'];
    }
    if(isset($_POST['dt']))
    {
        $dt=$_POST['dt'];
        $dt= strtotime($dt);
        $dt=date('Y-m-d',$dt);
    }
    if(strcmp($tname,'')!=0)
    {
        $task_query="insert into tasks(task_name,action_by,deadline) values('$tname','$action','$dt')";
        echo $task_query;
        $result_task=$db_handle->runUpdate($task_query);
        if(!empty($result_task))
        {
            echo 'inserted';
            header("Location:task_table.php");
        }
    }
    else 
    {
        header("Location:task_table.php");

    }
?>

