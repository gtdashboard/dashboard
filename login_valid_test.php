<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'db.php';
session_start();
$db_handle=new DBController();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $user=$_POST['username'];
    $pass=$_POST['password'];
    $query="select * from login where username='".$user."' and password='".$pass."' and pno=".$_SESSION['project'];
    $result=$db_handle->runQuery($query);
    if(!empty($result))
    {
        foreach($result as $row)
        {
            $_SESSION['userid']=$row['userid']; 
            $_SESSION['user_name']=$row['username'];
            echo $row['userid'];
        }
        header("Location:print/view.php");
        
    }
    else
    {
        echo 'invalid credentials';
       // header("Location:login.php");
    }
}
?>

