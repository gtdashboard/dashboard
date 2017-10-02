<?php

    require 'db.php';

    $db_handle=new DBController();
    $no='';
    $name='';
    $des='';
    $dob='';
    $jdt='';
    $pno='';
    $civil='';
    $pass_no='';
    $gate='';
    
    if(isset($_REQUEST['eno']))
    {
       $no=$_REQUEST['eno']; 
    }
    if(isset($_REQUEST['ename']))
    {
        $name=$_REQUEST['ename'];
    }
    if(isset($_REQUEST['des']))
    {
        $des=$_REQUEST['des'];
    }
    if(isset($_REQUEST['dob']))
    {
        $dob=$_REQUEST['dob'];
        $dob= strtotime($dob);
        $dob= date('Y-m-d',$dob);
    }
    if(isset($_REQUEST['jd']))
    {
        $jdt=$_REQUEST['jd'];
        $jdt= strtotime($jdt);
        $jdt= date('Y-m-d',$jdt);
    }
    if(isset($_REQUEST['pno']))
    {
        $pno=$_REQUEST['pno'];
    }
    if(isset($_REQUEST['resNo']))
    {
        $civil=$_REQUEST['resNo'];
    }
    if(isset($_REQUEST['passNo']))
    {
        $pass_no=$_REQUEST['passNo'];
    }
    if(isset($_REQUEST['gateDate']))
    {
        $gate=$_REQUEST['gateDate'];
        $gate= strtotime($gate);
        $gate= date('Y-m-d',$gate);
    }
    if(isset($_REQUEST['resDate']))
    {
        $res=$_REQUEST['resDate'];
        $res= strtotime($res);
        $res= date('Y-m-d',$res);
    }
    
    $basic="SELECT * FROM employee WHERE emp_number='$no'";
    $result_basic=$db_handle->runQuery($basic);
    if(empty($result_basic))
    {
        $ins="INSERT INTO `employee`(`emp_number`, `emp_name`, `designation`, `dob`, `join_date`, `pno`, `pass_no`, `civil_id`, `gate_pass_exp`, `res_exp`) "
            . "VALUES ('$no','$name','$des','$dob','$jdt',$pno,'$pass_no','$civil','$gate','$res')";
        echo $ins;
        $result_ins=$db_handle->runUpdate($ins);
        header("Location:emp_search.php?eno=$no");
    }
    else 
    {
        $upd="UPDATE `employee` SET `emp_name`='$name',`designation`='$des',"
                . "`dob`='$dob',`join_date`='$jdt',`pno`='$pno',`pass_no`='$pass_no',`civil_id`='$civil',"
                . "`gate_pass_exp`='$gate',`res_exp`='$res' WHERE emp_number='$no'";
        echo $upd;
        $result_upd=$db_handle->runUpdate($upd);
        header("Location:emp_search.php?eno=$no");
    }

?>