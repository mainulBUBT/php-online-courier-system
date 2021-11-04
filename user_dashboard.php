
<?php 
include "connect.php";
session_start();
if(isset($_SESSION['NAME']))
{
$NAME = $_SESSION["NAME"];
$ids = $_SESSION["MEMBER_ID"];
}
else {
  echo "<script> location.href='user_login.php' </script>";
}

include('header.php');


?>

<head>
  <style>
   .container .row .card .card-header h2{
      font-size: 52px;
      text-align: center;
    }
    .container .row .card .card-header p{
      text-align: right;
      font-size: 20px;
      margin-right: 19px;
    }
    .border.border-primary {

    border-color: #0339A6 !important;

}
.card-header.bg-primary {

    background-color: #048ABF !important;

}

.border.border-primary {

    border-color: #048ABF !important;

}
.bg-due {
    background-color: #F25116 !important;
}
.bg-delivered {
    background-color: #38024D !important;
}
.bg-balance {
    background-color: #2B190E !important;
}



  </style>
</head>





    


 <!-------------------------------- Sidebar col-4 Start ---------------------------->

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
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="user_dashboard.php">
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
  <a type="button" class="list-group-item list-group-item-action" href="user_settings.php">
    <b><i class="fas fa-user-cog"></i> Settings</a></b>
  </a>
</div></div>
<?php
}
?>
 <!-------------------------------- Sidebar col-4 END ---------------------------->

   
 <!-------------------------------- Sidebar col-8 Start ---------------------------->
  <div class="col-sm-12 col-md-12 col-lg-8">
    <div class="row">
      <!--------------------- Sidebar col-12 for DASHBOARD Start -------------------->
      <div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 10px">
        <div class="card">
          <div class="card-header bg-head" style="color: white">
            <h3><i class="fas fa-tachometer-alt"></i> Dashboard</h3>
          </div>
        </div> 
    </div><!--------------------- Sidebar col-12 for DASHBOARD END -------------------->
    </div><!---------------------- col-12 row end --------------------->

     <!-------------------------------- SQL for dahboard ---------------------------->
    <?php
        $sql="SELECT (SELECT COUNT(p_id) FROM parcel WHERE m_id='$ids') as total ,(SELECT COUNT(p_id) FROM parcel WHERE par_status='Delivered' and m_id='$ids') as delivered,(SELECT SUM(user_bal) FROM parcel WHERE payment='1' and m_id='$ids') as received,(SELECT SUM(user_bal) FROM parcel WHERE payment='0' and m_id='$ids') as due,(SELECT SUM(due_chrg) FROM parcel WHERE payment='0' and m_id='$ids') as due_chrg";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {

          while ($row=$result->fetch_assoc()) {
 
        ?>
     <!-------------------------------- SQL for dahboard  while part---------------------------->

    <div class="row"> <!---------------------- row(1) for 6-6 grid Start --------------------->
     <div class="col-sm-12 col-md-6 col-lg-6">        
      <div class="card">   
        <div class="card-header bg-primary text-light">     
          <h2><i class="fas fa-box float-left"></i><?php echo $row['total']?></h2>     
          <p>Requested Total Parcel</p>   
        </div>  
         <div class="card-footer text-muted">   
         </div> 
       </div>       
     </div>      
      <div class="col-sm-12 col-md-6 col-lg-6">        
        <div class="card border">  
         <div class="card-header bg-success text-light">     
          <h2><i class="fas fa-calendar-check float-left"></i><?php echo $row['delivered']?></h2>     <p>Delivered Total Parcel</p>   
        </div>   
        <div class="card-footer text-muted">   
        </div> 
      </div>      
       </div>
    </div><!---------------------- row(1) for 6-6 grid END --------------------->

    <div class="row" style="margin-top: 8px;"> <!---------------------- row(1) for 6-6 grid Start --------------------->
     <div class="col-sm-12 col-md-6 col-lg-6">        
      <div class="card">   
        <div class="card-header bg-balance text-light">     
          <h2><i class="fas fa-hand-holding-usd float-left"></i><?php echo $row['received']?>৳</h2>     
          <p>Total Amount Received</p>   
        </div>  
         <div class="card-footer text-muted">   
         </div> 
       </div>       
     </div>      
      <div class="col-sm-12 col-md-6 col-lg-6">        
        <div class="card border">  
         <div class="card-header bg-dark text-light">     
          <h2><i class="fas fa-dollar-sign float-left"></i><?php echo $row['due']?>৳</h2>     <p>Total Due Amount</p>   
        </div>   
        <div class="card-footer text-muted">   
        </div> 
      </div>      
       </div>
    </div><!---------------------- row(1) for 6-6 grid END --------------------->

    <div class="row" style="margin-top: 8px;"> <!---------------------- row(1) for 6-6 grid Start --------------------->
     <div class="col-sm-12 col-md-6 col-lg-6">        
      <div class="card">   
        <div class="card-header bg-danger text-light">     
          <h2><i class="fas fa-truck float-left"></i><?php echo $row['due_chrg']?>৳</h2>     
          <p> Due Service Charge</p>   
        </div>  
         <div class="card-footer text-muted">   
         </div> 
       </div>       
     </div>      
    </div><!---------------------- row(1) for 6-6 grid END --------------------->


 




    </div> <!-------------------------------- Sidebar col-8 END ---------------------------->


</div></div>
<!-------------------------------- Main Grid Part END ---------------------------->
<?php
 } //--------------------------While condition END-------------------------//

        }//--------------------------If condition END-------------------------//
        ?>


<!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>


</body>
</html>