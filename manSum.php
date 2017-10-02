<?php
require 'db.php';
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
$db_handle=new DBController($project);
if($p==104)
{
    $dt='2017-02-02';
}
else if($p==105)
{
    $dt='2016-12-18';
}
//echo $dt;
$initial= strtotime($dt);
$today=Date("Y-m-d");
//echo $today;
$final= strtotime($today);
$now=$dt;

while($now<$today)
{
    $query="select sum(number) as sumE from worker where date='$now'";
    //echo $query;
    
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $s=$row['sumE'];
            //echo $s;
            $man_array[] = array(
            'label' => $now,
            'value' => $s,
            );
            
        }
    }
    $now = strtotime("+1 day", strtotime($now));
    $now=Date("Y-m-d", $now);
}
echo json_encode($man_array);
/*$query="select sum(number) from worker ";
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
            'url' =>  "print/print_page1.php?dt=$date&p=$project"
        );
        
    }
    
}
    
    $query2="select distinct(date_done) from work_order";
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
            'url' =>  "print/print_page2.php?dt=$date&p=$project"
            );
        }
    }  
*/
?>