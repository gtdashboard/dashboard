<?php

    require 'db.php';

    $db_handle=new DBController();
   
    $basic="SELECT * FROM `boq_item`,boq WHERE boq_item.wo_no='FLN/16053333/004' AND (boq.serial_boq=boq_item.item_id)";
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        $sum=0;
        $i=0;
        
        foreach($result_basic as $row)
        {
            $i++;
            $s=$row['serial_boq'];
            $sp=$row['sp'];
            $rem=$row['rem_qty'];
            $arab=$row['arabi_qty'];
            $koc=$row['koc_qty'];
            if(($rem!=0)&&($koc==0))
            {
                echo "$i.Rem:($sp*$rem)->$s";
                echo "<br>";
          $sum+=($sp*$rem);
            }
             else if(($arab!=0)&&($koc==0))
            {
                
                echo "$i.Arab:($arab*$sp)->$s";
                echo "<br>";
            //  $sum+=($arab*$sp);
            }
            else if($koc!=0)
            {
                 echo "$i.KOC:($koc*$sp)->$s";
                 echo "<br>";
              // $sum+=($koc*$sp);
            }
        }
        echo $sum;
        //echo json_encode($result_basic);
    }

?>

