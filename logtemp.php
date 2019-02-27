<?php


  //   http://84.80.49.52:85/logtemp.php?device=1&temp=1.3&humidity=2.3

  $device = $_GET['device'];
  $temp = $_GET['temp'];
  $humidity = $_GET['humidity'];

  $servername = "localhost";
  $username = "testuser";
  $password = "test623";
  $dbname = "testdb";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    
    if(!empty($_POST['sdevice']) && !empty($_POST['temp']) && !empty($_POST['humidity']) )
    {
      $device = $_POST['device'];
      $temp = $_POST['temp'];
      $humidity = $_POST['humidity'];

	    $sql = "insert into temp_log(device,temp,humidity) VALUES ($device, $temp, $humidity)";

      if ($conn->query($sql) == TRUE) {
      echo "New record created successfully";
      } else {
       echo "......Error: " . $sql . "<br>" . $conn->error;
	   }
  }


  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

?>
