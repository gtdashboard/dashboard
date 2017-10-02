<?php
$dt=$_POST['date_selected'];
$cat=$_POST['cat'];
//$r=date("w", strtotime($dt));
//$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
//echo $days[$r];
if($cat==1)
{
    echo "console.log('next daily report1')";
    header("Location:dr1/staff_daily.php?dt=".$dt);
}
if($cat==2)
{
    echo "console.log('next daily report2')";
    header("Location:dr2/work_order.php?dt=".$dt);
}
?>