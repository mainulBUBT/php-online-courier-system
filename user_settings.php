
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



 //------------------------- Update Employee Data value Modal SQL --------------------//

if(isset($_POST['update']))
{
  $ids = $_POST['m_id'];
  $name = $_POST['name'];
  $cpass = $_POST['old_pass'];
  $npass = $_POST['new_pass'];

  if($cpass=="" && $npass=="")
  {
    $sql = "UPDATE marchant SET name='$name' WHERE m_id='$ids'";

  if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
          echo 'alert("Record has been updated successfully!")';
          echo '</script>';
} else {
    echo "Error updating record: " . $conn->error;
}
  }
  else
  {
    
    $fire= "SELECT * FROM marchant WHERE m_id='$ids' and pass = md5('$cpass')";
    $re = $conn->query($fire);

    if($re->num_rows>0) {
      
      $sql = "UPDATE marchant SET pass=md5('$npass') WHERE m_id='$ids'";
      if ($conn->query($sql) === TRUE) {
      echo '<script language="javascript">';
          echo 'alert("Record has been updated successfully!")';
          echo '</script>';
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
  $sql = "UPDATE marchant SET photo = '$profileimage' WHERE m_id='$ids'";

 if ($conn->query($sql) === TRUE) 
 {
  echo '<script language="javascript">';
          echo 'alert("Image has been updated successfully!")';
          echo '</script>';
 }
 else
 {
 echo '<script language="javascript">';
          echo 'alert("Image Update Error!")';
          echo '</script>';
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
    <input class="form-control" type="text" id="m_id" name="m_id" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input class="form-control" type="text" id="name" name="name" readonly>
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
  <a type="button" class="list-group-item list-group-item-action" href="user_payment.php">
    <b><i class="fas fa-money-check-alt"></i> Payments</a></b>
  </a>
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="user_settings.php">
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



  $sql = "SELECT * FROM `marchant` where m_id='$ids'";
$result = $conn->query($sql);
?>

<div class='alert alert-warning mt-3' role='alert'>
    <h4 class='alert-heading'>Dear Marchant!</h4>
    <p>You cannot change BKash and Bank Information by yourself. If you want to change these information please come to our office or follow the below instruction. Thank you!</p>
    <hr>
    <p class='b-0'>If you have any problem or queries or complain, contact support team <b>09678-100800</b>.</p>
</div>

<div class="card mb-3 mt-2">
      <div class="card-header bg-head">
     <h4>Marchant Details</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-light text-center">
  <thead class="bg-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Pickup Address</th>
      <th scope="col">BKash Acc.</th>
      <th scope="col">Bank Acc.</th>  
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
      <td><?php echo $row["m_id"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["pickup_add"]; ?></td>
      <td><?php echo $row["bkash"]; ?></td>
      <td><?php echo $row["bank"]; ?></td>
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

      $('#m_id').val(data[0]);
      $('#name').val(data[1]);
    


    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->



</body>
</html>