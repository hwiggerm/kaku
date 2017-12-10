<!DOCTYPE html>
<?php
$con=mysqli_connect("localhost","testuser","test623","testdb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select * from  beaconvisits order by passdate desc ");

while($row = mysqli_fetch_array($result))
  {
  echo $row['passdate'].";" . $row['whop'] . ";" . $row['beacon'] . ";" . $row['state'] ;
  echo "<br>";
  }

mysqli_close($con);

?>