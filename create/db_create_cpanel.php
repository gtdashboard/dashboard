<?php
include("xmlapi.php");

$db_host = 'localhost'; 
$cpaneluser = 'quhubadmin';
$cpanelpass = 'uVo5tI6kqg&dqQ'; 


$db_name=$_REQUEST['project'];

$databasename = "$db_name";
$databaseuser = "$db_name"; 
$databasepass = "$db_name"; 

$xmlapi = new xmlapi($db_host);    
$xmlapi->password_auth("".$cpaneluser."","".$cpanelpass."");    
$xmlapi->set_port(2083);
$xmlapi->set_debug(1);
$xmlapi->set_output('array');
//create database    
$createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
print_r($createdb);
//create user 
$usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   

print_r($usr);
 //add user 
$addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array($databasename,$databaseuser, 'all'));

print_r($addusr);
header("Location:create2.php?project=".$db_name);
?>