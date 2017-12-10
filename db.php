<!DOCTYPE html>
<?php
$con=mysqli_connect("localhost","testuser","test623","testdb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"select * from  tempsensor where mdate = (select max(mdate) from tempsensor) ");

while($row = mysqli_fetch_array($result))
  {
  echo "Tijd :" . $row['mdate'] . "Temperatuur:" . $row['temp'] . "C  " . " Vochtigheid:" . $row['humid'] . "%" . " Buitentemp:" . $row['extemp'] . "C  " ;
  echo "<br>";
  }


$result = mysqli_query($con,"select description,ntime,srdelta,ssdelta,saction  from timetable, devices where devices.devid = timetable.devid ");

while($row = mysqli_fetch_array($result))
  {
  echo "Naam :" . $row['description'] . "  " . "Tijd" . $row['ntime'] .$row['srdelta'] .$row['ssdelta'] . "Action" . $row['saction'] ;
  echo "<br>";
  }

$result = mysqli_query($con,"select  description from switchlist, devices where devices.devid = switchlist.sdevid ");

while($row = mysqli_fetch_array($result))
  {
  echo "Staat Aan: " . $row['description'] ;
  echo "<br>";
  }

mysqli_close($con);

$output=shell_exec('pgrep python');
echo "Processes:" . $output

?>


