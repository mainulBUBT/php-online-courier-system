<?php 
include "connect.php";

if(!isset($_REQUEST['NAME']))
{
if(isset($_REQUEST['register'])){
  if(($_REQUEST['name']=="") || ($_REQUEST['email']=="") || ($_REQUEST['mobile']=="") || ($_REQUEST['pass']=="")|| ($_REQUEST['address']=="")){
    ?>
    <script type="text/javascript">
                alert("You didn't Fill all the field.");
                window.location = "user_reg.php";
                </script>
    <?php
  }
  else
  {
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $mobile = $_REQUEST["mobile"];
    $address = $_REQUEST["address"];
    $password = $_REQUEST["pass"];
    $password2 = $_REQUEST["pass2"];

    if($password!=$password2)
    {?>
      <script type="text/javascript">
                alert("Password Doesn't match.");
                window.location = "user_reg.php";
                </script>

                <?php
    }
    else
    {
      $sql2= "SELECT * FROM `marchant` WHERE name = '$name' ";
      $re = $conn->query($sql2);
      if($re)
      {
        if($re->num_rows > 0)
        {
          echo "<script >
          alert('Name already registered .')
          window.location = 'user_reg.php';
                </script>";
        }
        else
      {
         
    $sql = "INSERT INTO `marchant`(`name`, `email`, `mobile`, `pickup_add`, `pass`)  VALUES ('$name','$email','$mobile','$address',md5('$password'))";
       if($conn->query($sql)==TRUE){
          ?>
      <script type="text/javascript">
                alert("Registerd! Please Login using username and password .");
                window.location = "user_login.php";
                </script>

                <?php
    }
    
    else{
      echo "Unable to record data";
    }
      }
      }


     
    }
    
    
  }
}
}
else {
  echo "<script> location.href='all_parcel.php' </script>";
} //------------------------- Condition for users--------------------//



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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Tracking</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_login.php"><button type="button" class="btn btn-danger">Login</button></a>
      </li>
    </ul>
  </div>
</nav>



    <section id="banner"><div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">
          <div class="card">
  <h5 class="card-header text-center">Merchant Registration</h5>
  <div class="card-body">
    <h5 class="card-title text-center" style="color: grey">Register to access the dashboard</h5>
    <form method="POST" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input type="email" class="form-control" name="email" placeholder="Ex. abc@gmail.com">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile Number</label>
    <input type="text" class="form-control" name="mobile" placeholder="Ex.0167xxxxxxx">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="textarea" class="form-control" name="address" placeholder="Enter Address">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="pass" placeholder="******">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Re-Password</label>
    <input type="password" class="form-control" name="pass2" placeholder="******">
  </div>
  <button type="submit" class="btn btn-block btn-own text-light" name="register" style="margin-top: 15px">Register</button>
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
</html>