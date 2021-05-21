<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/progressbar.css">






	<title></title>
</head>
<div class="progressbar-wrapper">
      <ul class="progressbar">
          <li class="active">Step 1</li>
          <li>Step 2</li>
          <li>Step 3</li>
          <li>Step 4</li>
      </ul>
</div>






<?php 
       $sts = $result["par_status"];
       echo '$result["par_status"]';
      if($sts=='Not pickup yet')
      {
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Track Parcel";
          echo"</div>";
             echo"<div class='card-body'>";
             echo"<div class='progressbar-wrapper'>";
                echo '<ul class="progressbar">';
                   echo'<li class="active">Step 1</li>';
                    echo"<li>Step 2</li>";
                     echo"<li>Step 3</li>";
                     echo"<li>Step 4</li>";
                      echo"</ul>";
                     echo"</div>";
                      echo"</div>";
                      echo"</div>";

      }
      ?>
      use for fontawesome
     
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>

      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>
</body>
</html>