
<?php 
include "connect.php";
include('header.php');
include('admin_auth.php');



 //------------------------- Update Employee Data value Modal SQL --------------------//

if(isset($_POST['update']))
{
  $ids = $_POST['aid'];
  $name = $_POST['admin_name'];
  $dhakaz = $_POST['dhaka'];
  $out_dhakaz = $_POST['out_dhaka'];
  $cpass = $_POST['old_pass'];
  $npass = $_POST['new_pass'];

  if($cpass=="" && $npass=="")
  {
    $sql = "UPDATE admin_table SET admin_name='$name',dhk_charge_up_2kg='$dhakaz',out_dhk_charge='$out_dhakaz' WHERE aid='$ids'";

  if ($conn->query($sql) === TRUE) {
    ?>
               <script type="text/javascript">
                alert("Record has been upadated successfully .");
                window.location = "admin_settings.php";
                </script>
          <?php
} else {
    echo "Error updating record: " . $conn->error;
}
  }
  else
  {
    
    $fire= "SELECT * FROM admin_table WHERE aid='$ids' and admin_pass = md5('$cpass')";
    $re = $conn->query($fire);

    if($re->num_rows>0) {
      
      $sql = "UPDATE admin_table SET admin_name='$name', admin_pass=md5('$npass') WHERE aid='$ids'";
      if ($conn->query($sql) === TRUE) {
        ?>
                <script type="text/javascript">
                alert("Record has been upadated successfully .");
                window.location = "admin_settings.php";
                </script>

                <?php
} else {
    echo "Error updating record: " . $conn->error;
}
      }
    }



}  //------------------------- Update Employee Data value Modal SQL END--------------------//

 //------------------------- Update Image Data value Modal SQL --------------------//

if(isset($_POST['upload']))
{
   // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    // Get image name
    $profileimage = $_FILES['profileimage']['name'];
    // Get text
    //$image_text = $conn -> real_escape_string($_POST['image_text']);

    // image file directory
    $target = "images/".basename($profileimage);


    // execute query
   if(move_uploaded_file($_FILES['profileimage']['tmp_name'], $target))
{
  $sql = "UPDATE admin_table SET photo = '$profileimage' WHERE aid='$ids'";

 if ($conn->query($sql) === TRUE) 
 {?>
                <script type="text/javascript">
                alert("Image has been upadated successfully .");
                window.location = "admin_settings.php";
                </script>
                <?php
 }
 else
 {
  ?>
<script type="text/javascript">
                alert("Image update error.");
                window.location = "admin_payments.php";
                </script>
                <?php
 }



}
}


}  //------------------------- Update Employee Data value Modal SQL END--------------------//




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
        <h5 class="modal-title">Update Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="">
    <div class="form-group">
    <label for="exampleInputEmail1">ID</label>
    <input class="form-control" type="text" id="aid" name="aid" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input class="form-control" type="text" id="admin_name" name="admin_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Inside Dhaka Charge</label>
    <input class="form-control" type="text" id="dhaka" name="dhaka">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Outside Dhaka Charge</label>
    <input class="form-control" type="text" id="out_dhaka" name="out_dhaka">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Current Password</label>
    <input class="form-control" type="text" id="old_pass" name="old_pass">
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">New Password</label>
    <input class="form-control" type="text" id="new_pass" name="new_pass">
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

 <!-------------------------------- Image Update Modal Start ---------------------------->

<div class="modal" id="pic" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="" enctype="multipart/form-data">
    <div class="custom-file">
    <input type="file" name="profileimage">    
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-own btn-light" name="upload">Save changes</button>
      </div>
      </form>
    </div>

  </div>
</div>
 <!-------------------------------- Image Update Modal END ---------------------------->





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
  <a class="list-group-item list-group-item-action dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><b><i class="fas fa-table"></i> Reports</b>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="bdw_reports.php">Between Dates</a>
    <a class="dropdown-item" href="reqcounts_reports.php">Request Counts</a>
    <a class="dropdown-item" href="sales_reports.php">Demanding Charges</a>
  </div>
</div>
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="admin_settings.php">
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
 //------------------------- Condition for Single Value Search --------------------//



  $sql = "SELECT * FROM `admin_table` where aid='$ids'";
$result = $conn->query($sql);
?>

<div class="card" style="margin-top: 100px;">
      <div class="card-header bg-head">
     <h4>Admin Details</h4>
      </div>
<div class="table-responsive-sm text-center">
<table class="table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th> 
      <th scope="col">Dhaka Charge</th>
      <th scope="col">Out Charge</th>  
      <th scope="col">Upload Image</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["aid"]; ?></td>
      <td><?php echo $row["admin_name"]; ?></td>
      <td><?php echo $row["dhk_charge_up_2kg"]; ?> ৳</td>
      <td><?php echo $row["out_dhk_charge"]; ?> ৳</td>
      <td><?php echo "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#pic'><i class='fa fa-camera'></i></button>"?></td>
      <td><?php echo "<button type='button' class='btn btn-own editbtn'><i class='fas fa-edit'></i></button>"?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

    
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

      $('#aid').val(data[0]);
      $('#admin_name').val(data[1]);
      $('#dhaka').val(data[2]);
      $('#out_dhaka').val(data[3]);
    


    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->



</body>
</html>