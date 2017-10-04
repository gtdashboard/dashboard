<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('activity');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<?php

require '../db.php';
//include "config.php";
$db_handle=new DBController();

if (isset($_POST['Add'])) 
{
  $woid = $_POST['woid'];
  if(!empty($_POST['activity'])) 
  {
        foreach($_POST['activity'] as $check) 
        {
            $sql= "SELECT * FROM wo_progress WHERE wo_id = '$woid' and activity_id='$check';";
            $resultCheck=$db_handle->runQuery($sql);        
            if (!$resultCheck)
            { 
		$sql= "INSERT into wo_progress (activity_id, wo_id, progress_points) values ('$check','$woid','0')";
		$result=$db_handle->runUpdate($sql);

		if (!$result)
		{
			die('Error: '  . mysqli_error($db) . ":" . $sql);
		}
		else 
		{
  			echo "<B>$check activity updated</B></br>\n";
		}
            }
            else
            {
		echo "$check activity Exists!!</br>";
            }
        }
    }
}
else
{
    $wono = "";
    if (isset($_POST['wo'])) 
    {
        $wono = $_POST['wo'];
    }

    echo $wono;

    //echo $wono . ":" . $pono;

    //GET WO_ID from wo_numbers table using work_order_no.
    $sql =  "SELECT * FROM wo_numbers where work_order_no='$wono'";
    //$result = mysqli_query($db,$sql);
    $result=$db_handle->runQuery($sql);
    if(!empty($result))
    {
	foreach ($result as $row)
	{
            $wo_id = $row['id_wo'];
            echo "\n $wo_id\n";
        }
    }
    else
    {
        echo mysqli_error( mysqli_connect("localhost","root",""));
        echo "here";
    }
    $sql =  "SELECT * FROM wo_weightage";
    //$result = mysqli_query($db,$sql);
    $result=$db_handle->runQuery($sql);

    echo "<form name='selectactivity' action='woprogressactivities.php' method='post'>\n";
    echo "<div>\n";
    echo "<input type='checkbox' onClick='toggle(this)' /> Check All<br/>\n";
    if(!empty($result))
    {
	foreach ($result as $row)
	{
            $activity = $row['activity'];
            $activity_id = $row['id'];
            $points = $row['points'];
            //Select Check boxes if activity already exists 
            $checkIt="";
            $sql= "SELECT * FROM wo_progress WHERE wo_id = '$wo_id' and activity_id='$activity_id';";
	    $resultCheckBox=$db_handle->runQuery($sql);
	    if(!empty($resultCheckBox))
            {
		$checkIt=" checked ";
	    }
            echo "<input type='checkbox' id='$activity_id' name='activity[]' value='$activity_id' " . $checkIt . ">\n";
            echo "<label for='$activity_id'>$activity | $points</label>";
            echo "</br>";
        }
    }
    else
    {
        echo mysqli_error( mysqli_connect("localhost","root",""));
        echo "here";
    }
    echo "</div>\n";
    echo "<input type='hidden' name='woid' value='$wo_id'>\n";
    echo "<div>\n";
    echo "<button type='submit' name='Add'>Add</button>\n";
    echo "</div>\n";
}
echo "\n</br><A href='woprogressupdate.php?pono=104'>SP 104</A> ";
echo "\n</br><A href='woprogressupdate.php?pono=105'>SP 105</A> ";

?>
