<?php
    require 'db.php';

    $db_handle=new DBController();
    if(isset($_POST['wo_no']))
    {
        $wo_no=$_POST['wo_no'];
    }
    else {
        $wo_no='';
    }
    if(isset($_POST['desc']))
    {
        $desc=$_POST['desc'];
    }
    else {
        $desc='';
    }
    if(isset($_POST['pno']))
    {
        $pno=$_POST['pno'];
    }
    else {
        $pno=0;
    }
    if(isset($_POST['wo_val']))
    {
        $wo_val=$_POST['wo_val'];
    }
    else {
        $wo_val=0;
    }
    if(isset($_POST['st']))
    {
        $st=$_POST['st'];
    }
    else {
        $st='';
    }
    if(isset($_POST['hd']))
    {
       $hd=$_POST['hd'];
    }
    else {
        $hd='';
    }
    
    
    
    
    $st= strtotime($st);
    $st= date('Y-m-d',$st);
    
    $hd= strtotime($hd);
    $hd= date('Y-m-d',$hd);
    
    
    
    
    $basic="INSERT INTO `wo_summary`(`pno`, `wo_no`, `start`, `end`, `value`, `description`) "
            . "VALUES ($pno,'$wo_no','$st','$hd','$wo_val','$desc')";
    echo $basic;
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
        header("Location:wo_status.php");
    }

?>

