<?php
  $servername = "localhost";
  $username = "name_of_the_user";
  $password = "users_password";
  $dbname = "myDatabase";

 // Create connection  
  $conn = mysqli_connect($servername, $username, $password, $dbname); 

 // Check connection  	
  if (!$conn) 
  {      
     die("Connection went wrong: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO MovieList (title, rating, price) VALUES ('random_movie', 'good', '5')";
  if (mysqli_query($conn, $sql))
  {    
     echo "Inserted successfully";
  } 
  else 
  {    
     echo "Error: ". $sql . "<br>" . mysqli_error($conn);}mysqli_close($conn);
  }
?>
