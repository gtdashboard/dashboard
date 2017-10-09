<?php
require 'db.php';
$db_handle=new DBController();
 $query_nk="SELECT distinct(wo_numbers.work_order_no) as work_order_no,wo_status.id_wo as id_wo "
            . "FROM wo_status,wo_numbers "
            . "WHERE STATUS =1 AND wo_status.id_wo NOT IN (SELECT id_wo FROM wo_status WHERE STATUS >1) and wo_numbers.pno=104 and wo_status.id_wo=wo_numbers.id_wo ";
           
    
    $result_nk=$db_handle->runQuery($query_nk);
    if(!empty($result_nk))
    {
        echo json_encode($result_nk);
        foreach ($result_nk as $row)
        {
            $wo1=$row['work_order_no'];
            $id_wo=$row['id_wo'];
            $wo= substr($wo1,13);
            $wo="WO $wo";
            $total_query="SELECT "
                    . "(SELECT SUM( progress_points ) FROM wo_progress WHERE wo_id =$id_wo)"
                    . "/"
                    . "( SELECT SUM( points )"
                    . " FROM wo_weightage "
                    . "WHERE id IN(SELECT `activity_id` FROM `wo_progress` WHERE `wo_id` =$id_wo)) *100 as total";
            //echo "<br>$total_query";
            $total_result=$db_handle->runQuery($total_query);
            echo json_encode($total_result);
            foreach ($total_result as $row)
            {
               $total=$row['total'];
            }
            if($total!=0)
            {
                $nk_array[] = array(
                'label' => $wo,
                'value' => "$total",
                'color' =>  '#ff8693',
                );
            }
            
        }
    }

