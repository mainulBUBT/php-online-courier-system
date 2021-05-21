
<?php 
include "connect.php";
include('admin_auth.php');
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
<?php $sql = "SELECT photo FROM admin_table WHERE aid = '$ids'";
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
  <a type="button" class="list-group-item list-group-item-action" href="dashboard.php">
    <b><i class="fas fa-tachometer-alt"></i> Dashboard</a></b>
  </a>
  <div class="dropdown dropright">
  <a class="list-group-item list-group-item-action dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-box"></i> Parcels</b>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="pending_parcel.php">Pending</a>
    <a class="dropdown-item" href="pickedup_parcel.php">Picked up</a>
    <a class="dropdown-item" href="done_parcel.php">Done delivery</a>
    <a class="dropdown-item" href="transit_parcel.php">In transit</a>
    <a class="dropdown-item" href="return_parcel.php">Return to Hub</a>
  </div>
</div>
<div class="dropdown dropright">
  <a class="list-group-item list-group-item-action dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-users"></i> Users</a></b>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="marchants.php">Marchant</a>
    <a class="dropdown-item" href="employee.php">Delivery Man</a>
  </div>
</div>
  <a type="button" class="list-group-item list-group-item-action" href="trparcel.php">
    <b><i class="fas fa-location-arrow"></i> Parcel Tracking</a></b>
  </a>
  <a type="button" class="list-group-item list-group-item-action" href="admin_payments.php">
    <b><i class="fas fa-money-check-alt"></i> Payments</a></b>
  </a>
  <div class="dropdown dropright">
  <a class="list-group-item list-group-item-action sidemenu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-table"></i> Reports</b>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="bdw_reports.php">Between Dates</a>
    <a class="dropdown-item" href="reqcounts_reports.php">Request Counts</a>
    <a class="dropdown-item" href="sales_reports.php">Demanding Charges</a>
  </div>
</div>
  <a type="button" class="list-group-item list-group-item-action" href="admin_settings.php">
    <b><i class="fas fa-user-cog"></i> Settings</a></b>
  </a>
</div></div>
<?php
}
?>
 <!-------------------------------- Sidebar col-4 END ---------------------------->

 <!-------------------------------- Sidebar col-8 Start ---------------------------->

<div class="col-sm-12 col-md-12 col-lg-8">

<div class="card"> 
  <div class="card-header">
    Search Data
  </div>
  <div class="card-body">
      <form action="" method="POST">
<div class="form-group">
    <input class="form-control" type="date" name="StartDate" />
    <input class="form-control" type="date" name="EndDate" />
  </div>
  <button type="submit" class="btn btn-own btn-block text-light" name="search">Search</button>
</form>
</div>
  </div>
  <br>  <!------------------------------ Data SearchBox End ---------------------------->


 <?php  
 //------------------------- Condition for Count Date Wise Data Search --------------------//

    if(isset($_POST['search']))
      {
        $StartDate=$_POST['StartDate'];
        $EndDate=$_POST['EndDate'];
 
          $sql = "SELECT DATE(stamp_created) as dates,
             count(*) AS total,
             sum(case when par_status = 'Not pickup yet' then 1 else 0 end) AS not_pick,
             sum(case when par_status = 'picked up' then 1 else 0 end) AS picked,
             sum(case when par_status = 'in transit' then 1 else 0 end) AS transit,
             sum(case when par_status = 'Delivered' then 1 else 0 end) AS delivered
             FROM parcel WHERE DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' 
             GROUP BY DATE(stamp_created)";
           $result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Data Shows Date Wise</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-light text-center">
  <thead class="bg-light">
    <tr>
      <th scope="col">Date</th>
       <th scope="col">Not Pickup Yet</th>
       <th scope="col">Picked Up</th>
       <th scope="col">In Transit</th>
       <th scope="col">Delivered</th>
       <th scope="col">Total Parcel</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["dates"]; ?></td>
      <td><?php echo $row["not_pick"]; ?></td>
      <td><?php echo $row["picked"]; ?></td>
      <td><?php echo $row["transit"]; ?></td>
      <td><?php echo $row["delivered"]; ?></td>
      <td><?php echo $row["total"]; ?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

<?php

}   //-------------------- Condition for Count Date Wise Data Search END --------------------//


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


</body>
</html>