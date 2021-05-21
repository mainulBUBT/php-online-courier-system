<?php 
session_start();

include "connect.php";
if(isset($_SESSION['NAME']))
{
$NAME= $_SESSION["NAME"];
$ids = $_SESSION["MEMBER_ID"];
}
else {
  echo "<script> location.href='user_login.php' </script>";
}

include('header.php');

?>

<head>
	<link rel="stylesheet" type="text/css" href="css/progressbar.css">
</head>

<!-- Sub menu slidebar -->

	<div class="container"><div class="row">
  <div class="col-4"><div class="list-group">
  <div class="list-group-item list-group-item-action sidemenu">
  </div>
  <div class="list-group-item list-group-item-action">
  	<img src="images/profile.png" width="35%" height="35%" class="d-inline-block align-top rounded img-thumbnail" alt=""> <?php echo $NAME; ?>
  </div>
  <button type="button" class="list-group-item list-group-item-action">
    <a href="all_parcel.php" style="text-decoration:none;">All parcel lists</a>
    </button>
  <button type="button" class="list-group-item list-group-item-action">
  	<a href="add_parcel.php" style="text-decoration:none;">Add new parcel</a>
  </button>
  <button type="button" class="list-group-item list-group-item-action sidemenu">
  	<div class="text-light">Parcel Tracking</a>
  </button>
  <button type="button" class="list-group-item list-group-item-action">
    <a href="user_payment.php" style="text-decoration:none;">Payment information</a>
  </button>
  <button type="button" class="list-group-item list-group-item-action" disabled>
  	<a href="#" style="text-decoration:none;">Report a issue</a>
  	</button>
</div></div>
   
   <!-- Main contents Tracking Search body -->
  <div class="col-8">
    <div class="card">
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

  	<table class="table table-light">
  <thead class="thead-bom">
  <tr>
      <th scope="col">Track-ID</th>
      <th scope="col">Recipient Name</th>
      <th scope="col">Recipient Address</th>
      <th scope="col">Delivery Zone</th>
      <th scope="col">Delivery Man</th>
     <th scope="col">Parcel Status</th>
    <tr>
    	<?php
    	if(isset($_POST['search']))
    	{
    		$track_id=$_POST['sub'];
    		$sql = "SELECT `del_area`, `recv_name`, `recv_address`,`p_id`, `del_man`,`par_status` FROM `delivery_info` natural Join `parcel` WHERE delivery_info.del_id = parcel.del_id and parcel.p_id='$track_id'";
  	$result = $conn->query($sql);
  	 while($row = $result->fetch_assoc())
  	 {
  	 	$sts = $row["par_status"];
  	 	?>

       </thead>
       <tbody>
 
       <tr>
      <td><?php echo $row["p_id"]; ?></td>
      <td><?php echo $row["recv_name"]; ?></td>
      <td><?php echo $row["recv_address"]; ?></td>
      <td><?php echo $row["del_area"]; ?></td>
      <td><?php echo $row["del_man"]; ?></td>
      <td><?php echo $row["par_status"]; ?></td>
      </tr>
      <?php
      
	    }
	
	?>
      </tbody>
      </table>
<?php
   if(strcmp($sts,'Not pickup yet') == 0)
      {
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Track Parcel";
          echo"</div>";
             echo"<div class='card-body'>";
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

      }

      else if($sts=='picked up')
      {
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Track Parcel";
          echo"</div>";
             echo"<div class='card-body'>";
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

      }

      else if($sts=='in transit')
      {
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Track Parcel";
          echo"</div>";
             echo"<div class='card-body'>";
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

      }

      else
      {
      	echo"<div class='card'>";
         echo '<div class="card-header">';
           echo "Track Parcel";
          echo"</div>";
             echo"<div class='card-body'>";
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

      }


  } /*------if condition's last bracket*/
      ?>
<br>

</div>
</div>
</div></div>



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>