<?php

    require '../db.php';

    $db_handle=new DBController();
    $key=$_REQUEST['key']; 
    $key= strtoupper($key);
    $response=array();
    //$key='FLN/16053333/001';
    $basic="SELECT * FROM wo_numbers WHERE work_order_no='$key'";
    //echo $basic;
    $result_basic=$db_handle->runQuery($basic);
    if(!empty($result_basic))
    {
        foreach($result_basic as $row)
        {
            $response['pno']=$row['pno'];
            $wo_id=$row['id_wo'];
            $response['id_wo']=$row['id_wo'];
            $response['work_order_no']=$row['work_order_no'];
            $wo_val=$row['value'];
            $response['value_wo']=$wo_val;
            $response['value']=number_format($wo_val,3);
            $response['description']=$row['description'];
            $st=$row['start'];
            if(strcmp($st, '0000-00-00')==0)
            {
                $response['start']="-";
                $response['start_f']="";

            }
            else {
                $st= strtotime($st);
                $response['start']= date('d M Y', $st);
                $response['start_f']= date('d.m.Y', $st);
            }
            $et=$row['end'];
            if(strcmp($et, '0000-00-00')==0)
            {
                $response['end']="-";
                $response['end_f']="";

            }
            else {
                $et= strtotime($et);
                $response['end']= date('d M Y', $et);
                $response['end_f']=date('d.m.Y', $et);
            }
            $issue=$row['issue'];
            if(strcmp($issue, '0000-00-00')==0)
            {
                $response['issue']="-";
                $response['issue_f']="";

            }
            else {
                $issue= strtotime($issue);
                $response['issue']= date('d M Y', $issue);
                $response['issue_f']=date('d.m.Y', $issue);
            }
            $stat="select status, from wo_status where wo_status.id_wo=$wo_id and date_inserted=(select max(date_inserted) from  wo_status where wo_status.id_wo=$wo_id)";
            $result_stat=$db_handle->runQuery($stat);
            if(empty($result_stat))
            {

                $response['status']= "Issued";
            }
            else {
                foreach($result_stat as $row_stat)
                {
                    $status=$row_stat['status'];
                }
                if($status==0)
                {
                    $response['status_issue']= "Issued";
                }
                else if($status==1)
                {
                    $response['status_commence']= "Commenced";
                }
                else if($status==2)
                {
                    $response['status_invoice']= "Invoiced";
                }
                else if($status==3)
                {
                    $response['status_completed']= "Completed";
                }
                else if($status==4)
                {
                    $response['status_onhold']= "On Hold";
                }
                else if($status==5)
                {
                    $response['status_cancelled']= "Cancelled";
                }
            }
        }
        
       
    }
    echo json_encode($response);

?>
