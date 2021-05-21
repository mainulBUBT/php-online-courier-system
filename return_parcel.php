
<?php 
include "connect.php";
include('admin_auth.php');
include('header.php');


 //------------------------- Update Data value Modal SQL --------------------//

if(isset($_POST['update']))
{
  $ids = $_POST['p_id'];
  $man = $_POST['del_man'];
  $status = $_POST['par_status'];

  $sql = "UPDATE parcel SET del_man='$man', par_status='$status' WHERE p_id='$ids'";
  
  if ($conn->query($sql) === TRUE) {
    ?>
    <script type="text/javascript">
                alert("Record has been upadated successfully .");
                window.location = "return_parcel.php";
                </script>
                <?php
} else {
    echo "Error updating record: " . $conn->error;
}



}  //------------------------- Update Data value Modal SQL END--------------------//



if(isset($_POST['save_details']))
{
    $delman = $_POST['delman'];

  $sqlz = "INSERT INTO return_parcel(`pid`,`del_area`,`recv_name`,`recv_address`,`del_man`,`par_status`)
          SELECT p.p_id,a.del_area,a.recv_name,a.recv_address,p.del_man,p.par_status
          FROM parcel as p
          INNER JOIN delivery_info as a ON a.del_id=p.del_id
          WHERE par_status='Return to Hub' AND del_man='$delman'";
  
  if ($conn->query($sqlz) === TRUE) {
    ?>
    <script type="text/javascript">
                alert("Record has been upadated successfully .");
                window.location = "return_parcel.php";
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

<div class="modal" id="editmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Parcel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="return_parcel.php">
    <div class="form-group">
    <label for="exampleInputEmail1">Track-ID</label>
    <input class="form-control" type="text" id="p_id" name="p_id" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Recipient Name</label>
    <input class="form-control" type="text" id="recv_name" name="recv_name" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Recipient Address</label>
    <input class="form-control" type="text" id="recv_address" name="recv_address" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Delivery Zone</label>
    <input class="form-control" type="text" id="del_area" name="del_area" readonly>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Dellivery Man</label>
    <input class="form-control" type="text" id="del_man" name="del_man">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Zone</label>
    <select class="form-control" id="par_status" name="par_status">
      <option value="Not pickup yet">Not pickup yet</option>
      <option value="picked up">picked up</option>
      <option value="in transit">in transit</option>
      <option value="Delivered">Delivered</option>
      <option value="Return to Hub">Return to Hub</option>
    </select>
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

 <!-------------------------------- Data Update Modal Start ---------------------------->

<div class="modal" id="insertReturn" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Return Parcel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="return_parcel.php">
         <div class="form-group">
    <label for="exampleFormControlSelect1">Delivery Man Name (Must Spell Correct)</label>
   <input class="form-control" type="textarea" name="delman">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-own btn-light" name="save_details">Save changes</button>
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

<div class="card"> 
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

  $sql = "SELECT `del_area`, `recv_name`, `recv_address`,`del_man`,`par_status`,`p_id` FROM delivery_info NATURAL JOIN parcel where parcel.par_status='Return to Hub' and p_id LIKE '%$track_id%'";
$result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Return Parcel list</h4>
      </div>
<div class="table-responsive-sm">
<table class="table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">Track-ID</th>
      <th scope="col">Recipient Name</th>
      <th scope="col">Recipient Address</th>
      <th scope="col">Delivery Zone</th>
      <th scope="col">Delivery Man</th>
     <th scope="col">Parcel Status</th>
     <th scope="col">Take Action</th>
     <th scope="col">Report Submit</th>
     <th scope="col">Reasons</th>
    </tr>
  </thead>
       <?php
  while($row = $result->fetch_assoc())
     {
      $pid = $row["p_id"]; //mid for getting the specific user id further updat
      ?>

       <tbody>
 
       <tr>
      <td><?php echo $row["p_id"]; ?></td>
      <td><?php echo $row["recv_name"]; ?></td>
      <td><?php echo $row["recv_address"]; ?></td>
      <td><?php echo $row["del_area"]; ?></td>
      <td><?php echo $row["del_man"]; ?></td>
      <td><?php echo $row["par_status"]; ?></td>
      <td><?php echo "<button type='button' class='btn btn-own editbtn'><i class='fas fa-edit'></i></button>"?></td>
      <td><?php echo "<button type='button' class='btn btn-own editbtn'><i class='fas fa-people-arrows'></i></button>"?></td>
      <td><?php echo "<form method ='get' action='return_view.php'><button type='submit' class='btn btn-danger' name='ids' value='{$pid}'><i class='far fa-eye'></i></button></form>"?></td>
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

  $sql = "SELECT `del_area`, `recv_name`, `recv_address`,`del_man`,`par_status`,`p_id` FROM delivery_info NATURAL JOIN parcel where parcel.par_status='Return to Hub' ORDER BY p_id ASC limit $start_form, $num_per_page";

    $result = $conn->query($sql);
    ?>
  <div class="card">
      <div class="card-header bg-head">
     <h4>Return Parcel list</h4>
      </div>
    <div class="table-responsive-sm table-sm">
  <table class="card-body table table-light">
  <thead class="bg-light">
    <tr>
      <th scope="col">Track-ID</th>
      <th scope="col">Recipient Name</th>
      <th scope="col">Recipient Address</th>
      <th scope="col">Delivery Zone</th>
      <th scope="col">Delivery Man</th>
     <th scope="col">Parcel Status</th>
     <th scope="col">Take Action</th>
     <th scope="col">Report Submit</th>
     <th scope="col">Reasons</th>
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
      <td><?php echo $row["recv_name"]; ?></td>
      <td><?php echo $row["recv_address"]; ?></td>
      <td><?php echo $row["del_area"]; ?></td>
      <td><?php echo $row["del_man"]; ?></td>
      <td><?php echo $row["par_status"]; ?></td>
      <td><?php echo "<button type='button' class='btn btn-own editbtn'><i class='fas fa-edit'></i></button>"?></td>
      <td><?php echo "<button type='button' class='btn btn-own' data-toggle='modal' data-target='#insertReturn'><i class='fas fa-people-arrows'></i></button>"?></td>
      <td><?php echo "<form method ='get' action='return_view.php'><button type='submit' class='btn btn-danger' name='ids' value='{$pid}'><i class='far fa-eye'></i></button></form>"?></td>
      </tr>
  </tbody>
  <?php
}
?>
</table>
</div>
</div>

<?php 
      $sql = "SELECT `del_area`, `recv_name`, `recv_address`,`del_man`,`par_status`,`p_id` FROM delivery_info NATURAL JOIN parcel where parcel.par_status='Return to Hub'";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='return_parcel.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px; margin-top: 10px'>$i</a>";
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

      $('#p_id').val(data[0]);
      $('#recv_name').val(data[1]);
      $('#recv_address').val(data[2]);
      $('#del_area').val(data[3]);
      $('#del_man').val(data[4]);
      $('#par_status').val(data[5]);



    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->

</body>
</html>