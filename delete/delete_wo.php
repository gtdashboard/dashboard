<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db.php';
$db_handle=new DBController();
$id=$_POST['id_wo'];
$query="DELETE FROM work_order WHERE id_work_order=".$id;
echo $query;
$result=$db_handle->runUpdate($query);
if($result)
{
    echo 'deleted';
}
?>

