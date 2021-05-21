
<?php 
session_start();
include "connect.php";

if(isset($_SESSION['SNAME']))
{
$SNAME= $_SESSION["SNAME"];
$ids = $_SESSION['SMEMBER_ID'];
}
else {
  echo "<script> location.href='staff_login.php' </script>";
}
include('header.php');



?>

<head>
  <style>
    .bg-head {
    color: #fff;
}
  </style>
</head>





   <!-------------------------------- Main Part ---------------------------->

    
  <div class="container"><div class="row">

 
 <!-------------------------------- Sidebar col-4 Start ---------------------------->

  <div class="col-sm-12 col-md-12 col-lg-4"><div class="list-group">
  <div class="list-group-item list-group-item-action sidemenu">
  </div>
  <div class="list-group-item list-group-item-action ">
    <img src="images/profile.png" width="35%" height="35%" class="img-fluid rounded-circle mx-auto d-block" alt=""><h5 class="text-center bold"><?php echo $SNAME; ?></h5>
  </div>
  <a type="button" class="list-group-item list-group-item-action" href="staff_space.php">
    <b><i class="fas fa-wallet"></i> Space Desk</a></b>
  <div class="list-group-item list-group-item-action sidemenu">
    <b><i class="fas fa-clipboard-list"></i> Work Management</div></b>
  <a type="button" class="list-group-item list-group-item-action" href="#">
    <b><i class="fas fa-user-cog"></i> Settings</a></b>
  </a>
</div></div>


<?php
$sql = "SELECT(SELECT COUNT(p_id) FROM parcel NATURAL JOIN employee WHERE employee.emp_name = parcel.del_man AND employee.id='$ids' AND parcel.par_status='Delivered') as delivered,(SELECT COUNT(p_id) FROM parcel NATURAL JOIN employee WHERE employee.emp_name = parcel.del_man AND employee.id='$ids' AND parcel.par_status='Not pickup yet') as waiting";
$result = $conn->query($sql);

?>

 <!-------------------------------- Sidebar col-4 END ---------------------------->

 <!-------------------------------- Sidebar col-8 Start ---------------------------->

<div class="col-sm-12 col-md-12 col-lg-8">
  <?php
  while($row = $result->fetch_assoc()) {

 echo "<div class='alert alert-success mt-3' role='alert'>
  <h4 class='alert-heading'>Well done!</h4>
  <p>Congratulations, you have successfully <b>Delivered ". $row["delivered"]." Parcel.</b> Now you have been <b> assigned for ". $row["waiting"]." Parcel.</b> Please pickup as soon as possible</p>
  <hr>
  <p class='b-0'>If you have any problem or queries or complain, contact support team <b>09678-100800</b>.</p>
</div>";

    }
    ?>
    <div class="alert alert-warning">
       <strong>Here you can see all parcels which are you successfully delivered to the customer!</strong> 
    </div>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }
      else
      {
        $page = 1;
      }
    $num_per_page= 04;
    $start_form = ($page-1)*04;
    
    $sql = "SELECT p_id , recv_name,recv_address,recv_number,col_amount,del_area,par_status FROM parcel NATURAL JOIN delivery_info WHERE parcel.del_id=delivery_info.del_id and parcel.par_status='Delivered' and parcel.del_man='$SNAME' ORDER BY p_id ASC limit $start_form, $num_per_page";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
   echo '<div class="table-responsive-sm text-center">';
    echo '<table class="table table-light">';
  echo '<thead class="thead-bom">';
    echo "<tr>";
    echo '<th scope="col">Track ID</th>';
      echo '<th scope="col">Recipient Name</th>';
      echo '<th scope="col">Recipient Number</th>';
      echo '<th scope="col">Recipient  Address</th>';
      echo '<th scope="col">Delivery Zone</th>';
      echo '<th scope="col">Collectable Amount</th>';
      echo '<th scope="col">Delivery Status</th>';
    echo "<tr>";
 echo "</thead>";
  echo "<tbody>";
  while($row = $result->fetch_assoc()){
        $pid = $row["p_id"]; //pid for getting the specific user id's invoice

    echo "<tr>";
     echo "<td>" . $row["p_id"] . "</td>";
      echo "<td>". $row["recv_name"] . "</td>";
      echo "<td>". $row["recv_number"] . "</td>";
      echo "<td>". $row["recv_address"] . "</td>";
      echo "<td>". $row["del_area"] ."</th>";
      echo "<td>" . $row["col_amount"] . "</td>";
      echo "<td>" . $row["par_status"] . "</td>";
    echo "</tr>";
      }
  echo "</tbody>";
echo "</table>";
echo "</div>";
} else{
echo "<div class='alert alert-warning' role='alert'>
Sorry, dear Delivery Man you're not assign any parcel for delivery. Wait for the assigning to deliver the parcel in your nearby area. When you have assigned any task, this message will no longer show in your space desk. GOOD DAY!
</div>";
}

      $sql = "SELECT p_id , recv_name,recv_address,recv_number,col_amount,del_area FROM parcel NATURAL JOIN delivery_info WHERE parcel.del_id=delivery_info.del_id and parcel.par_status='Not pickup yet' and parcel.del_man='$SNAME'";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='all_parcel.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px;'>$i</a>";
    }
?>

<!-----------------------------------Return Parcels-------------------------->
  <div class="alert alert-warning text-center mt-3">
       <strong>Here you can see all parcels which are you returns to Our HUB!</strong> 
    </div>
 <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }
      else
      {
        $page = 1;
      }
    $num_per_page= 04;
    $start_form = ($page-1)*04;
    
    $sql = "SELECT `retid`, `pid`, `del_area`, `recv_name`, `recv_address`, `del_man`, `par_status`, `return_coz` FROM `return_parcel` WHERE del_man = '$SNAME' ORDER BY pid ASC limit $start_form, $num_per_page";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
     
    echo '<div class="card mt-3">
    <div class="card-header bg-head">
    <h4>Return Parcels</h4>
      </div>';
   echo '<div class="table-responsive-sm text-center">';
    echo '<table class="table table-light">';
  echo '<thead class="bg-light">';
    echo "<tr>";
    echo '<th scope="col">Return ID</th>';
    echo '<th scope="col">Track ID</th>';
      echo '<th scope="col">Recipient Name</th>';
      echo '<th scope="col">Recipient  Address</th>';
      echo '<th scope="col">Delivery Zone</th>';
      echo '<th scope="col">Delivery Status</th>';
      echo '<th scope="col">Reasons Note</th>';
    echo "<tr>";
 echo "</thead>";
  echo "<tbody>";
  while($row = $result->fetch_assoc()){
        $pid = $row["pid"]; //pid for getting the specific user id's invoice

    echo "<tr>";
     echo "<td>" . $row["retid"] . "</td>";
     echo "<td>" . $row["pid"] . "</td>";
      echo "<td>". $row["recv_name"] . "</td>";
      echo "<td>". $row["recv_address"] . "</td>";
      echo "<td>". $row["del_area"] ."</th>";
      echo "<td>" . $row["par_status"] . "</td>";
       echo "<td>" . $row["return_coz"] . "</td>";

      // echo "<td>" . "<button type='button' class='btn btn-own retbtn'><i class='fas fa-edit'></i></button>" . "</td>";
    echo "</tr>";
      }
  echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";

 $sql = "SELECT `retid`, `pid`, `del_area`, `recv_name`, `recv_address`, `del_man`, `par_status`, `return_coz` FROM `return_parcel` ORDER BY pid";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='staff_work.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px;'>$i</a>";
    }
} else{
echo "<div class='alert alert-danger' role='alert'>No records for returning parcel
</div>";
}

     
?>
    
</div>




  
 <!-------------------------------- Sidebar col-4 END ---------------------------->

</div></div>
 <!-------------------------------- Main Part END ---------------------------->



 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>





<!-------------------------------JavaScript for Modal Access Start------------ ------------->

</body>
</html>