<?php

include "connect.php";

$name = $_POST['name'];
$password = $_POST['password'];

$sql = "SELECT * FROM `marchant` WHERE name = '$name' ";

$check = mysqli_fetch_array(mysqli_query($conn,$sql));

  if(isset($check)){
    
     // Successfully Login Message.
     $onLoginSuccess = 'Login Matched';
     
     // Converting the message into JSON format.
     $SuccessMSG = json_encode($onLoginSuccess);
     
     // Echo the message.
     echo $SuccessMSG ; 
   
   }

// $result = array();

// while($fretchData=$sql->fetch_assoc()){
//   $result[]= $fretchData;
// }
// echo json_encode($result[0]['name']);


  



?>