<!DOCTYPE html>
<html>
<head>

  <title>Bootstrap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- <script>
    var chart1 = new CanvasJS.Chart("chartContainer1", {
      title:{
        text:"Chart 1"
      },  
      data: [
      {
        type: "column",
        dataPoints: [
        { x: 10, y: 71 },
        { x: 20, y: 55},
        { x: 30, y: 50 },
        { x: 40, y: 65 },
        { x: 50, y: 95 },
        { x: 60, y: 68 },
        { x: 70, y: 28 },
        { x: 80, y: 34 },
        { x: 90, y: 14}
        ]
      }
      ]
    });
  chart1.render();

  
    
function chartTab2() {
    var chart2 = new CanvasJS.Chart("chartContainer2", {
      title:{
        text:"Chart 2"
      },
      zoomEnabled: true,
      data: [
      {
        type: "line",
        dataPoints: [
        { x: 10, y: 58 },
        { x: 20, y: 35},
        { x: 30, y: 36 },
        { x: 40, y: 75 },
        { x: 50, y: 45 },
        { x: 60, y: 28 },
        { x: 70, y: 48 },
        { x: 80, y: 14 },
        { x: 90, y: 54}
        ]
      }
      ]
    });
    chart2.render();
  }

$('#collapseTwo').on("shown.bs.collapse",function(){
      chartTab2();
     // $('#collapseTwo').off(); // to remove the binded event after the initial rendering if needed
  });
  </script>
</head>
<body>

<h3 align="center">CanvasJS Charts with Bootstrap Accordion / Collapse</h3>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Chart 1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div id="chartContainer1" style="height: 300px; width: 100%;">
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Chart 2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <div id="chartContainer2" style=" height: 300px; width: 100%;">
        </div>
      </div>
    </div>
  </div>
</div>
     -->
</body>
</html>
<?php

$txt = "1";
$txt2 = "2";
print $text + $text2;
?>