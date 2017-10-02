<?php

  require '../db.php';
  session_start();
  $p=$_SESSION['project'];
  $db_handle=new DBController();
    if(isset($_GET['dt'])){
        $dt=$_GET['dt'];
        $st= strtotime($dt);
        $dt=date('Y-m-d',$st);
    }
 else {
     header("Location:../print/view.php");
 }
    $count_staff=$_POST["cstaff"];
    for($i=1;$i<=$count_staff;$i++)
        {
            if((isset($_POST['name'.$i]))&&(isset($_POST['number'.$i]))&&(isset($_POST['cat'.$i])))
            {
                $name=$_POST['name'.$i];
                $num=$_POST['number'.$i];
                $cat=$_POST['cat'.$i];
                $query="select * from worker where designation='$name' and date='$dt' and pno=$p";
                $result=$db_handle->runQuery($query);
                if(empty($result))
                {
                    $q="insert into worker(designation,number,category,date,pno) values ('$name',$num,$cat,'$dt',$p)";
                    $result1=$db_handle->runUpdate($q);
                    if($result1)
                    {
                        //echo 'inserted';
                    }
                }
                else
                {
                    foreach($result as $row)
                    {
                        $id=$row['id_worker'];
                    }
                    $q="update worker set category=$cat,designation='$name',number=$num where id_worker=$id";
                    $result1=$db_handle->runUpdate($q);
                    if($result1)
                    {
                        //echo 'updated';
                    }
                }
               
            }
    }
    if($cat==0)
    {
         header("Location:skilled1_daily.php?dt=".$dt);
    }
    else if($cat==1)
    {
         header("Location:skilled2_daily.php?dt=".$dt);
    }
    else if($cat==2)
    {
         header("Location:unskilled_daily.php?dt=".$dt);
    }
    else {
         header("Location:equipment_daily.php?dt=".$dt);
    }

?>


