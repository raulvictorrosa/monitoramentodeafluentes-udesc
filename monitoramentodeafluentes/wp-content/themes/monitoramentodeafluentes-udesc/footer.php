<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monitoramentodeafluentes-theme
 */

?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="text-muted" style="text-align: center;/*margin-top: 50px;*/">
						&#169; 2016 Developed by Raul Victor Rosa
					</p>
				</div>
			</div>
    </div>

    <?php
    if ( is_page( 'profundidade' ) || is_home() ) {
    	include 'canvasjs/profundidade.php'; // var_dump($dataPoints);
    } else if ( is_page( 'temperatura' ) ) {
    	include 'canvasjs/temperatura.php'; // var_dump($dataPoints);
    }
    ?>
		<?php wp_footer(); ?>

		<?php if ( is_page( 'profundidade' ) || is_home() ) { ?>
    <script type="text/javascript">
  	// Gráfico de Profundidade
		window.onload = function () {
		  var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

		  var chartProf = new CanvasJS.Chart("chartProfundidade", {
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
        xobj.open('GET', '<?php echo get_template_directory_uri(); ?>/canvasjs/prof-data-json.php', true); // Replace 'my_data' with the path to your file
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
          // console.log(actual_JSON[actual_JSON.length-1]['y']);
          // console.log(dataPoints[actual_JSON.length-1]['y']);
          if (actual_JSON[actual_JSON.length-1]['y'] != dataPoints[actual_JSON.length-1]['y']) {
          	location.reload();
          }

					// aux = actual_JSON[actual_JSON.length-1];
					// dataPoints.push({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
					// // console.log(actual_JSON.length);
					// if (actual_JSON.length > dataLength) {
					// 	dataPoints.shift();
					// 	dataLength++;
					// }
					// try {
					// 	if (dataPoints[actual_JSON.length]['x'] == dataPoints[actual_JSON.length]['x'] & dataPoints[actual_JSON.length]['y'] == dataPoints[actual_JSON.length]['y']) {
					// 		// console.log(dataPoints[actual_JSON.length]);
					// 		dataPoints.pop();
					// 	}
					// } catch(err) {
					// 	console.log(err.message);
					// }
					// // console.log(dataPoints[actual_JSON.length-1]['x']);
					// console.log(actual_JSON.length);
					// // console.log({"x" : parseInt(aux['x']), "y" : parseFloat(aux['y'])});
        });

				// chartProf.render();
      };
      setInterval(function () { updateChart() }, updateInterval);
		}
		</script>
		<?php } else if ( is_page( 'temperatura' ) ) { ?>
    <script type="text/javascript">
  	// Gráfico de Temperatura
		window.onload = function () {
		  var dataPoints2 = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;

		  var chartTemp = new CanvasJS.Chart("chartTemperatura", {
		    // title: {text: "Temperatura"},
		    // animationEnabled: true,
		    zoomEnabled: true,
		    axisY: {
		      // includeZero: false,
		      suffix: " °C",
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
        xobj.open('GET', '<?php echo get_template_directory_uri(); ?>/canvasjs/temp-data-json.php', true); // Replace 'my_data' with the path to your file
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
          // console.log(actual_JSON[actual_JSON.length-1]['y']);
          // console.log(dataPoints2[actual_JSON.length-1]['y']);
          if (actual_JSON[actual_JSON.length-1]['y'] != dataPoints2[actual_JSON.length-1]['y']) {
          	location.reload();
          }
        });
      };

      setInterval(function () { updateChart() }, updateInterval);
		}
		</script>
		<?php } ?>
	</body>
</html>
