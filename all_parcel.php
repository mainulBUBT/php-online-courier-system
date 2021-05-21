
<?php 
session_start();

include "connect.php";
$NAME= $_SESSION["NAME"];
$ids = $_SESSION["MEMBER_ID"];

include('header.php');



//------------------------- Update Data value Modal SQL --------------------//

if(isset($_GET['cancel']))
{
  $p_id = $_GET['cancel'];
  
  $sql = "SELECT `p_id`, parcel.`m_id`, `par_status`, delivery_info.del_id as del_id FROM `parcel` NATURAL JOIN delivery_info WHERE parcel.m_id=$ids and parcel.p_id=$p_id";
  
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc())
     {
      $sts = $row['par_status'];
      $del_id = $row['del_id'];

      if((strcmp($sts, 'Not pickup yet') == 0) && ($row['p_id'] == $p_id))
      {
        $sql1 ="DELETE FROM parcel WHERE del_id='$del_id'";
        if($conn->query($sql1)==TRUE)
         {
              $sql1 ="DELETE FROM delivery_info WHERE del_id='$del_id'";
            if($conn->query($sql1)==TRUE)
             {
                 ?>
                <script type="text/javascript">
                alert("Delete your request parcel from queue.");
                window.location = "all_parcel.php";
                </script>
                <?php
             }
             else {
              echo "Error updating record: " . $conn->error;
                    }
         }
         else {
              echo "Error updating record: " . $conn->error;
            }


      }
      else
      {
        ?>
    <script type="text/javascript">
                alert("Sorry you cannot cancel pickup/parcel order right now! Already picked up. For more info contact our office");
                window.location = "all_parcel.php";
                </script>
                <?php
      }



     }

}  //------------------------- Update Data value Modal SQL END--------------------//




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
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="all_parcel.php">
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

  $sql = "SELECT `del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`p_id` FROM `delivery_info` Natural Join `parcel` WHERE delivery_info.m_id = '$ids' and parcel.m_id = '$ids' and p_id LIKE '%$track_id%'";
$result = $conn->query($sql);
?>

<div class="card">
      <div class="card-header bg-head">
     <h4>Parcel Information</h4>
      </div>
<div class="table-responsive-sm table-sm">
<table class="table table-light text-center">
  <thead class="bg-light">
    <tr>
      <th scope="col">Recipient Name</th>
      <th scope="col">Recipient Number</th>
      <th scope="col">Recipient  Address</th>
      <th scope="col">Delivery Zone</th>
      <th scope="col">Collectable Amount</th>
      <th scope="col">Track ID</th>
      <th scope="col">Cancel</th>
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
      <td><?php echo $row["recv_name"]; ?></td>
      <td><?php echo $row["recv_number"]; ?></td>
      <td><?php echo $row["recv_address"]; ?></td>
      <td><?php echo $row["del_area"]; ?></td>
      <td><?php echo $row["col_amount"]; ?></td>
      <td><?php echo $row["p_id"]; ?></td>
      <td><?php echo "<form method ='get' action='invoice.php'><button type='submit' class='btn btn-danger' name='invoice' value='{$pid}'><i class='far fa-file-pdf'></i></button></form>"?></td>
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
    
    $sql = "SELECT `del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`p_id` FROM `delivery_info` Natural Join `parcel` WHERE delivery_info.m_id = '$ids' and parcel.m_id = '$ids' ORDER BY p_id DESC limit $start_form, $num_per_page";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      

   echo '<div class="table-responsive-sm table-sm">';
    echo '<table class="table table-light text-center">';
  echo '<thead class="thead-bom">';
    echo "<tr>";
      echo '<th scope="col">Recipient Name</th>';
      echo '<th scope="col">Recipient Number</th>';
      echo '<th scope="col">Recipient  Address</th>';
      echo '<th scope="col">Delivery Zone</th>';
      echo '<th scope="col">Collectable Amount</th>';
      echo '<th scope="col">Track ID</th>';
      echo '<th scope="col">Cancel</th>';
      echo '<th scope="col">Invoice PDF</th>';
    echo "<tr>";
 echo "</thead>";
  echo "<tbody>";
  while($row = $result->fetch_assoc()){
        $pid = $row["p_id"]; //pid for getting the specific user id's invoice

    echo "<tr>";
      echo "<td>". $row["recv_name"] . "</td>";
      echo "<td>". $row["recv_number"] . "</td>";
      echo "<td>". $row["recv_address"] . "</td>";
      echo "<td>". $row["del_area"] ."</th>";
      echo "<td>" . $row["col_amount"] . "</td>";
      echo "<td>" . $row["p_id"] . "</td>";
       echo "<td><form method ='get' action=''><button type='submit' class='btn btn-danger' name='cancel' value='{$pid}'><i class='fas fa-minus-circle'></i></button></form></td>";
      echo "<td><form method ='get' action='invoice.php'><button type='submit' class='btn btn-danger' name='invoice' value='{$pid}'><i class='far fa-file-pdf'></i></button></form></td>";
    echo "</tr>";
      }
  echo "</tbody>";
echo "</table>";
echo "</div>";
} else{
echo "<div class='alert alert-warning' role='alert'>
  You didn't make any pick-up request yet, click ' <i class='fas fa-folder-plus'></i><b> Add Pickup Request</b> ' for making new pick-up request
</div>";
}
?>


<?php 
      $sql = "SELECT `del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`p_id` FROM `delivery_info` natural Join `parcel` WHERE delivery_info.m_id = '$ids' and parcel.m_id = '$ids'";
    $result = $conn->query($sql);
    $totalrecord = $result->num_rows;
    $totalpages = ceil($totalrecord/$num_per_page);
    for ($i=1; $i <=$totalpages ; $i++) { 
      echo "<a href='all_parcel.php?page=".$i."' class='btn btn-own text-light' style='margin-left: 10px;'>$i</a>";
    }


  }    //------------------------- Condition for else data END --------------------//

   ?>


    
</div>
  
 <!-------------------------------- Sidebar col-4 END ---------------------------->

</div></div>


 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>




</body>
</html>