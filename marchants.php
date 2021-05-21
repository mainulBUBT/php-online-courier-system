
<?php 
include "connect.php";
include('admin_auth.php');
include('header.php');

//------------------------- Update User Balance SQL --------------------//
//here update, user balance that he/she given by courier and update marchant delivery charge when click update button//

if(isset($_POST['up'])&& intval($_POST['up']))
{
  $user_id = (int) $_POST['up'];

//------------------------- Check User id and put them into SQL[1] --------------------//

  $sql2 = "UPDATE marchant SET balance=(SELECT SUM(user_bal) FROM parcel WHERE parcel.m_id='$user_id' AND payment='0') WHERE m_id='$user_id'";
  
  if ($conn->query($sql2) === TRUE) {

    //------------------------- SQL for user due delivery charge --------------------//

    $sql3 = "UPDATE marchant SET due_balance=(SELECT SUM(due_chrg) FROM parcel WHERE parcel.m_id='$user_id' AND payment='0') WHERE m_id='$user_id'";

    if ($conn->query($sql3) === TRUE) {

      echo '<script language="javascript">';
          echo 'alert("Hey Record has been updated successfully!")';
          echo '</script>';
        }
        else {
    echo "Error updating record: " . $conn->error;
             }

} //------------------------- END SQL if condition ------------------------------------//

else {
    echo "Error updating record: " . $conn->error;
}

} //--------------------------- Update User Balance SQL END -----------------------------//



 //------------------------- Update Marchant Data value Modal SQL --------------------//

if(isset($_POST['update']))
{
  $ids = $_POST['m_id'];
  $email = $_POST['email'];
  $mob = $_POST['mobile'];
  $address = $_POST['pickup_add'];
  $bkash = $_POST['bkash'];
  $bank = $_POST['bank'];


  $sql = "UPDATE marchant SET email='$email', mobile='$mob', pickup_add ='$address',bkash='$bkash',bank='$bank' WHERE m_id='$ids'";
  
  if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
          echo 'alert("Record has been updated successfully!")';
          echo '</script>';
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

<div class="modal" id="editmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Marchant Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="marchants.php">
          <div class="form-group">
    <label for="exampleInputEmail1">Marchant ID</label>
    <input class="form-control" type="text" id="m_id" name="m_id" readonly>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input class="form-control" type="text" id="name" name="name" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile Number</label>
    <input class="form-control" type="text" id="mobile" name="mobile">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input class="form-control" type="text" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Pickup Address</label>
    <input class="form-control" type="text" id="pickup_add" name="pickup_add">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">BKash Account</label>
    <input class="form-control" type="text" id="bkash" name="bkash">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Bank Account</label>
    <input class="form-control" type="text" id="bank" name="bank">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Balance Total</label>
    <input class="form-control" type="text" id="balance" name="balance" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Due Delivery Charge</label>
    <input class="form-control" type="text" id="due_balance" name="due_balance" readonly>
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

  $sql = "SELECT m_id, name ,email, mobile, balance,pickup_add,bkash,bank, due_balance,(SELECT SUM(chrg+due_chrg) FROM `parcel` WHERE parcel.m_id=marchant.m_id AND payment='1' AND `par_status`='Delivered') as earn FROM `marchant` where name LIKE '%$name%'";
$result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Marchant Details</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-sm table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col">Balance</th>
      <th scope="col">Due Charge</th>
      <th scope="col">Earn From</th>
      <th style="display:none;">Pickup Addrs</th>
      <th style="display:none;">BKash</th>
      <th style="display:none;">Bank</th>
     <th scope="col">Update</th>
     <th scope="col">Action</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $mid = $row["m_id"]; //mid for getting the specific user id further update
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["m_id"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
      <td><?php echo $row["mobile"]; ?></td>
      <td><?php echo $row["balance"]; ?></td>
      <td><?php echo $row["due_balance"]; ?></td>
      <td><?php echo $row["earn"]; ?></td>
      <td style="display:none;"><?php echo $row["pickup_add"]; ?></td>
      <td style="display:none;"><?php echo $row["bkash"]; ?></td>
      <td style="display:none;"><?php echo $row["bank"]; ?></td>
      <td><?php echo "<form method ='post'><button type='submit' class='btn btn-warning' name='up' value='{$mid}'><i class='fas fa-sync-alt'></i>'</button></form>"?></td>
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

  $sql = "SELECT m_id, name ,email, mobile, balance,pickup_add,bkash,bank, due_balance,(SELECT SUM(chrg+due_chrg) FROM `parcel` WHERE parcel.m_id=marchant.m_id AND payment='1' AND `par_status`='Delivered') as earn FROM `marchant`ORDER BY m_id ASC limit $start_form, $num_per_page";

    $result = $conn->query($sql);
    ?>
  <div class="card">
      <div class="card-header bg-head">
     <h4>All Marchants Details</h4>
      </div>
  <div class="table-responsive-sm table-responsive-md">
  <table class="card-body table table-sm table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col">Balance</th>
      <th scope="col">Due Charge</th>
      <th scope="col">Earn From</th>
      <th style="display:none;">Pickup Addrs</th>
      <th style="display:none;">BKash</th>
      <th style="display:none;">Bank</th>
     <th scope="col">Update</th>
     <th scope="col">Action</th>
    </tr>
  </thead>
  
       </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $mid = $row["m_id"]; //mid for getting the specific user id further update
      
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["m_id"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
      <td><?php echo $row["mobile"]; ?></td>
      <td><?php echo $row["balance"]; ?></td>
      <td><?php echo $row["due_balance"]; ?></td>
       <td><?php echo $row["earn"]; ?></td>
       <td style="display:none;"><?php echo $row["pickup_add"]; ?></td>
      <td style="display:none;"><?php echo $row["bkash"]; ?></td>
      <td style="display:none;"><?php echo $row["bank"]; ?></td>
      <td><?php echo "<form method ='post'><button type='submit' class='btn btn-warning' name='up' value='{$mid}'><i class='fas fa-sync-alt'></i>'</button></form>"?></td>
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
      $sql = "SELECT m_id, name ,email, mobile, balance, due_balance FROM `marchant`";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='marchants.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px; margin-top: 10px'>$i</a>";
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

      $('#m_id').val(data[0]);
      $('#name').val(data[1]);
      $('#email').val(data[2]);
      $('#mobile').val(data[3]);
      $('#balance').val(data[4]);
      $('#due_balance').val(data[5]);
      $('#pickup_add').val(data[7]);
      $('#bkash').val(data[8]);
      $('#bank').val(data[9]);



    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->

</body>
</html>