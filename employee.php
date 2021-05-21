
<?php 
include "connect.php";
include('header.php');
include('admin_auth.php');



 //------------------------- Update Employee Data value Modal SQL --------------------//

if(isset($_POST['update']))
{
  $ids = $_POST['id'];
  $name = $_POST['emp_name'];
  $email = $_POST['emp_email'];
  $mob = $_POST['emp_mob'];


  $sql = "UPDATE employee SET emp_name='$name',emp_email='$email', emp_mob='$mob' WHERE id='$ids'";
  
  if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
          echo 'alert("Record has been updated successfully!")';
          echo '</script>';
} else {
    echo "Error updating record: " . $conn->error;
}



}  //------------------------- Update Employee Data value Modal SQL END--------------------//


//------------------------- Insert Employee Data value Modal SQL --------------------//

if(isset($_POST['insert']))
{
  $name = $_POST['emp_name'];
  $email = $_POST['emp_email'];
  $mob = $_POST['emp_mob'];


  $sql = "INSERT INTO `employee`(`emp_name`, `emp_email`, `emp_mob`) VALUES ('$name', '$email', '$mob')";
  
  if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
          echo 'alert("Record has been updated successfully!")';
          echo '</script>';
} else {
    echo "Error updating record: " . $conn->error;
}



}  //------------------------- Insert Employee Data value Modal SQL END--------------------//



?>

<head>
  <style>
    .bg-head {
    color: #fff;
}
  </style>
</head>


 <!-------------------------------- Data Update Modal Start ---------------------------->

<div class="modal" id="editmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Employee Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="employee.php">
          <div class="form-group">
    <label for="exampleInputEmail1">Employee ID</label>
    <input class="form-control" type="text" id="id" name="id" readonly>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input class="form-control" type="text" id="emp_name" name="emp_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile Number</label>
    <input class="form-control" type="text" id="emp_mob" name="emp_mob">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input class="form-control" type="text" id="emp_email" name="emp_email">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Active Date</label>
    <input class="form-control" type="text" id="reg" name="reg" readonly>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-own btn-light" name="update">Save changes</button>
      </div>
      </form>
    </div>

  </div>
</div>
 <!-------------------------------- Data Update Modal END ---------------------------->

 <!-------------------------------- Data Insert Modal Start ---------------------------->

<div class="modal" id="emp_add" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Employee Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="employee.php">
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input class="form-control" type="text" id="emp_name" name="emp_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile Number</label>
    <input class="form-control" type="text" id="emp_mob" name="emp_mob">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input class="form-control" type="text" id="emp_email" name="emp_email">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-own btn-light" name="insert">Save changes</button>
      </div>
      </form>
    </div>

  </div>
</div>
 <!-------------------------------- Data Insert Modal END ---------------------------->





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
  <a class="list-group-item list-group-item-action sidemenu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-users"></i> Users</a></b>
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
  <a class="list-group-item list-group-item-action dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-table"></i> Reports</b>
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
    <input class="form-control" type="text" name="sub" placeholder="Input Name" />
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
        $name=$_POST['sub'];

  $sql = "SELECT id, emp_name ,emp_email, emp_mob, Date(reg_date) as reg FROM `employee` where emp_name LIKE '%$name%'";
$result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Marchant Details</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col">Active Date</th>
     <th scope="col">Action</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $mid = $row["id"]; //mid for getting the specific user id further update
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["id"]; ?></td>
      <td><?php echo $row["emp_name"]; ?></td>
      <td><?php echo $row["emp_email"]; ?></td>
      <td><?php echo $row["emp_mob"]; ?></td>
      <td><?php echo $row["reg"]; ?></td>
      <td><?php echo "<button type='button' class='btn btn-own editbtn'><i class='fas fa-edit'></i></button>"?></td>
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

  $sql = "SELECT id, emp_name ,emp_email, emp_mob, Date(reg_date) as reg FROM `employee`ORDER BY id ASC limit $start_form, $num_per_page";

    $result = $conn->query($sql);
    ?>
  <div class="card">
      <div class="card-header bg-head">
     <h4>All Employee Details <button type='button' class='btn btn-warning float-right' data-toggle='modal' data-target='#emp_add'><i class='fas fa-user-plus'></i></button></h4>
      </div>
    <div class="table-responsive-sm">
  <table class="card-body table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col">Active Date</th>
     <th scope="col" colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  
       </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $mid = $row["id"]; //mid for getting the specific user id further update
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["id"]; ?></td>
      <td><?php echo $row["emp_name"]; ?></td>
      <td><?php echo $row["emp_email"]; ?></td>
      <td><?php echo $row["emp_mob"]; ?></td>
      <td><?php echo $row["reg"]; ?></td>
      <td><?php echo "<button type='button' class='btn btn-own editbtn'><i class='fas fa-edit'></i></button>"?></td>
      <td><?php echo "<button type='button' class='btn btn-danger editbtn'><i class='fas fa-user-minus'></i></button>"?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

<?php 
      $sql = "SELECT id, emp_name ,emp_email, emp_mob, Date(reg_date) as reg FROM `employee`";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='employee.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px; margin-top: 10px'>$i</a>";
    }
  }    //------------------------- Condition for else data END --------------------//

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



 <!-------------JavaScript for Modal Access Start ------------->
<script>
  $(document).ready(function(){
    $('.editbtn').on('click', function() {
      $('#editmodal').modal('show');
      $tr = $(this).closest('tr');
      var data= $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#id').val(data[0]);
      $('#emp_name').val(data[1]);
      $('#emp_email').val(data[2]);
      $('#emp_mob').val(data[3]);
      $('#reg').val(data[4]);




    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->



</body>
</html>