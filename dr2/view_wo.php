<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script src="form_action.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <title>Preview 2</title>
    </head>
    <body>
        <div class="container">
            <div class="container" style="text-align: center;font-weight: bold;"><h1>Daily Progress Report</h1></div>
            <fieldset>
            <legend style="color:blue;font-weight:bold;text-align: center;">Work Activity</legend>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Work Order Number</th>
                    <th>Task Number</th>
                    <th>Foreman</th>
                    <th>AG</th>
                    <th>UG</th>
                    <th>Other Work</th>
                    <th>Date</th>
                </tr>
            </thead>
        <?php
        require 'db.php';
        $db_handle=new DBController();
        
        $wo=$_POST['wo'];
        $dt=$_POST['dt'];
        echo $dt;
        $query="SELECT * FROM `work_order` WHERE date_done < '$dt' and work_order_no='$wo' order by date_done";
        $result=$db_handle->runQuery($query);
        if(!empty($result))
        {
            foreach($result as $row)
            {
                $wo=$row['work_order_no'];
                $tn=$row['task_name'];
                $rf=$row['foreman'];
                $ag=$row['ag'];
                $ug=$row['ug'];
                $ow=$row['other_works'];
                $dt=$row['date_done'];
        ?>
             <tr>
                <td><?php echo $wo;?></td>
                <td><?php echo $tn;?></td>
                <td><?php echo $rf;?></td>
                <td><?php echo $ag;?></td>
                <td><?php echo $ug;?></td>
                <td><?php echo $ow;?></td>
                <td><?php echo $dt;?></td>
            </tr>
        <?php
            }
        }
        ?>
        </table>
        </div>
    </body>
</html>
