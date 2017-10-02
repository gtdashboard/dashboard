<!DOCTYPE html>
<html>
<head>
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>
<script>
var myVar;

function myFunction() {
   // myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
  var data;
  data = <?php db_create(); ?>;
  console.log("data",data);
  if(data)
  {
       document.getElementById("loader").style.display = "block";
        document.getElementById("myDiv").style.display = "none";
  }
}
</script>

</head>
<body onload="showPage()">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
    <h2>Tada!</h2>
    <p>
<?php
function db_create()
{
// Name of the file
$filename = 'db_structure.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'sp_'.$_POST['project'];

// Connect to MySQL server
$conn=mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database


$sql = "CREATE DATABASE IF NOT EXISTS $mysql_database";
if (mysql_query($sql,$conn)) {
    echo "Database created successfully";
} 
else {
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
 return 1;
}
?>
</p>
</div>
</body>
</html>