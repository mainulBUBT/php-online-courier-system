
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


//------------------------- Update Data value Modal SQL --------------------//

if(isset($_POST['update']))
{
  $ids = $_POST['p_id'];
  $status = $_POST['par_status'];

  $sql = "UPDATE parcel SET par_status='$status' WHERE p_id='$ids'";
  
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
        <h5 class="modal-title">Update Parcel Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  action="staff_space.php">
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
    <label for="exampleInputEmail1">Collectable Amount</label>
    <input class="form-control" type="text" id="col_amount" name="col_amount" readonly="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Take Action</label>
    <select class="form-control" id="par_status" name="par_status">
      <option value="picked up">picked up</option>
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



   <!-------------------------------- Main Part ---------------------------->

    
  <div class="container"><div class="row">

 
 <!-------------------------------- Sidebar col-4 Start ---------------------------->

  <div class="col-sm-12 col-md-12 col-lg-4"><div class="list-group">
  <div class="list-group-item list-group-item-action sidemenu">
  </div>
  <div class="list-group-item list-group-item-action ">
    <img src="images/profile.png" width="35%" height="35%" class="img-fluid rounded-circle mx-auto d-block" alt=""><h5 class="text-center bold"><?php echo $SNAME; ?></h5>
  </div>
  <div class="list-group-item list-group-item-action sidemenu" >
    <b><i class="fas fa-wallet"></i> Space Desk</div></b>
  <a type="button" class="list-group-item list-group-item-action" href="staff_work.php">
    <b><i class="fas fa-clipboard-list"></i> Work Management</a></b>
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
    
    $sql = "SELECT p_id , recv_name,recv_address,recv_number,col_amount,del_area,par_status FROM parcel NATURAL JOIN delivery_info WHERE parcel.del_id=delivery_info.del_id and parcel.par_status='Not pickup yet' and parcel.del_man='$SNAME' ORDER BY p_id ASC limit $start_form, $num_per_page";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
    echo '<div class="table-responsive-sm">';
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
      echo '<th scope="col">Take Action</th>';
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
      echo "<td><button type='button' class='btn btn-own editbtn'><i class='fas fa-edit'></i></button></td>";
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
      $('#recv_number').val(data[2]);
      $('#recv_address').val(data[3]);
      $('#del_area').val(data[4]);
      $('#col_amount').val(data[5]);
      $('#par_status').val(data[6]);



    });
  });
</script>
<!-------------------------------JavaScript for Modal Access Start------------ ------------->


</body>
</html>