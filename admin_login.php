<?php
// Start the session
session_start();

require('connect.php');

if (!isset($_SESSION['ANAME'])){
if (isset($_POST['user_in'])) {

  $name = trim($_POST['name']);
  $upass = trim($_POST['pass']);
  $h_upass = $upass;
if ($upass == ''){
     ?>    <script type="text/javascript">
                alert("Password is missing!");
                window.location = "admin_login.php";
                </script>
        <?php
}
else{
    $h_upass=md5($h_upass);
//create some sql statement             
        $sql = "SELECT * FROM  `admin_table` WHERE  `admin_name` =  '" . $name . "' AND  `admin_pass` =  '" . $h_upass . "'";
        $result = $conn->query($sql);

        if ($result){
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);

                //fill the result to session variable
                $_SESSION['ADMIN_ID']  = $found_user['aid']; 
                $_SESSION['ANAME'] = $found_user['admin_name']; 
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      window.location = "dashboard.php";
                  </script>
             <?php        
           
        
            } else {
            //IF theres no result
              ?>    <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "admin_login.php";
                </script>
        <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }       
}
}
else{
  echo "<script> location.href='dashboard.php' </script>";

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
      <li class="nav-item">
        <a class="nav-link" href="#">Tracking</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="user_login.php"><button type="button" class="btn btn-warning">Merchant Login</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="staff_login.php"><button type="button" class="btn btn-danger">Staff Login</button></a>
      </li>
    </ul>
  </div>
</nav>



    <section id="banner"><div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
          <div class="card">
  <h5 class="card-header text-center">Admin Login</h5>
  <div class="card-body">
    <h5 class="card-title text-center" style="color: grey">Login to access the dashboard</h5>
    <form method="POST" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" placeholder="******">
  </div>
  <button type="submit" class="btn btn-block btn-own text-light" name="user_in" style="margin-top: 15px">Login</button>
</form>
  </div>
</div>  
  </div>


    </div>
  </div>
</section>


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






</body>
</html










SELECT (SELECT COUNT(p_id) FROM parcel WHERE par_status='in transit' AND DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' ORDER BY stamp_created) as transit,(SELECT COUNT(p_id) FROM parcel WHERE par_status='Not pickup yet' AND DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' ORDER BY stamp_created) as not,(SELECT COUNT(p_id) FROM parcel WHERE par_status='Delivered' AND DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' ORDER BY stamp_created) as delivered,(SELECT COUNT(p_id) FROM parcel WHERE par_status='picked up' AND DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' ORDER BY stamp_created) as pickedup,(SELECT COUNT(p_id) FROM parcel WHERE DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' ORDER BY stamp_created) as total