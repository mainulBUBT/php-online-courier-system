<?php 
session_start();

include "connect.php";

if(isset($_SESSION['ANAME']))
{
$NAME= $_SESSION["ANAME"];
$ids = $_SESSION["ADMIN_ID"];
}
else {
	echo "<script> location.href='admin_login.php' </script>";
}


?>