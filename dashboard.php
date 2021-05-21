
<?php 
include "connect.php";
include('header.php');
include('admin_auth.php');

/*$dataPoints = array();
$sql = "SELECT DISTINCT Date(stamp_created), COUNT(p_id)  FROM parcel GROUP BY Date(stamp_created)";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = mysqli_fetch_row($result)) {
    $dataPoints[] = array("x" => (strtotime($row[0])*1000), "y" => $row[1]); 
  }
} */



///Morris chart Daily

$query = "SELECT DISTINCT Date(stamp_created) as timez, COUNT(p_id) as count  FROM parcel GROUP BY Date(stamp_created)";
$result = mysqli_query($conn, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
    $chart_data .= "{ time:'".$row["timez"]."', parcel:".$row["count"]."}, ";
}
    $chart_data = substr($chart_data, 0, -1);



///Morris chart Monthly
$querys = "SELECT DISTINCT MONTHNAME(stamp_created) as month,YEAR(stamp_created) as year,  COUNT(p_id) as count  FROM parcel GROUP BY MONTH(stamp_created)";
$results = mysqli_query($conn, $querys);
$chart_datas = '';
while($rowz = mysqli_fetch_array($results))
{
    $chart_datas .= "{ month:'".$rowz["month"]."', year:".$rowz["year"].",  count:".$rowz["count"]."},";
}
    $chart_datas = substr($chart_datas, 0, -1);


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
.bg-transit {
    background-color: #F25116 !important;
}
.bg-delivered {
    background-color: #38024D !important;
}
.bg-balance {
    background-color: #2B190E !important;
}


  </style>


<!--  <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
animationEnabled: true,
theme: "light2", // "light1", "light2", "dark1", "dark2"
axisX:{      
valueFormatString: "DD-MMM",
interval: 6
},
data: [{
type: "column",
xValueType: "dateTime",
dataPoints:  <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK) ?>
}]
});
chart.render();


} -->




</script>

</head>





    


 <!-------------------------------- Sidebar col-4 Start ---------------------------->

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
  <a type="button" class="list-group-item list-group-item-action sidemenu" href="dashboard.php">
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
  <a type="button" class="list-group-item list-group-item-action" href="admin_settings.php">
    <b><i class="fas fa-user-cog"></i> Settings</a></b>
  </a>
</div></div>
<?php
}
?>
 <!-------------------------------- Sidebar col-4 END ---------------------------->

   
 <!-------------------------------- Sidebar col-8 Start ---------------------------->
  <div class="col-sm-12 col-md-12 col-lg-8 mt-4">
    <div class="row">
 <!-------------------------------- SQL for dashboard ---------------------------->
    <?php
        $sql="SELECT (SELECT COUNT(p_id) FROM parcel WHERE par_status='in transit') as transit,(SELECT COUNT(p_id) FROM parcel ) as total,(SELECT COUNT(p_id) FROM parcel WHERE par_status='Delivered') as delivered,(SELECT COUNT(p_id) FROM parcel WHERE par_status='picked up') as pickedup,(SELECT COUNT(`m_id`) FROM `marchant`) as marchant,(SELECT SUM(chrg+due_chrg) FROM `parcel` WHERE payment='1' AND `par_status`='Delivered') as payments";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {

          while ($row=$result->fetch_assoc()) {
 
        ?>





      <!--------------------- Sidebar col-12 for DASHBOARD Start -------------------->
      <div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 10px">
        <div class="card">
          <div class="card-header bg-head" style="color: white">
            <h3><i class="fas fa-tachometer-alt"></i> Dashboard</h3>
          </div>
        </div> 
    </div><!--------------------- Sidebar col-12 for DASHBOARD END -------------------->
    </div><!---------------------- col-12 row end --------------------->
    <div class="row"> <!---------------------- row(1) for 4-4-4 grid Start --------------------->
      <div class="col-sm-12 col-md-4 col-lg-4">
       <div class="card">
  <div class="card-header bg-primary text-light">
    <h2><i class="fas fa-box float-left"></i><?php echo $row['total']?></h2>
    <p>Total Parcel</p>
  </div>
  <div class="card-footer text-muted">
    <a href="pending_parcel.php" style="text-decoration: none">View details<i class="fas fa-arrow-circle-right float-right"></i></a>
  </div>
</div>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
       <div class="card border">
  <div class="card-header bg-success text-light">
    <h2><i class="fas fa-people-carry float-left"></i><?php echo $row['pickedup']?></h2>
    <p>Picked Up</p>
  </div>
  <div class="card-footer text-muted">
    <a href="pickedup_parcel.php" style="text-decoration: none">View details<i class="fas fa-arrow-circle-right float-right"></i></a>
  </div>
</div>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
       <div class="card">
  <div class="card-header bg-transit text-light">
    <h2><i class="fas fa-shipping-fast float-left"></i><?php echo $row['transit']?></h2>
    <p>In-transit</p>
  </div>
  <div class="card-footer text-muted">
    <a href="transit_parcel.php" style="text-decoration: none">View details<i class="fas fa-arrow-circle-right float-right"></i></a>
  </div>
</div>
      </div>
    </div><!---------------------- row(1) for 4-4-4 grid END --------------------->

    <!---------------------- row(2) for 4-4-4 grid Start --------------------->

    <div class="row" style="margin-top: 8px;">
      <div class="col-sm-12 col-md-4 col-lg-4">
       <div class="card">
  <div class="card-header bg-delivered text-light">
    <h2><i class="fas fa-calendar-check float-left"></i><?php echo $row['delivered']?></h2>
    <p>Delivered</p>
  </div>
  <div class="card-footer text-muted">
    <a href="done_parcel.php" style="text-decoration: none">View details<i class="fas fa-arrow-circle-right float-right"></i></a>
  </div>
</div>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
       <div class="card border">
  <div class="card-header bg-danger text-light">
    <h2><i class="fas fa-user float-left"></i><?php echo $row['marchant']?></h2>
    <p>Marchants</p>
  </div>
  <div class="card-footer text-muted">
    <a href="marchants.php" style="text-decoration: none">View details<i class="fas fa-arrow-circle-right float-right"></i></a>
  </div>
</div>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4">
       <div class="card">
  <div class="card-header bg-balance text-light">
    <h2><i class="fas fas fa-dollar-sign float-left"></i><?php echo $row['payments']?></h2>
    <p>Balance</p>
  </div>
  <div class="card-footer text-muted">
    <a href="admin_payments.php" style="text-decoration: none">View details<i class="fas fa-arrow-circle-right float-right"></i></a>
  </div>
</div>
      </div>
    </div><!---------------------- row(2) for 4-4-4 grid END --------------------->


<?php
 } //--------------------------While condition END-------------------------//

        }//--------------------------If condition END-------------------------//
        ?>
        <br>
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div id="accordion">
  <div class="card">
    <div class="card-header bg-light">
      <a class="card-link text-dark" data-toggle="collapse" href="#collapseOne">
       <b><i class="far fa-chart-bar"></i> Daily Parcel Request <i class="fas fa-caret-down  float-right"></i></b>
      </a>
    </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
      <div class="card-body">
      <!-- <div id="chartContainer" style="height: 250px; max-width: 920px; margin: 0px auto;"></div> -->
      <div id="chart"></div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" role="tab">
      <a class=" card-link text-dark" data-toggle="collapse" href="#collapseTwo">
        <b><i class="far fa-chart-bar"></i> Monthly Parcel Request <i class="fas fa-caret-down  float-right"></i></b>
      </a>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">      
        <div id="month-chart"></div>
      </div>
    </div>
  </div>
</div>






          </div>   <!----Col for chart END--------->
          </div><!-----row for char END------------>
          
         





    </div> <!-------------------------------- Sidebar col-8 END ---------------------------->


</div></div>
<!-------------------------------- Main Grid Part END ---------------------------->

 <!-------------First JQuery then Popper then Bootstrap then Fontawesome ------------->

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/417824116f.js" crossorigin="anonymous"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



<!---Morris Bar JS--------------->
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'time',
 ykeys:['parcel'],
 labels:['parcel'],
 hideHover:'auto',
 stacked:true
});
</script>

<!---Morris Bar JS--------------->
<script>
  function chartTab2(){
Morris.Bar({
 element : 'month-chart',
 data:[<?php echo $chart_datas; ?>],
 xkey:'month',
 ykeys:['count'],
 labels:['count', 'year'],
 hideHover:'auto',
 stacked:true
});
}

//---------------Collapsing Bar 2 JS---------------//
$('#collapseTwo').on("shown.bs.collapse",function(){
      chartTab2();
     // $('#collapseTwo').off(); // to remove the binded event after the initial rendering if needed
  });
</script>
</body>
</html>
