<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../db.php';
session_start();
$p=$_SESSION['project'];
$db_handle=new DBController($p);
$dt=$_POST['date_selected'];
$cat=$_POST['opt'];
//$r=date("w", strtotime($dt));
//$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
//echo $days[$r];
if($cat==1)
{
    $query="select * from worker where date='$dt'";
    $result=$db_handle->runQuery($query);
    if(empty($result))
    {
         echo 'invalid daily report 1';
    }
}
if($cat==2)
{
    $query="select * from work_order where date_done='$dt'";
    $result=$db_handle->runQuery($query);
    if(empty($result))
    {
         echo 'invalid daily report 2';
    }
}
?>

