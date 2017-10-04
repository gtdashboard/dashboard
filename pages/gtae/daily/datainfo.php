<?php
require '../db.php';
session_start();
if(isset($_REQUEST['p']))
{
    $p=$_REQUEST['p'];
    $project="sp_".$p;
}
 else {
     $p=104;
     $project="sp_104";
 }
$db_handle=new DBController();

$query="select distinct(date) from worker where pno=$p";
$result=$db_handle->runQuery($query);


if(!empty($result))
{
    $i=0;
    $response=array();
    foreach($result as $row)
    {
        $i++;
        $date=$row['date'];
        $event_array[] = array(
            'id' => $i,
            'title' => 'Daily Report 1',
            'start' => $date,
            'end' => $date,
            'allDay' => true,
            'color' =>  '#f4719a',
            'url' =>  "print/print_page1.php?dt=$date&p=$p"
        );
        
    }
    
}
    
    $query2="select distinct(date_done) from work_order where pno=$p";
    $result2=$db_handle->runQuery($query2);
    if(!empty($result2))
    {
        $i=0;
        $response=array();
        foreach($result2 as $row2)
        {
            $i++;
            $date=$row2['date_done'];
            $event_array[] = array(
            'id' => $i,
            'title' => 'Daily Report 2',
            'start' => $date,
            'end' => $date,
            'allDay' => true,
            'color' =>  '#4ac7cc',
            'url' =>  "print/print_page2.php?dt=$date&p=$p"
            );
        }
    }  
echo json_encode($event_array);
?>