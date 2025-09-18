<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "api";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (id, name, email, phone )
VALUES ('190151','Fidel Onunga', 'onungafidel374@gmail.com', '0713468861')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>