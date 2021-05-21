<?php 
session_start();

include "connect.php";
$NAME= $_SESSION["NAME"];
$ids = $_SESSION["MEMBER_ID"];

include('header.php');

?>

<head>
	<link rel="stylesheet" type="text/css" href="css/progressbar.css">
	<link rel="stylesheet" type="text/css" href="font/all.css">

</head>

<!-- Sub menu slidebar -->

	<div class="container"><div class="row">

  <!-------------------------------- Sidebar col-4 Start ---------------------------->
<?php $sql = "SELECT photo FROM marchant WHERE m_id = '$ids'";
$result = $conn->query($sql);

    // output data of each row
    while($row = $result->fetch_assoc()) {
     // $profile = $row['photo'];
      ?>
        

  <div class="col-sm-12 col-md-12 col-lg-4"><div class="list-group">
  <div class="list-group-item list-group-item-action sidemenu">
  </div>
  <div class="list-group-item list-group-item-action ">
   <?php echo "<img src='images/".$row['photo']."' width='30%' height='30%' class='img-fluid img-thumbnail mx-auto d-block' alt=''>";?><h5 class="text-center"><?php echo $NAME; ?></h5>
  </div>
  <a type="button" class="list-group-item list-group-item-action" href="user_dashboard.php">
    <b><i class="fas fa-tachometer-alt"></i> Dashboard</a></b>
  <a type="button" class="list-group-item list-group-item-action" href="all_parcel.php">
    <b><i class="fas fa-clipboard-list"></i> All Parcel List</a></b>
  </a>
<a type="button" class="list-group-item list-group-item-action" href="add_parcel.php">
    <b><i class="fas fa-folder-plus"></i> Add Pickup Request</a></b>
  </a>
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="track_parcel.php">
    <b><i class="fas fa-location-arrow"></i> Parcel Tracking</a></b>
  </a>
  <a type="button" class="list-group-item list-group-item-action" href="user_payment.php">
    <b><i class="fas fa-money-check-alt"></i> Payments</a></b>
  </a>
  <a type="button" class="list-group-item list-group-item-action" href="user_settings.php">
    <b><i class="fas fa-user-cog"></i> Settings</a></b>
  </a>
</div></div>
<?php
}
?>
 <!-------------------------------- Sidebar col-4 END ---------------------------->
   
   <!-- Main contents Tracking Search body -->
  <div class="col-sm-12 col-md-12 col-lg-8">
    <div class="card mt-3">
  <div class="card-header">
    Track Parcel
  </div>
  <div class="card-body">
      <form action="" method="POST">
<div class="form-group">
    <input class="form-control" type="text" name="sub" placeholder="Input Tracking ID" placeholder="Input Tracking ID" />
  </div>
  <button type="submit" class="btn btn-own btn-block text-light" name="search">Search</button>
</form>
</div>
  </div>
<br>
   
   <!-- Main contents Tracking display body -->

  	
    	<?php
    	if(isset($_POST['search']))
    	{
    		$track_id=$_POST['sub'];
    		$sql = "SELECT `del_area`, `recv_name`, `recv_address`,`p_id`, `del_man`,`par_status`, `stamp_created`, `modified_at` FROM `delivery_info` natural Join `parcel` WHERE delivery_info.del_id = parcel.del_id and parcel.p_id='$track_id'";
  	$result = $conn->query($sql);
  	 while($row = $result->fetch_assoc())
  	 {
  	 	$sts = $row["par_status"];
  	 	$time = array();
  	 	$time2 = array();




  
  	 	?>

      
      <?php
      if(strcmp($sts,'Not pickup yet') == 0)
      {
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Tracking Details";
          echo"</div>";
             echo"<div class='card-body ml-md-5 ml-lg-7'>";
             echo"<div class='progressbar-wrapper'>";
                echo '<ul class="progressbar">';
                   echo'<li class="active">Request</li>';
                    echo"<li>Picked up</li>";
                     echo"<li>In transit</li>";
                     echo"<li>Delivered</li>";
                      echo"</ul>";
                     echo"</div>";
                      echo"</div>";
                      echo"</div>";

                      echo"<div class='card'>";
             echo"<div class='card-body'>";
                echo '<ul class="bar">';
                   echo'<li>'.$row["stamp_created"].' Your request for parcel pickup has been placed.</li>';
                     echo"<li><div class='spinner-border'style='width: .8rem; height: .8rem;' role='status'></div></li>";
                     echo"<li><div class='spinner-border'style='width: .8rem; height: .8rem;' role='status'></div></li>";
                     echo"<li><div class='spinner-border'style='width: .8rem; height: .8rem;' role='status'></div></li>";
                      echo"</ul>";
                      echo"</div>";
                      echo"</div>";

      }

      else if($sts=='picked up')
      {

      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Tracking Details";
          echo"</div>";
             echo"<div class='card-body ml-md-5 ml-lg-7'>";
             echo"<div class='progressbar-wrapper'>";
                echo '<ul class="progressbar">';
                   echo'<li class="active">Request</li>';
                    echo"<li class='active'>Picked up</li>";
                     echo"<li>In transit</li>";
                     echo"<li>Delivered</li>";
                      echo"</ul>";
                     echo"</div>";
                      echo"</div>";
                      echo"</div>";

      echo "<br>";


                      echo"<div class='card'>";
             echo"<div class='card-body'>";
                echo '<ul class="bar">';
                   echo'<li>'.$row["stamp_created"].' Your request for parcel pickup has been placed.</li>';
                   echo'<li>'.$row["modified_at"].' Your parcel picked up by '.$row["del_man"].'</li>';
                     echo"<li><div class='spinner-border'style='width: .8rem; height: .8rem;' role='status'></div></li>";
                     echo"<li><div class='spinner-border'style='width: .8rem; height: .8rem;' role='status'></div></li>";
                      echo"</ul>";
                      echo"</div>";
                      echo"</div>";

      }

      else if($sts=='in transit')
      {
      	
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Tracking Details";
          echo"</div>";
             echo"<div class='card-body ml-md-5 ml-lg-7'>";
             echo"<div class='progressbar-wrapper'>";
                echo '<ul class="progressbar">';
                   echo'<li class="active">Request</li>';
                    echo"<li class='active'>Picked up</li>";
                     echo"<li class='active'>In transit</li>";
                     echo"<li>Delivered</li>";
                      echo"</ul>";
                     echo"</div>";
                      echo"</div>";
                      echo"</div>";

      echo "<br>";

                      echo"<div class='card'>";
             echo"<div class='card-body'>";
                echo '<ul class="bar">';
                   echo'<li>'.$row["stamp_created"].' Your request for parcel pickup has been placed.</li>';
                   echo'<li> Your parcel picked up by '.$row["del_man"].'</li>';
                   echo'<li>'.$row["modified_at"].' Your parcel on the way with '.$row["del_man"].'</li>';
                    echo"<li><div class='spinner-border'style='width: .8rem; height: .8rem;' role='status'></div></li>";
                      echo"</ul>";
                      echo"</div>";
                      echo"</div>";

      }

      else
      {
      	$t3=$row["modified_at"];
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Tracking Details";
          echo"</div>";
             echo"<div class='card-body ml-md-5 ml-lg-7'>";
             echo"<div class='progressbar-wrapper'>";
                echo '<ul class="progressbar">';
                   echo'<li class="active">Request</li>';
                    echo"<li class='active'>Picked up</li>";
                     echo"<li class='active'>In transit</li>";
                     echo"<li class='active'>Delivered</li>";
                      echo"</ul>";
                     echo"</div>";
                      echo"</div>";
                      echo"</div>";

      echo "<br>";

                      echo"<div class='card'>";
             echo"<div class='card-body'>";
                echo '<ul class="bar">';
                   echo'<li>'.$row["stamp_created"].' Your request for parcel pickup has been placed.</li>';
                   echo'<li> Your parcel picked up by '.$row["del_man"].'</li>';
                   echo'<li> Your parcel on the way with '.$row["del_man"].'</li>';
                     echo'<li>'.$row["modified_at"].' Your parcel has been delivered.</li>';
                      echo"</ul>";
                      echo"</div>";
                      echo"</div>";

      }

      echo "<br>";

    echo'<div class="table-responsive-sm">';
      echo'<table class="table table-light mb-3">';
  echo'<thead class="thead-bom">';
  echo'<tr>';
      echo'<th scope="col">Track-ID</th>';
      echo'<th scope="col">Recipient Name</th>';
     echo'<th scope="col">Recipient Address</th>';
      echo'<th scope="col">Delivery Zone</th>';
      echo'<th scope="col">Delivery Man</th>';
      echo'<th scope="col">Parcel Status</th>';
    echo'</tr>';
    	

       echo'</thead>';
       echo'<tbody>';
 
       echo'<tr>';
      echo'<td>'.$row["p_id"].'</td>';
      echo'<td>'.$row["recv_name"].'</td>';
      echo'<td>'.$row["recv_address"].'</td>';
      echo'<td>'.$row["del_area"].'</td>';
      echo'<td>'.$row["del_man"].'</td>';
      echo'<td>'.$row["par_status"].'</td>';
      echo'</tr>';
      echo'</tbody>';
      echo'</table>';
      echo'</div>';



      
	    }
	
	?>

<?php
   


  } /*------if condition's last bracket*/
      ?>
<br>

</div>
</div>
</div></div>



 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>

</body>
</html>