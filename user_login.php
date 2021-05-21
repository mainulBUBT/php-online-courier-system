<?php
//------------------------- Start the session--------------------//

session_start();

require('connect.php');

//------------------------- Condition for users--------------------//
//if user has already logged in then else part will work, users redirected to the dashboard
//if user not logged in then session store all info then redirected to the dashboard

if(!isset($_SESSION['NAME']))
{
  //------------------------- Condition for form--------------------//

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


  $h_upass=md5($h_upass);
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
                      window.location = "user_dashboard.php";
                  </script>
             <?php        
           
        
            } else {
            //IF theres no result
              ?>    <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "user_login.php";
                </script>
        <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }       
}//------------------------- Condition for form END--------------------// 
}
else {
  echo "<script> location.href='user_dashboard.php' </script>";
} //------------------------- Condition for users--------------------//


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
      *{
        margin: 0;
        padding: 0;
      }
      body {
         background-color:    #e5e8e8 ;
        font-family: sans-serif;

}

        #nav-bar{
          position: sticky;
          top: 0;
          z-index: 10;
      }
      .navbar{
         background-image: linear-gradient(to right, #009688, #004d40);
      }
      .navbar-nav li{
        padding: 0 10px;
      }
      .navbar-nav li a
      {
        color: #fff !important;
        font-weight: 600;
      }
      #link { color: white; }
        .card{
          padding-bottom: 25px;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .btn-own{
          padding: 10px;
          font-weight: bold;
        }
        #banner{
          background-image: linear-gradient(to right, #009688, #004d40);
          padding: 5%;
          border-bottom-color: #eceff1;
          height: 100vh;
        }
    </style>
    <title>Merchant Login | Fast Delivery</title>
</head>
<body>
   <!-- Navigation bar -->
      <nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">
    <img src="images/icon1.png" width="40" height="40" class="d-inline-block align-top" alt="">Fast Delivery
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Tracking<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_login.php"><button type="button" class="btn btn-info">Admin Login</button></a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="staff_login.php"><button type="button" class="btn btn-warning">Staff Login</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_reg.php"><button type="button" class="btn btn-danger">Merchant Register</button></a>
      </li>
    </ul>
  </div>
</nav>



    <section id="banner"><div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
          <div class="card">
  <h5 class="card-header text-center">Merchant Login</h5>
  <div class="card-body">
    <h5 class="card-title text-center" style="color: grey">Login to access the dashboard</h5>
    <form method="POST" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" id="name" class="form-control" name="name" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
  </div>
  <button type="submit" class="btn btn-block btn-own text-light" name="user_in" style="margin-top: 15px">Login</button>
</form>
  </div>
</div>  
  </div>


    </div>
  </div>
</section>



 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>




</body>
</html>