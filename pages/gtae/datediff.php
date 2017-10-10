<?php
$d1='2016-12-18';
$end='2021-12-17';

function elapse($start,$end)
{
    $today= date('Y-m-d');
    $datetime1 = date_create($start);
    $datetime2 = date_create($today);
    $datetime3 = date_create($end);
    $differenceFormat = '%a';   
    $interval1 = date_diff($datetime1, $datetime2);
    $interval2 = date_diff($datetime1, $datetime3);
    $current= $interval1->format($differenceFormat);
    $total= $interval2->format($differenceFormat);
    $per=($total-$current)/100;
    return round($per);
}
function elapse_days($start,$end)
{
    $today= date('Y-m-d');
    $datetime1 = date_create($start);
    $datetime2 = date_create($today);
    $datetime3 = date_create($end);
    $differenceFormat = '%a';   
    $interval1 = date_diff($datetime1, $datetime2);
    $interval2 = date_diff($datetime1, $datetime3);
    $current= $interval1->format($differenceFormat);
    $total= $interval2->format($differenceFormat);
    $per=($total-$current)/100;
    return round($current);
}
 
?>

