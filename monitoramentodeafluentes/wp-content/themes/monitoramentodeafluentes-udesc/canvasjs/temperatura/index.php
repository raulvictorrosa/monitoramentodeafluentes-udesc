<?php include '../header.php'; ?>
<h1>Monitoramento de Afluentes</h1>
<?php
include 'select-data.php';

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

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>Home</h1>
      <h1 style="text-align: center;">Profundidade</h1>
      <div id="chartContainer" style="height: 400px;"></div>
    </div>
  </div>
  <div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
  </div>
</div><!-- /.container -->
<?php
// echo '<pre style="margin-top: 450px">';
// var_dump($dataPoints);
// echo '</pre>';
// echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
?>

<script type="text/javascript">
window.onload = function () {
  var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

  var chart = new CanvasJS.Chart("chartContainer", {
    title: {
      text: "Profundidade"
    },
    zoomEnabled: true,
    // animationEnabled: true,
    axisY: {
      // includeZero: false,
      suffix: " m",
    },
    axisX:{
      labelFontSize: 12,
      gridThickness: 2,
    },
    toolTip: {
      // shared: true,
      content: "<span style='\"'color: {color};'\"'><strong>{name}:</strong></span> <span style='\"'color: black;'\"'>{y}m</span> "
    },
    // legend: {
    //   fontSize: 13
    // },
    data: [{
      name: "Profundidade",
      type: "splineArea",
      showInLegend: true,
      // markerSize: 0,
      connectNullData:true,
      color: "rgba(54,158,173,.6)",
      xValueType: "dateTime",
      dataPoints: dataPoints,
    }]
  });

  chart.render();

  var updateInterval = 1000;
  var dataLength = 10; // number of dataPoints visible at any point
  var dados;

  function loadJSON(callback) {   
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', 'data-json.php', true); // Replace 'my_data' with the path to your file
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
      console.log(actual_JSON.length);
      if (actual_JSON.length > dataLength) {
        dataPoints.shift();  
        dataLength++;      
      }
      // console.log({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
    });

    chart.render();
  };
  setInterval(function () { updateChart() }, updateInterval);
}
</script>

<?php include '../footer.php'; ?>