<?php 
include "connect.php";

if(isset($_REQUEST['register'])){
	if(($_REQUEST['name']=="") || ($_REQUEST['email']=="") || ($_REQUEST['mobile']=="") || ($_REQUEST['pass']=="")){
		echo "Please Fill All Form";
	}
	else
	{
		$name = $_REQUEST["name"];
		$email = $_REQUEST["email"];
		$mobile = $_REQUEST["mobile"];
		$password = $_REQUEST["pass"];
		$sql = "INSERT INTO `marchant`(`name`, `email`, `mobile`, `pass`)  VALUES ('$name','$email','$mobile','$password')";
		if($conn->query($sql)==TRUE){
			echo "Your data has been registered";
		}
		else{
			echo "Unable to record data";
		}
		
	}
}



?>


<!DOCTYPE html>
<html>
<head>
    <title>Fast Courier || Marchant Registration</title>

    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <style type="text/css">
        body{
    font-family: 'Segoe UI', sans-serif;;
    font-size: 1rem;
    line-height: 1.6;
    height: 100%;
    background-image:url(images/courier.jpg);
    background-size: cover;
    background-attachment: fixed;
    }

    </style>
</head>
<body>
    <div class="wrap">
        <form method="post" class="login-form" action="">
            <div class="form-header">
                <h3>Register Marchant</h3>
                <p>Register to access the dashboard</p>
            </div>
            <!--Name Input-->
            <div class="form-group">
                <input type="text" class="form-input" name="name" placeholder="Username">
            </div>
            <!--Email Input-->
            <div class="form-group">
                <input type="text" class="form-input" name="email" placeholder="E-mail">
            </div>
            <!--Mobile_Number Input-->
            <div class="form-group">
                <input type="text" class="form-input" name="mobile" placeholder="Mobile Number">
            </div>
            <!--Password Input-->
            <div class="form-group">
                <input type="password" class="form-input" name="pass" placeholder="Password">
            </div>
            <!--Registration Button-->
            <div class="form-group">
                <button class="form-button" type="submit" name="register">Sign Up</button>
            </div>
            <div class="form-footer">
            Already have an account? <a href="login.php" style="text-decoration:none"><b>Sign In</b></a>
            </div>
        </form>
    </div><!--/.wrap-->
</body>
</html>