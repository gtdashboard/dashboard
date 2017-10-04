

<?php

require '../db.php';
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

if (isset($_POST['submit']))

{


  $woid = $_POST['wo'];
	$resultWODetails = mysql_fetch_array(mysql_query("SELECT * FROM wo_numbers where id_wo='$woid'"));
        $pno = $resultWODetails['pno'];
        $wno = $resultWODetails['work_order_no'];
        $woStartDate = $resultWODetails['start_date'];
echo " </br>";
  echo "Project No: $pno </br>";
  echo "Work Order No: $wno </br>";
  echo "Start Date: $woStartDate </br>";

  $sql = "SELECT * from wo_progress where wo_id = $woid";
  $result=$db_handle->runQuery($sql);
  if(!empty($result))
  {
    $countAct=0;
    $totalMaxPoints=0;
    $totalCurrentPoints=0;
    echo "<form name='editprogress' action='woprogressupdate.php' method='post'>\n";
    foreach ($result as $row)
    {
          $countAct++;
          $activity_id = $row['activity_id'];
          $progress_points = $row['progress_points'];
          $resultActivity = mysql_fetch_array(mysql_query("SELECT * FROM wo_weightage where id='$activity_id'"));
          $activity = $resultActivity['activity'];
          $maxPoints = $resultActivity['points'];
          $totalMaxPoints=$totalMaxPoints+$maxPoints;
          $totalCurrentPoints=$totalCurrentPoints+$progress_points;
          echo "<div id='slidecontainer'>";
          echo "<input type='range' min='0' max='$maxPoints' value='$progress_points' class='slider' id='myRange".$countAct."' name='actpoints[]'>$activity \n";
          echo "<input type='hidden' name='activityid[]' value='$activity_id'>\n";
          echo "<span id='val".$countAct."' style='font-weight:bold;color:red'>0</span>\n";

          echo "<script>\n";
          echo "var slider".$countAct." = document.getElementById('myRange".$countAct."');\n";
          echo "var output".$countAct." = document.getElementById('val".$countAct."');\n";
          echo "output".$countAct.".innerHTML = slider".$countAct.".value; // Display the default slider value\n";

          // Update the current slider value (each time you drag the slider handle)
          echo "slider".$countAct.".oninput = function() {\n";
          echo "output".$countAct.".innerHTML = this.value;\n";
          echo "}\n";
          echo "</script>\n";
          echo "</div>\n";
          echo "</br>\n";
    }
    echo "Total Current Points:". $totalCurrentPoints."</br>\n";
    echo "Total Max Points:". $totalMaxPoints."</br>\n";
    echo "Percentage Complete:" . $totalCurrentPoints/$totalMaxPoints*100 . "</br>\n";
    echo "<input type='hidden' name='woid' Value='$woid'>";
    echo "<input type='submit' name='pointUpdate' Value='Update'>";
    echo "</Form>";
  }

}// if wo selected to edit activity points
elseif (isset($_POST['pointUpdate']))
{
$count=0;
$woid = $_POST['woid'];

  if(!empty($_POST['actpoints'])) {
      foreach($_POST['actpoints'] as $check1) {
              $actid = $_POST['activityid'][$count]; //this should be done using json
              echo $actid.":".$check1."</br>\n";
            //  $sql= "INSERT into wo_progress (wo_id, progress_points) values ('$woid',$check1)";
                $sql= "UPDATE wo_progress SET progress_points = '$check1' WHERE wo_id = '$woid' and activity_id = '$actid'";
                $result=$db_handle->runUpdate($sql);
              if (!$result)
              {
                die('Error: '  . mysqli_error($db) . ":" . $sql);

              }
              else {
                echo "<B>updated</B></br>\n";
              }
              $count++;

            }
          }

}//if update points form submitted
else
{

//echo $wono . ":" . $pono;


	$sql =  "SELECT DISTINCT wo_numbers.work_order_no, wo_numbers.id_wo FROM wo_numbers, wo_progress WHERE wo_progress.wo_id = wo_numbers.id_wo AND wo_numbers.pno=$pono";
	$result=$db_handle->runQuery($sql);
  //$result = mysqli_query($db,$sql);
  echo "<form name='wonosubmit' action='woprogressupdate.php' method='post'>";
	echo "<select name='wo' id='wo'>";

	$incr=0;
	if(!empty($result))
	{
		foreach ($result as $row)
		{
          $work_order_no = $row['work_order_no'];
          $id_wo = $row['id_wo'];
          echo "<option value='$id_wo'>$work_order_no</option>\n";
		}
    //$boqResult = getBoqDetails($item_id, $pono);

    	}
    	else
    	{
      		echo mysqli_error( mysqli_connect("localhost:8889","root","root"));
          echo "here error";
	}

	echo "</select>\n";
  echo "<input type='submit' name='submit'>\n";
}



?>
