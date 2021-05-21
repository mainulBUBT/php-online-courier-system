
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
  <a type="button" class="list-group-item list-group-item-action" href="track_parcel.php">
    <b><i class="fas fa-location-arrow"></i> Parcel Tracking</a></b>
  </a>
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="user_payment.php">
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
   
   <!-- Main contents -->
<!-------------------------------- Sidebar col-8 Start ---------------------------->

<div class="col-sm-12 col-md-12 col-lg-8">

<div class="card mt-3"> 
  <div class="card-header">
    Search Data
  </div>
  <div class="card-body">
      <form action="" method="POST">
<div class="form-group">
    <input class="form-control" type="text" name="sub" placeholder="Input Tracking ID" />
  </div>
  <button type="submit" class="btn btn-own btn-block text-light" name="search">Search</button>
</form>
</div>
  </div>
  <br>  <!------------------------------ Data SearchBox End ---------------------------->


 <?php  
 //------------------------- Condition for Single Value Search --------------------//

    if(isset($_POST['search']))
      {
        $track_id=$_POST['sub'];

  $sql = "SELECT p_id , due_chrg as charge,user_bal,par_status, (CASE WHEN pay_method = 1 THEN 'BKash'
       WHEN pay_method = 0 THEN 'Bank' end) as pay_method,(CASE WHEN payment = 1 THEN 'Done' WHEN payment = 0 THEN 'Pending' end) as payment FROM parcel AS c WHERE c.m_id = '$ids' and p_id LIKE '%$track_id%'";
$result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Delivered Parcel list</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">Track-ID</th>
      <th scope="col">Charge Due</th>
      <th scope="col">Your Balance</th>
      <th scope="col">Parcel Status</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Received By</th>
     <th scope="col">Invoice PDF</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $pid = $row["p_id"]; //pid for getting the specific user id's invoice
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["p_id"]; ?></td>
      <td><?php echo $row["charge"]; ?></td>
      <td><?php echo $row["user_bal"]; ?></td>
      <td><?php echo $row["par_status"]; ?></td>
      <td><?php echo $row["payment"]; ?></td>
      <td><?php echo $row["pay_method"]; ?></td>
      <td><?php echo "<form method ='get' action='invoice.php'><button type='submit' class='btn btn-danger' name='invoice' value='{$pid}'><i class='far fa-file-pdf'></i></button></form>"?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>




<?php

}  //------------------------- Condition for Single Value Search END --------------------//


else
{
   //------------------------- Condition for else data Start --------------------//

  if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }
      else
      {
        $page = 1;
      }
    $num_per_page= 04;
    $start_form = ($page-1)*04;

  $sql = "SELECT p_id , due_chrg as charge,user_bal,par_status, (CASE WHEN pay_method = 1 THEN 'BKash'
       WHEN pay_method = 0 THEN 'Bank' end) as pay_method, (CASE WHEN payment = 1 THEN 'Done' WHEN payment = 0 THEN 'Pending' end) as payment FROM parcel AS c WHERE c.m_id = '$ids' ORDER BY p_id DESC limit $start_form, $num_per_page";

    $result = $conn->query($sql);
    ?>
  <div class="card">
      <div class="card-header bg-head">
     <h4>Delivered Parcel list</h4>
      </div>
    <div class="table-responsive-sm">
  <table class="card-body table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">Track-ID</th>
      <th scope="col">Charge Due</th>
      <th scope="col">Your Balance</th>
      <th scope="col">Parcel Status</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Received By</th>
     <th scope="col">Invoice PDF</th>
    </tr>
  </thead>
  
       </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $pid = $row["p_id"]; //pid for getting the specific user id's invoice
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["p_id"]; ?></td>
      <td><?php echo $row["charge"]; ?></td>
      <td><?php echo $row["user_bal"]; ?></td>
      <td><?php echo $row["par_status"]; ?></td>
      <td><?php echo $row["payment"]; ?></td>
      <td><?php echo $row["pay_method"]; ?></td>
      <td><?php echo "<form method ='get' action='invoice.php'><button type='submit' class='btn btn-danger' name='invoice' value='{$pid}'><i class='far fa-file-pdf'></i></button></form>"?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

<?php 
      $sql = "SELECT p_id , due_chrg as charge,user_bal,par_status,
(CASE WHEN payment = 1 THEN 'Done' WHEN payment = 0 THEN 'Pending' end) as payment FROM parcel AS c WHERE c.m_id = '$ids'";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='user_payment.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px; margin-top: 10px'>$i</a>";
    }
  }    //------------------------- Condition for else data END --------------------//

   ?>


    
</div>
  
 <!-------------------------------- Sidebar col-8 END ---------------------------->

</div></div>


 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>




</body>
</html>