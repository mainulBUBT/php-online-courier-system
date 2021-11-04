
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

<div class="col-sm-12 col-md-12 col-lg-8 mt-sm-3">

<div class="card"> 
  <div class="card-header">
    Search Data
  </div>
  <div class="card-body">
      <form action="" method="POST">
<div class="form-group">
    <input class="form-control" type="date" name="StartDate" />
    <input class="form-control" type="date" name="EndDate" />
    <input type="radio" name="search" value="day">Daily
    <input type="radio" name="search" value="month">Monthly
  </div>
  <button type="submit" class="btn btn-own btn-block text-light">Search</button>
</form>
</div>
  </div>
  <br>  <!------------------------------ Data SearchBox End ---------------------------->


 <?php  
 //------------------------- Condition for Date Wise Data Search --------------------//

    if(isset($_POST['search']))
      {
        $StartDate=$_POST['StartDate'];
        $EndDate=$_POST['EndDate'];
        $search =$_POST['search'];
 //------------------------- SQL+ Condition for Daily Basis SUM Data --------------------//

        if($search=='day')
        {
          // Here payment='1' means , 1= payment done, 0=pending payment

          $sql = "SELECT Date(stamp_created) as dates, SUM(chrg) as sum FROM parcel WHERE DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' AND payment='1' GROUP BY DATE(stamp_created)";
           $result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Data Shows Date Wise</h4>
      </div>
<div class="table-responsive-sm text-center">
<table class="table table-light">
  <thead class="bg-light">
    <tr>
       <th scope="col">Date</th>
      <th scope="col">Charges Amount</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["dates"]; ?></td>
      <td><?php echo $row["sum"]; ?> ৳</td>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

<?php
      } //---------------------- SQL+ Condition for Daily Basis SUM Data END ----------------//


//------------------------- SQL + Condition for Monthly Basis SUM Data --------------------//

      else if($search=='month')
        {
          // Here payment='1' means , 1= payment done, 0=pending payment
          $StartDate=$_POST['StartDate'];
          $EndDate=$_POST['EndDate'];
          $search =$_POST['search'];

          //------------------------- SQL+ Condition for Monthly Basis SUM Data --------------------//

          $sql = "SELECT MONTHNAME(stamp_created) as month, YEAR(stamp_created) as year, SUM(chrg) as sum FROM parcel WHERE DATE(stamp_created) BETWEEN '$StartDate' AND '$EndDate' AND payment='1' GROUP BY MONTH(stamp_created)";
           $result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Data Shows Month Wise</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-light text-center">
  <thead class="bg-light">
    <tr>
       <th scope="col">Month</th>
      <th scope="col">Year</th>
      <th scope="col">Charges Amount</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["month"]; ?></td>
      <td><?php echo $row["year"]; ?></td>
      <td><?php echo $row["sum"]; ?> ৳</td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

<?php
      }

}  //------------------------- SQL + Condition for Monthly Basis SUM Data --------------------//

?>

    
</div>
  
 <!-------------------------------- Sidebar col-4 END ---------------------------->

</div></div>
 <!-------------------------------- Main Part END ---------------------------->



<?php

// FOOTER PART CALL
include '../include/footer.php';
?>

</body>
</html>