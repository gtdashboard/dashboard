<?php

require 'db.php';
//include "config.php";
$db_handle=new DBController();
$wono = "";
if (isset($_GET['wono'])) {
    $wono = $_GET['wono'];
}
$pono = "";
if (isset($_GET['pono'])) {
    $pono = $_GET['pono'];
}

//echo $wono . ":" . $pono;
$sql =  "SELECT * FROM wo_numbers where pno='$pono'";
$result=$db_handle->runQuery($sql);
//$result = mysqli_query($db,$sql);
echo "<form name='wonosubmit' action='woprogressactivities.php' method='post'>";
echo "<select name='wo' id='wo'>";
$incr=0;
if(!empty($result))
{
    foreach ($result as $row)
    {
        $work_order_no = $row['work_order_no'];
        echo "<option value='$work_order_no'>$work_order_no</option>\n";
    }
    //$boqResult = getBoqDetails($item_id, $pono);
}
echo "</select>\n";
echo "<input type='submit' name='submit'>\n";


function getBoqDetails($item_id, $pono)
{
    $db_handleBOQ=new DBController();
    $sqlboq =  "SELECT * FROM boq where pno='$pono' and serial_boq='$item_id';";
    echo "query is ".$sqlboq;
    $boqResult=$db_handleBOQ->runQuery($sqlboq);
    if(!empty($boqResult))
    {
        while($boqR = mysql_fetch_assoc($boqResult)) 
        {
            return $boqR;
        }
    }
}


?>
