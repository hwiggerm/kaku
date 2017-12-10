<?php

	$con= new mysqli("localhost","testuser","test623","testdb");

	$lamp = mysqli_real_escape_string($con, $_GET['lamp']);
	$action = mysqli_real_escape_string($con, $_GET['action']); 
	

	// Check connection
	if (mysqli_connect_errno())
	// Check connection
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

	
	shell_exec('/usr/bin/python /home/pi/kaku/klik.py  '.$lamp.' '.$action.' ');
	
	$sql = "select * from  switchlist";

	echo "{" ;
	//echo "<br>";
	echo "\"lights\"" ;
	echo " : ";

	// Check if there are results

	if ($result = mysqli_query($con, $sql))
		{
		// If so, then create a results array and a temporary one
		// to hold the data
		$resultArray = array();
		$tempArray = array();
 
		// Loop through each row in the result set
		while($row = $result->fetch_object())
		{
			// Add each row into our results array
			$tempArray = $row;
	    	array_push($resultArray, $tempArray);
		}
 
		// Finally, encode the array to JSON and output the results
		echo json_encode($resultArray);
		}

	// Close connections
	mysqli_close($con);
	echo "}" ;


?>
