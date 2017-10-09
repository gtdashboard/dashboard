<?php
    require '../db.php';

    $db_handle=new DBController();
    if(isset($_POST['wo_no']))
    {
        $wo_no=$_POST['wo_no'];
        $wo_no= strtoupper($wo_no);
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
    if(isset($_POST['issue']))
    {
       $issue=$_POST['issue'];
    }
    else {
        $issue='';
    }
    
    
    
    
    $st= strtotime($st);
    $st= date('Y-m-d',$st);
    
    $hd= strtotime($hd);
    $hd= date('Y-m-d',$hd);
    
    $issue= strtotime($issue);
    $issue= date('Y-m-d',$issue);
    
    echo "issue:$issue";
    
    
    $test="select * from wo_numbers where work_order_no='$wo_no'";
    $result_test=$db_handle->runQuery($test);
    if(!empty($result_test))
    {
        $basic="update wo_numbers set start='$st',end='$hd',value=$wo_val,description='$desc',issue='$issue' where work_order_no='$wo_no'";
        echo $basic;
        $result_basic=$db_handle->runUpdate($basic);
        if(!empty($result_basic))
        {
            echo json_encode($result_basic);
            header("Location:wo_status.php?wo_no=$wo_no");
        }
    }
    else 
    {
        $basic="INSERT INTO `wo_numbers`(`pno`, `work_order_no`, `start`, `end`, `value`, `description`,issue) "
            . "VALUES ($pno,'$wo_no','$st','$hd',$wo_val,'$desc','$issue')";
        echo $basic;
        $result_basic=$db_handle->runUpdate($basic);
        if(!empty($result_basic))
        {
            echo json_encode($result_basic);
            header("Location:wo_status.php?wo_no=$wo_no");
        }
    }
    
    

?>

