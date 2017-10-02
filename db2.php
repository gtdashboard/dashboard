<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "special_projects";
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			echo 'connected';
		}
	}
	
	function connectDB() {
                $conn=new PDO('mysql:host=localhost;dbname=special_projects',$this->user,$this->password);
		return $conn;
	}
	
	function selectDB($conn) {
		mysql_select_db($this->database,$conn);
	}
	
	function runQuery($query) {
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc())
                    {
                        $resultset[] = $row;
                    }		
                    if(!empty($resultset))
                        return $resultset;
                }
	}
        function runQuery2($query) {
		$result = mysql_query($query);
	        return $result;
	}
        function runUpdate($query) {
		$result = $conn->query($query);
                if(! $result ) {
                    return false;
               die('Could not update data: ' . mysql_error());
               
            }
            return true;
	}
	
	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;	
	}
}
?>