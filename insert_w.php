<?php
$con=mysqli_connect("localhost","testuser","test623","testdb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$date=date('d.m.y h:i:s');

$sql="INSERT INTO weight (edate, weight)
VALUES
('$date','$_POST[weight]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }


mysqli_close($con);

sleep(1);
echo "1 record added";

header('location: index.php');
?>
