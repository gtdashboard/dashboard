<?php
$dt=$_POST['date_selected'];
echo $dt;

$cat=$_POST['cat'];
echo $cat;
if($cat==1)
{
    header("Location:print_page1.php?dt=$dt");
}
if($cat==2)
{
    header("Location:print_page2.php?dt=".$dt);
}
?>