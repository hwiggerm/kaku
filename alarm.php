
<?php

/*
	place camera data in the mysqldb
	use this url   http://84.80.49.52:85/alarm.php?sensor=12345
	read data in  http://84.80.49.52:85/alarml.php

	date: 23-jan-2015
	who: Hans
	version: 1.1

*/


//create connection to mysql db
$con=mysqli_connect("localhost","testuser","test623","testdb");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//read commandline data
$date=date('d.m.y h:i:s');
$alert = mysql_real_escape_string($_GET['sensor']);

//create sql string
$sql = "INSERT INTO alarm(aldate, sensor) VALUES (now(), '$alert')"; 


//execute string
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

//close connection
mysqli_close($con);

?>