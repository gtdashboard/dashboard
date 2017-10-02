<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "special_projects";
	
	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->selectDB($conn);
		}
	}
	
	function connectDB() {
		$conn = mysql_connect($this->host,$this->user,$this->password);
		return $conn;
	}
	
	function selectDB($conn) {
		mysql_select_db($this->database,$conn);
	}
	
	function runQuery($query) {
		$result = mysql_query($query);
                if(!empty($result))
                {
                    while($row=mysql_fetch_assoc($result)) {
                        $resultset[] = $row;
                    }
                }
				
		if(!empty($resultset))
	            return $resultset;
	}
        function runQuery2($query) {
		$result = mysql_query($query);
	        return $result;
	}
        function runUpdate($query) {
		$result = mysql_query($query);
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