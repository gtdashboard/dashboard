<?php

//include PHPExcel library
require_once "Classes/PHPExcel/IOFactory.php";

include("db.php");

//load Excel template file
$objTpl = PHPExcel_IOFactory::load("tex.xlsx");
$objTpl->setActiveSheetIndex(0);  //set first sheet as active

$chrStart = 'H';

while ($objTpl->getActiveSheet()->getCell($chrStart.'2')->getValue() <> NULL)
{
        $chrt = $chrStart;
        $WO = $objTpl->getActiveSheet()->getCell($chrt.'2')->getValue();
        $j=6;
        while ($j<91) //(90 rows of active BOQ items so far - while loop for each WO)
        {

            //Hard Coded 'A' for Item No. Column
            $item = $objTpl->getActiveSheet()->getCell('A'.$j)->getValue();

            //current chrt is Arabi Qty Column
            $AQ = $objTpl->getActiveSheet()->getCell($chrt.$j)->getValue();
            $chrt++;

             //current chrt is KOC Qty Column
            $KQ = $objTpl->getActiveSheet()->getCell($chrt.$j)->getValue();
            $chrt++;
            $chrt++;

            //current chrt is Remeasured Qty Column
            $RQ = $objTpl->getActiveSheet()->getCell($chrt.$j)->getValue();

            if($AQ==null)
            {
               $AQ=0; 
            }
            if($KQ==null)
            {
               $KQ=0; 
            }
            if($RQ==null)
            {
               $RQ=0; 
            }
            if(($AQ!=0)||($KQ!=0)||($RQ!=0))
            {
                $db_handle=new DBController();
                $query="INSERT INTO `boq_item`( `pno`, `item_id`, `wo_no`, `arabi_qty`, `koc_qty`, `rem_qty`) VALUES"
                        . " (105,'$item','$WO',$AQ,$KQ,$RQ)";
                echo "<br>";
                echo $query;
                $result=$db_handle->runUpdate($query);
                if($result)
                {
                    echo 'Inserted';
                }
               // echo $WO . " , " . $item . " , " . $AQ . " , " . $KQ . " , " . $RQ . "</br>";
            }
        

        $j++;
        $chrt = $chrStart;

        }
//skipping 6 characters to start next WO Column. after Z, it goes to AA (perl style)
$chrStart++;
$chrStart++;
$chrStart++;
$chrStart++;
$chrStart++;
$chrStart++;

}
?>
