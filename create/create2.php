<?php
// Name of the file
$filename = 'db_structure.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$db_name='sp_'.$_REQUEST['project'];
$mysql_username = "$db_name";
//$mysql_username = "root";
// MySQL password
$mysql_password = "$db_name";
//$mysql_password = "";
// Database name
//$mysql_database = 'sp_'.$_POST['project'];


$mysql_database = "$db_name";
// Connect to MySQL server
$conn=mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database


$sql = "CREATE DATABASE IF NOT EXISTS $mysql_database";
if (mysql_query($sql,$conn)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
        // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

        // Add this line to the current segment
        $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}
 echo "Tables imported successfully";
 session_start();
 $_SESSION['project']=$db_name;
 header("Location:creation_success.php");

?>