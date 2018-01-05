<?php include 'header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
      include 'prof-select-data.php';

      $dataPoints = array();
      if (is_array($data) || is_object($data)) {
        foreach($data as $row) {
          // echo '<pre>';
          $epoch = strtotime($row['data'].' '.$row['hora']);
          $profundidade = (2.14-$row['dados']);
          $newData = array('x'=>$epoch, 'y'=>$profundidade);
          $dataPoints[] = $newData;
          // echo '</pre>';
        }
      }
      ?>

      <h1 style="text-align: center;">Profundidade</h1>
      <div id="chartContainer" style="height: 400px;"></div>

      <?php
      // var_dump($dataPoints);
      // echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
      ?>

      <script type="text/javascript">
      window.onload = function () {
        var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

        var chartProf = new CanvasJS.Chart("chartContainer", {
          // title: {text: "Profundidade"},
          // animationEnabled: true,
          zoomEnabled: true,
          axisY: {
            // includeZero: false,
            suffix: " m",
            stripLines:[{
              value: 2.14,
              // color: "rgba(194, 70, 66, .6)"
              color: "red"
            }]
          },
          axisX:{
            labelFontSize: 12,
            gridThickness: 2,
          },
          toolTip: {
            // shared: true,
            content: "<span style='\"'color: {color};'\"'><strong>{name}:</strong></span> <span style='\"'color: black;'\"'>{y}m</span> "
          },
          // legend: {fontSize: 13},
          data: [{
            name: "Profundidade",
            type: "splineArea",
            showInLegend: true,
            // markerSize: 0,
            connectNullData: true,
            color: "rgba(54,158,173,.6)",
            xValueType: "dateTime",
            dataPoints: dataPoints,
          }]
        });

        chartProf.render();

        var updateInterval = 1000;
        var dataLength = 10; // number of dataPoints visible at any point
        var dados;

        function loadJSON(callback) {   
          var xobj = new XMLHttpRequest();
          xobj.overrideMimeType("application/json");
          xobj.open('GET', 'prof-data-json.php', true); // Replace 'my_data' with the path to your file
          xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == "200") {
              // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
              callback(xobj.responseText);
            }
          };
          xobj.send(null);  
        }

        var aux = [];
        function updateChart() {
          loadJSON(function(response) {
            // Parse JSON string into object
            var actual_JSON = JSON.parse(response);
            aux = actual_JSON[actual_JSON.length-1];
            dataPoints.push({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
            // console.log(actual_JSON.length);
            if (actual_JSON.length > dataLength) {
              dataPoints.shift();  
              dataLength++;      
            } else if (actual_JSON.length == 1) {
              dataPoints.shift();
            }
            // console.log({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
          });

          chartProf.render();
        };
        setInterval(function () { updateChart() }, updateInterval);
      }
      </script>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
