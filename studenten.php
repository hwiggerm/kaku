
<?php

/*
	place student data in the mysqldb
	use this url   http://84.80.49.52:85/studenten.php?llnr=1234&uuid=12345&email=xx@yy
	read data in  http://84.80.49.52:85/stdlist.php

	date: 12-jan-2015
	who: Marc
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
$llnr = mysql_real_escape_string($_GET['llnr']); 
$uuid = mysql_real_escape_string($_GET['uuid']);
$email = mysql_real_escape_string($_GET['email']);


$sql = "SELECT 1 FROM studenten where llnr = '$llnr' ";
//echo $sql ;

$result = $con->query($sql);

if ($result->num_rows > 0) {
    	//nummer bestaat al doe alleen een update
    	$sql = "update studenten set email = '$email' where llnr = '$llnr'"; 

} else {
	//nieuw nummer/student
	$sql = "INSERT INTO studenten(llnr,uuid,email) VALUES ('$llnr', '$uuid', '$email')"; 

}

// echo $sql ;

//execute string
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }

//close connection
mysqli_close($con);

?>