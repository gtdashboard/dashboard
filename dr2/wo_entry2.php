<?php
require '../db.php';
session_start();
$p=$_REQUEST['project'];
$db_handle=new DBController();
$query="select distinct(work_order_no) from work_order where pno=$p";
echo $query;
$result=$db_handle->runQuery($query);
foreach ($result as $row)
{
    $wo=$row['work_order_no'];
    echo "$wo<br>";
    $query2="select max(date_done) as max_date,min(date_done) as min_date from work_order where work_order_no='$wo' and pno=$p";
    $result2=$db_handle->runQuery($query2);
    echo $query2;
    echo "<br>";
    foreach ($result2 as $row2)
    {
        $dt_max=$row2['max_date'];
        $dt_min=$row2['min_date'];
    }
    $query_wo_test="select * from wo_numbers where work_order_no='$wo'";
    $result_wo_test=$db_handle->runQuery($query_wo_test);
    if(empty($result_wo_test))
    {
        $q2="insert into wo_numbers(work_order_no,start_date,last_date_done,pno) values('$wo','$dt_min','$dt_max',$p)";
        echo $q2;
        echo "<br>";
        $r2=$db_handle->runUpdate($q2);
        if($r2)
        {
            echo 'inserted';
        }
        echo "<br>";
    }
 else {
        $q2="update wo_numbers set last_date_done='$dt_max',start_date='$dt_min',pno=$p where work_order_no='$wo'";
        $r2=$db_handle->runUpdate($q2);
        echo $q2;
        echo "<br>";
        if($r2)
        {
            echo 'updated';
        }
        echo "<br>";
    }
}
//header("Location:wo_update.php");
?>


