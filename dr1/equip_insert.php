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
$count_equip=$_POST["cequip"];
        //echo "$count_equip";
        for($i=1;$i<=$count_equip;$i++)
        {
            if(isset($_POST['type'.$i])&&(isset($_POST['num'.$i]))&&(isset($_POST['hrs'.$i])))
            {
                $name=$_POST['type'.$i];
                $des=$_POST['num'.$i];
                $cat=$_POST['hrs'.$i];
                $query="select * from equipment where type='$name' and date_used='$dt' and pno=$p";
                $result=$db_handle->runQuery($query);
                if(empty($result))
                {
                    $query="insert into equipment(type,number_equip,hours,date_used,pno) values ('$name',$des,$cat,'$dt',$p)";
                    
                    $result=$db_handle->runUpdate($query);
                    if($result)
                    {
                        echo 'inserted';
                    }
                }
                else
                {
                    foreach($result as $row)
                    {
                        $id=$row['id_equip'];
                    }
                    $query="update equipment set type='$name',number_equip=$des,hours=$cat where id_equip=$id";
                    //echo $query;
                    $result=$db_handle->runUpdate($query);
                    if($result)
                    {
                        echo 'updated';
                    }
                }
            }
        }
        header("Location:weather_daily.php?dt=".$dt);
?>
