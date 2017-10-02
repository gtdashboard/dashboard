<?php
require '../db.php';
session_start();
$p=$_SESSION['project'];
$db_handle=new DBController();
$query="select distinct(work_order_no) from work_order where pno=$p";
$result=$db_handle->runQuery($query);
foreach ($result as $row)
{
    $wo=$row['work_order_no'];
    $query2="select * from wo_numbers where work_order_no='$wo'";
    echo "<br>";
    echo $query2;
    echo "<br>";
    $result2=$db_handle->runQuery($query2);
    foreach ($result2 as $row2)
    {
        $wo_no=$row2['id_wo'];
        echo "<br>";
        echo "id:$wo_no";
        echo "<br>";
    }
    $query3="update work_order set wo_no=$wo_no where work_order_no='$wo'";
    echo "<br>";
    echo $query3;
    echo "<br>";
    $result3=$db_handle->runUpdate($query3);
    if($result3)
    {
        echo 'updated';
    }
}
header("Location:../print/view.php");
?>
