
<?php

/*
	place beacon data in the mysqldb
	use this url   http://84.80.49.52:85/beaconv.php?whop=hans&beacon=12345
	read data in  http://84.80.49.52:85/blog.php

	date: 30-dec-2014
	who: Hans
	version: 1.2

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
$whop = mysql_real_escape_string($_GET['whop']); 
$beacon = mysql_real_escape_string($_GET['beacon']);

//create sql string
$sql = "INSERT INTO beaconvisits(passdate, whop, beacon) VALUES (now(), '$whop', '$beacon')"; 


//execute string
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

$sql = "SELECT action, urlred, message FROM beacons where id = '$beacon' ";
//echo $sql ;

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
  
    while($row = $result->fetch_assoc() ) { 

	if ($row["action"] == "R") {
             echo "R".$row["urlred"];
	}

	if ($row["action"] == "M") {
             echo "M".$row["message"];
		}
	}
} else {
    echo "None";
}


//close connection
mysqli_close($con);

?>