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
    if(isset($_POST['well']))
    {
        $well=$_POST['well'];
    }
    else {
        $well='';
    }
    if(isset($_POST['gc']))
    {
        $gc=$_POST['gc'];
    }
    else {
        $gc='';
    }
    if(isset($_POST['loc']))
    {
         $loc=$_POST['loc'];
    }
    else {
        $loc='';
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
    if(isset($_POST['ug']))
    {
        $ug=$_POST['ug']; 
    }
    if($ug==null) {
        $ug=0; 
    }
    if(isset($_POST['ag']))
    {
        $ag=$_POST['ag'];
    }
    if($ag==null){
        $ag=0; 
    }
    
    
    
    
    $st= strtotime($st);
    $st= date('Y-m-d',$st);
    
    $hd= strtotime($hd);
    $hd= date('Y-m-d',$hd);
    
    
    
    
    $basic="INSERT INTO `wo_summary`(`pno`, `wo_number`, `wo_value`, `well`, `gc`, `location`, `start_date`, `handover`,total_ag,total_ug) "
            . "VALUES ($pno,'$wo_no','$wo_val','$well','$gc','$loc','$st','$hd',$ag,$ug)";
    echo $basic;
    $result_basic=$db_handle->runUpdate($basic);
    if(!empty($result_basic))
    {
        echo json_encode($result_basic);
    }

?>

