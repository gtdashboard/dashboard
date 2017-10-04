<?php
//function track_id($p,$type,$date)
require 'db.php';
$db_handle=new DBController();
$p="104";
$type="AE";
$dt='2017-08-22';
$dt= strtotime($dt);   
$date2=date('ymd',$dt);
$track="SP$p$type$date2";
//echo $track;
echo "<br>";
$basic="SELECT * FROM `afe` WHERE tracking_id like '$track%'";
$result_basic=$db_handle->runQuery($basic);
if(!empty($result_basic))
{
    foreach($result_basic as $row)
    {
        $track_last=$row['tracking_id'];
       // echo $track_last;
    }
    echo "<br>";
    $serial=substr($track_last, 13,16);
    //echo $serial;
    $serial+=1;
    echo "<br>";
    $serial=str_pad($serial, 3, '0', STR_PAD_LEFT);
    $track.=$serial;
    echo "Final Track::".$track;
                
}
else
{
    $serial=1;
    echo "<br>";
    $serial=str_pad($serial, 3, '0', STR_PAD_LEFT);
    $track.=$serial;
    echo "Final Track::".$track;
}
?>
