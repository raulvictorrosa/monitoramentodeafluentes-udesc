<?php include 'header.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
      include 'temp-select-data.php';

      $dataPoints2 = array();
      if (is_array($data) || is_object($data)) {
        foreach($data as $row) {
          // echo '<pre>';
          $epoch = strtotime($row['data'].' '.$row['hora']);
          $temperatura = ($row['dados']);
          $newData = array('x'=>$epoch, 'y'=>$temperatura);
          $dataPoints2[] = $newData;
          // echo '</pre>';
        }
      }
      ?>

      <h1 style="text-align: center;">Temperatura</h1>
      <div id="chartTemperatura" style="height: 400px;"></div>

      <?php
      // var_dump($dataPoints);
      // echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
      ?>

      <script type="text/javascript">
      window.onload = function () {
        var dataPoints2 = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;

        var chartTemp = new CanvasJS.Chart("chartTemperatura", {
          // title: {text: "Temperatura"},
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
            name: "Temperatura",
            type: "splineArea",
            showInLegend: true,
            // markerSize: 0,
            connectNullData: true,
            color: "rgba(194, 70, 66,.6)",
            xValueType: "dateTime",
            dataPoints: dataPoints2,
          }]
        });

        chartTemp.render();

        var updateInterval = 1000;
        var dataLength = 10; // number of dataPoints visible at any point
        var dados;

        function loadJSON(callback) {   
          var xobj = new XMLHttpRequest();
          xobj.overrideMimeType("application/json");
          xobj.open('GET', 'temp-data-json.php', true); // Replace 'my_data' with the path to your file
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
            dataPoints2.push({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
            // console.log(actual_JSON.length);
            if (actual_JSON.length > dataLength) {
              dataPoints2.shift();  
              dataLength++;      
            } else if (actual_JSON.length == 1) {
              dataPoints2.shift();
            }
            // console.log({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
          });

          chartTemp.render();
        };
        setInterval(function () { updateChart() }, updateInterval);
      }
      </script>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>