<?php
  $device = $argv[];
  $temp = $argv[2];
  $humidity = $argv[3];

ct('localhost','testuser','test623','testdb');

  $servername = "localhost";
  $username = "testuser";
  $password = "test623";
  $dbname = "testdb";

 // Create connection  
  $conn = mysqli_connect($servername, $username, $password, $dbname); 

 // Check connection  	
  if (!$conn) 
  {      
     die("Connection went wrong: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO temp_log (device,tstamp,temp,humidity) VALUES ($device, NOW(),$temp, $humidity)";
  if (mysqli_query($conn, $sql))
  {    
     echo "Inserted successfully";
  } 
  else 
  {    
     echo "Error: ". $sql . "<br>" . mysqli_error($conn);}mysqli_close($conn);
  }
?>
