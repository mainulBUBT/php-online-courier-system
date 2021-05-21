<?php 
session_start();
include "connect.php";
$NAME= $_SESSION["NAME"];
$ids = $_SESSION['MEMBER_ID'];
include('header.php');

      //sql for user insert data--> 
 //`del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`

if(isset($_REQUEST['insert'])){
  if(($_REQUEST['del_area']=="") || ($_REQUEST['col_amount']=="") || ($_REQUEST['recv_name']=="") || ($_REQUEST['recv_number']=="") || ($_REQUEST['recv_address']=="")){
    echo "Please Fill All Form";
  }
  else
  {
    $area = $_REQUEST["del_area"];
    $amount = $_REQUEST["col_amount"];
    $recv_name = $_REQUEST["recv_name"];
    $recv_number = $_REQUEST["recv_number"];
    $recv_address = $_REQUEST["recv_address"];
    $dhaka = "Dhaka Metro";
    $tk="60";

   
    $sql = "SELECT `dhk_charge_up_2kg`, out_dhk_charge FROM `admin_table`";
    $result = $conn->query($sql);
     while($row = $result->fetch_assoc())
     {
      $dhaka_chrg=$row['dhk_charge_up_2kg'];
      $out_dhaka_chrg=$row['out_dhk_charge'];



           //**------------checking conditions where delivery is inside dhaka or outsite dhaka-------**//

       if(strcmp($area,$dhaka) == 0){

        if ($amount=='0') 
        {
          //**------------When delivery charge due-------**//


           $sql = "INSERT INTO `delivery_info`(`del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`m_id`)  VALUES ('$area','$amount','$recv_name','$recv_number','$recv_address', '$ids')";
          if($conn->query($sql)==TRUE)
          {
          $last_id = $conn->insert_id;
         $sql2 = "INSERT INTO `parcel`(`m_id`, `del_id`, `due_chrg`, `par_status`)  VALUES ('$ids','$last_id',' $dhaka_chrg', 'Not pickup yet' )";
         if($conn->query($sql2)==TRUE)
         {
          echo '<script language="javascript">';
          echo 'alert("You have been created Pick-Up reguest, Thank you!")';
          echo '</script>';
         }
          
          }
        }
        else
        {
          //**------------When delivery charge not need to be collect-------**//
          $chrg1= $amount- $dhaka_chrg;

           $sql = "INSERT INTO `delivery_info`(`del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`m_id`)  VALUES ('$area','$amount','$recv_name','$recv_number','$recv_address', '$ids')";
          if($conn->query($sql)==TRUE)
          {
          $last_id = $conn->insert_id;
         $sql2 = "INSERT INTO `parcel`(`m_id`, `del_id`,`chrg`,`user_bal`, `par_status`)  VALUES ('$ids','$last_id',' $dhaka_chrg', '$chrg1','Not pickup yet')";
         if($conn->query($sql2)==TRUE)
         {
          echo '<script language="javascript">';
          echo 'alert("You have been created Pick-Up reguest, Thank you!")';
          echo '</script>';
         }
          
         }

       }

    }
    else if(strcmp($area,'Outside Dhaka') == 0){

        if ($amount=='0') 
        {

           $sql = "INSERT INTO `delivery_info`(`del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`m_id`)  VALUES ('$area','$amount','$recv_name','$recv_number','$recv_address', '$ids')";
          if($conn->query($sql)==TRUE)
          {
          $last_id = $conn->insert_id;
         $sql2 = "INSERT INTO `parcel`(`m_id`, `del_id`,`due_chrg`, `par_status`)  VALUES ('$ids','$last_id','$out_dhaka_chrg','Not pickup yet' )";
         if($conn->query($sql2)==TRUE)
         {
          echo '<script language="javascript">';
          echo 'alert("You have been created Pick-Up reguest, Thank you!")';
          echo '</script>';
         }
          
          }
        }
        else
        {
          $chrg2= $amount-$out_dhaka_chrg;
           $sql = "INSERT INTO `delivery_info`(`del_area`, `col_amount`, `recv_name`, `recv_number`, `recv_address`,`m_id`)  VALUES ('$area','$amount','$recv_name','$recv_number','$recv_address', '$ids')";
          if($conn->query($sql)==TRUE)
          {
          $last_id = $conn->insert_id;
         $sql2 = "INSERT INTO `parcel`(`m_id`, `del_id`,`chrg`,`user_bal`, `par_status`)  VALUES ('$ids','$last_id','$out_dhaka_chrg','$chrg2','Not pickup yet')";
         if($conn->query($sql2)==TRUE)
         {
          echo '<script language="javascript">';
          echo 'alert("You have been created Pick-Up reguest, Thank you!")';
          echo '</script>';
         }
          
         }

       }
    }




    else{
      echo "Unable to record data";
    }



    }
  }
}
      //Copying data delivery_info to parcel table//
     // $sql2 = "INSERT INTO `parcel` (`m_id`, `del_id`) Select m_id,del_id from delivery_info where delivery_info.m_id='$ids'";

?>

<head>
  <title>Fast Courier | Add new parcel request </title>
</head>




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
  <a type="button" class="list-group-item list-group-item-action" href="all_parcel.php">
    <b><i class="fas fa-clipboard-list"></i> All Parcel List</a></b>
  </a>
<a type="button" class="list-group-item list-group-item-action sidemenu" href="add_parcel.php">
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
  <div class="col-sm-12 col-md-12 col-lg-8 mt-sm-3">
    <div class="card mt-3">
  <div class="card-header">
    Add New Parcel Request
  </div>
  <div class="card-body">
    <form method="post"  action="add_parcel.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Recipient Name</label>
    <input class="form-control" type="text" name="recv_name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Recipient Number</label>
    <input class="form-control" type="text" name="recv_number">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Zone</label>
    <select class="form-control" id="exampleFormControlSelect1" name="del_area">
      <option>Dhaka Metro</option>
      <option>Outside Dhaka</option>
    </select>
  </div>
 <div class="form-group">
    <label for="exampleFormControlTextarea1">Recipient Address</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  name="recv_address"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Collectable Amount</label>
    <input class="form-control" type="text" name="col_amount">
  </div>
  <button type="submit" class="btn btn-own btn-block text-light" name="insert">Pick-Up Request</button>
</form>
  </div>
</div>
    <br>
</div>
</div></div>

 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>




</body>
</html>