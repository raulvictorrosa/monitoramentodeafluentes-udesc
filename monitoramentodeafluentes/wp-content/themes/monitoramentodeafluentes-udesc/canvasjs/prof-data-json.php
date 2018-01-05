<?php
// setting header to json
header('Content-Type: application/json');

include 'con-db.php';

// query to get data from the table
// $sql = 'SELECT idEvento_dad as id, data, hora, dados, Sensor_codSensor FROM `evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora';
$sql = 'SELECT idEvento_dad as id, data, hora, dados, Sensor_codSensor FROM (
    			SELECT * FROM `evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora DESC LIMIT 10
				) sub
				ORDER BY data, hora;';
// $sql = 'SELECT idEvento_dad as id, data, hora, dados FROM `evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora';
$data = $conn->prepare($sql);

include 'execute-data.php';

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

//now print the dataPoints
// print json_encode($dataPoints);
echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
