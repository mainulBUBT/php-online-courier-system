<?php
// Start the session
session_start();

require('connect.php');
if (isset($_POST['user_in'])) {

  $name = trim($_POST['name']);
  $upass = trim($_POST['pass']);
  $h_upass = $upass;
if ($upass == ''){
     ?>    <script type="text/javascript">
                alert("Password is missing!");
                window.location = "user_login.php";
                </script>
        <?php
}
else{
//create some sql statement             
        $sql = "SELECT * FROM  `marchant` WHERE  `name` =  '" . $name . "' AND  `pass` =  '" . $h_upass . "'";
        $result = $conn->query($sql);

        if ($result){
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);

                //fill the result to session variable
                $_SESSION['MEMBER_ID']  = $found_user['m_id']; 
                $_SESSION['NAME'] = $found_user['name']; 
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      window.location = "home.php";
                  </script>
             <?php        
           
        
            } else {
            //IF theres no result
              ?>    <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "home.php";
                </script>
        <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }       
} 
 $conn->close();
?>











<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- owned stylesheet -->
    <style>
    	body {
  background-color: #eceff1;
}
        #link { color: white; }
    </style>
</head>
<body>
	<!-- Navigation bar -->
	    <nav class="navbar navbar-expand-lg navbar-dark bg-head">
  <a class="navbar-brand" href="#">
    <img src="images/icon1.png" width="40" height="40" class="d-inline-block align-top" alt="">Fast Delivery
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Logout</button>
  </div>
</nav>
<br>

              <!-- logout Modal-->

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModal">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to logout from the account?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Not now</button>
        <button type="button" class="btn btn-danger"><a id="link" href="Logout.php" style="text-decoration: none;">Logout</a></button>
      </div>
    </div>
  </div>
</div>

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
            <!--Password Input-->
            <div class="form-group">
                <input type="password" class="form-input" name="pass" placeholder="Password">
            </div>
            <!--Registration Button-->
            <div class="form-group">
                <button class="form-button" type="submit" name="user_in">Sign In</button>
            </div>
            <div class="form-footer">
            Don't have an account? <a href="registration.php" style="text-decoration:none"><b>Sign up</b></a>
            </div>
        </form>
    </div><!--/.wrap-->
</body>
</html>