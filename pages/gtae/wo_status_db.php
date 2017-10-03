<?php
    require 'db.php';

    $db_handle=new DBController();
    if(isset($_POST['wo']))
    {
        $wo_no=$_POST['wo'];
    }
    else {
        $wo_no='';
    }
    if(isset($_POST['pno']))
    {
        $pno=$_POST['pno'];
    }
    else {
        $pno=0;
    }
    if(isset($_POST['status']))
    {
        $status=$_POST['status'];
    }
    else {
        $status=0;
    }
    if(isset($_POST['dt']))
    {
        $dt=$_POST['dt'];
    }
    else {
        $dt='';
    }
    
    $dt= strtotime($dt);
    $dt= date('Y-m-d',$dt);
    
    
    
    $basic="select id_wo from wo_numbers where work_order_no='$wo_no'";
    echo $basic;
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        foreach($result_basic as $row)
        {
            $id_wo=$row['id_wo'];
        }
        $ins="INSERT INTO `wo_status`( `id_wo`, `status`, `date`) VALUES ($id_wo,$status,'$dt')";
        echo $ins;
        $result_ins=$db_handle->runUpdate($ins);
        if(!empty($result_ins))
        {
            echo 'inserted';
            header("Location:wo_details_table.php");
        }
    }

?>

