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
        else
        {
            header("Location:../print/view.php");
        }
        $count=$_POST['cwo'];
        $inst=$_POST['instructions'];
        $acc=$_POST['accidents'];
        $rem=$_POST['remarks'];
        if(isset($_POST['id_site']))
        {
            $id=$_POST['id_site'];
        }
        $query="select * from site_info where date_site='$dt' and pno=$p";
        $result=$db_handle->runQuery($query);
        if(empty($result))
        {
            $query2="insert into site_info(instruction,accidents,remarks,date_site,pno) values ('$inst','$acc','$rem','$dt',$p)";
            echo $query2;
            $result2=$db_handle->runUpdate($query2);
            if($result2)
            {
               //echo 'inserted work_order';
            }
        }
        else
        {
            $query2="UPDATE `site_info` SET `instruction`='$inst',`accidents`='$acc',`remarks`='$rem' WHERE date_site='$dt'";
            echo $query2;
            $result2=$db_handle->runUpdate($query2);
            if($result2)
            {
               //echo 'updated';
            }

        }
        for($i=1;$i<=$count;$i++)
        {
            if((isset($_POST['wo'.$i]))&&(isset($_POST['tn'.$i]))&&(isset($_POST['rf'.$i]))&&(isset($_POST['ag'.$i]))&&(isset($_POST['ug'.$i]))&&(isset($_POST['ow'.$i])))
            {
                $wo=$_POST['wo'.$i];
                $tn=$_POST['tn'.$i];
                $rf=$_POST['rf'.$i];
                $ag=$_POST['ag'.$i];
                $ug=$_POST['ug'.$i];
                $ow=$_POST['ow'.$i];
                if(isset($_POST['id_wo'.$i]))
                {
                    $id=$_POST['id_wo'.$i];
                }
               
            $query="select * from work_order where work_order_no='$wo' and date_done='$dt' and pno=$p";
            echo "<br>$query<br>";
            $result=$db_handle->runQuery($query);
            if(empty($result))
            {
                $query="insert into work_order(work_order_no,task_name,foreman,ag,ug,other_works,date_done,pno) values ('$wo','$tn','$rf',$ag,$ug,'$ow','$dt',$p)";
                echo $query;
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                    //echo 'inserted';
                }
            }
            else
            {
                foreach($result as $row)
                {
                    $id=$row['id_work_order'];
                }
                $query="UPDATE `work_order` SET work_order_no='$wo',`task_name`='$tn',`foreman`='$rf',`ag`=$ag,`ug`=$ug,`other_works`='$ow' WHERE id_work_order=".$id;
                echo "<br>$query<br>";
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                   //echo 'updated work_order';
                }
             }
          }
        }
        header("Location:wo_entry.php");
?>
