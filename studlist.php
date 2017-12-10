<!DOCTYPE html>
<?php
$con=mysqli_connect("localhost","testuser","test623","testdb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select * from  studenten");

while($row = mysqli_fetch_array($result))
  {
  echo $row['llnr']." ; " . $row['uuid'] . " ; " . $row['email'] ;
  echo "<br>";
  }

mysqli_close($con);

?>