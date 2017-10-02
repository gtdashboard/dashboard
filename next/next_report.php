<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db.php';
$db_handle=new DBController();
$dt=$_POST['date_selected'];
$cat=$_POST['cat'];
//$r=date("w", strtotime($dt));
//$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
//echo $days[$r];
if($cat==1)
{
    header("Location:update_d1.php?dt=".$dt);
}
if($cat==2)
{
    header("Location:update_d2.php?dt=".$dt);
}
?>

