
<?php 
include "connect.php";
include('admin_auth.php');
include('header.php');


//------------------------- Update Data value Modal SQL --------------------//

if(isset($_POST['save']))
{
  $ids = $_POST['pid'];
  $resons = $_POST['return_coz'];

  $sql = "UPDATE return_parcel SET return_coz='$resons' WHERE pid='$ids'";
  
  if ($conn->query($sql) === TRUE) {
    ?>
    <script type="text/javascript">
                alert("Record has been upadated successfully .");
                window.location = "return_parcel.php?";
                </script>
                <?php
} else {
    echo "Error updating record: " . $conn->error;
}



}  //------------------------- Update Data value Modal SQL END--------------------//

//------------------------- Delete Data value Modal SQL --------------------//

if(isset($_POST['deletedata']))
{
  $ids = $_POST['retidz'];

  $sql = "DELETE FROM return_parcel WHERE retid='$ids'";
  
  if ($conn->query($sql) === TRUE) {
    ?>
    <script type="text/javascript">
                alert("Record has been upadated successfully .");
                window.location = "return_parcel.php?";
                </script>
                <?php
} else {
    echo "Error updating record: " . $conn->error;
}



}  //------------------------- Update Data value Modal SQL END--------------------//



?>

<head>
  <style>
    .bg-head {
    color: #fff;
}
  </style>
</head>


 <!-------------------------------- Data Update Modal Start ---------------------------->

<div class="modal" id="editmodalz" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Parcel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="">
    <div class="form-group">
      <label for="exampleInputEmail1">Return-ID</label>
      <input class="form-control" type="text" id="retid" name="retid" readonly>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Trcak-ID</label>
      <input class="form-control" type="text" id="pid" name="pid" readonly>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Write down reason</label>
      <input class="form-control" type="textarea" name="return_coz">
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-own btn-light" name="save">Save changes</button>
      </div>
      </form>
    </div>

  </div>
</div>
 <!-------------------------------- Data Update Modal END ---------------------------->

 <!-------------------------------- Data Update Modal Start ---------------------------->

<div class="modal" id="editmodalss" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Parcel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="">
      <div class="form-group">
      <label for="exampleInputEmail1">Return-ID</label>
      <input class="form-control" type="text" id="retidz" name="retidz" readonly>
    </div>
      <p>Solve Issue? If solved delete data from return desk and then update the parcel from Return Parcel Page</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name="deletedata">Delete</button>
      </div>
      </form>
    </div>

  </div>
</div>
 <!-------------------------------- Data Update Modal END ---------------------------->










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
  <a class="list-group-item list-group-item-action sidemenu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-box"></i> Parcels</b>
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

   <?php
   $fid=$_GET['ids'];


   $sql = "SELECT `retid`, `pid`, `del_area`, `recv_name`, `recv_address`, `del_man`, `par_status`, `return_coz` FROM `return_parcel` WHERE  pid='$fid'";

    $result = $conn->query($sql);
    ?>
  <div class="card">
      <div class="card-header bg-head">
     <h4>Return Parcel</h4>
      </div>
    <div class="table-responsive-sm table-sm">
  <table class="card-body table table-light text-center">
  <thead class="bg-light">
    <tr>
      <th scope="col">Return-ID</th>
      <th scope="col">Track-ID</th>
      <th scope="col">Delivery Zone</th>
      <th scope="col">Delivery Man</th>
     <th scope="col">Reasons</th>
     <th scope="col">Edit</th>
     <th scope="col">Delete</th>
    </tr>
  </thead>
  
       </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $pid = $row["pid"]; //pid for getting the specific user id's invoice
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["retid"]; ?></td>
      <td><?php echo $row["pid"]; ?></td>
      <td><?php echo $row["del_area"]; ?></td>
      <td><?php echo $row["del_man"]; ?></td>
      <td><?php echo $row["return_coz"]; ?></td>
      <td><?php echo "<button type='button' class='btn btn-own editreson'><i class='fas fa-edit'></i></button>"?></td>
      <td><?php echo "<button type='button' class='btn btn-danger deletedata'><i class='fas fa-trash'></i></button>"?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

    
</div>
</div>
  
 <!-------------------------------- Sidebar col-8 END ---------------------------->

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
    $('.editreson').on('click', function() {
      $('#editmodalz').modal('show');
      $tr = $(this).closest('tr');
      var data= $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#retid').val(data[0]);
      $('#pid').val(data[1]);



    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->
<script>
  $(document).ready(function(){
    $('.deletedata').on('click', function() {
      $('#editmodalss').modal('show');
      $tr = $(this).closest('tr');
      var data= $tr.children("td").map(function(){
        return $(this).text();
      }).get();

      console.log(data);

      $('#retidz').val(data[0]);



    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->

</body>
</html>