<?php
  require '../db.php';
  session_start();
  $p=$_SESSION['project'];
  $db_handle=new DBController();
if(isset($_GET['dt']))
{
    $dt=$_GET['dt'];
    $st= strtotime($dt);
    $dt=date('Y-m-d',$st);
}
 else {
     header("Location:../print/view.php");
    }
        $temp=$_POST['temp'];
        $rain=$_POST['rain'];
        $storm=$_POST['storm'];
        $o=$_POST['others'];
        $q="select * from weather where date_temp='$dt' and pno=$p";
        $result=$db_handle->runQuery($q);
        if(empty($result))
        {
            $q="INSERT INTO `weather`(temperature, rain, sandstorm,others,date_temp,pno) VALUES ($temp,$rain,$storm,$o,'$dt',$p)";
            //echo $q;
            $result=$db_handle->runUpdate($q);
            if($result)
            {
                echo 'inserted';
            }
        }
        else 
        {
            $q="UPDATE `weather` SET `temperature`='$temp',`rain`='$rain',`sandstorm`='$storm',others='$o' WHERE date_temp='$dt'";
            $result=$db_handle->runUpdate($q);
            if($result)
            {
                echo 'updated';
            }
        }
        header("Location:../dr2/work_order.php?dt=".$dt);
?>

