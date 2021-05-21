<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "esoukhin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT * FROM `user_table` ";
$resultn = $conn->query($sql);

$result = mysqli_query($conn, $sql);  
$json_array = array();  
while($row = mysqli_fetch_assoc($result))  
{  
     array_push($json_array, $row);  
 }  

 header('Content-Type: application/json');
 echo json_encode($json_array);  

 ?> 

 