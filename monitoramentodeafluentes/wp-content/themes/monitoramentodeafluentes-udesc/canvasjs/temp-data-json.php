<?php
// setting header to json
header('Content-Type: application/json');

include 'con-db.php';

// query to get data from the table
// $sql = 'SELECT idEvento_dad as id, data, hora, dados, Sensor_codSensor FROM `evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora';
$sql = 'SELECT idEvento_dad as id, data, hora, dados, Sensor_codSensor FROM (
    			SELECT * FROM `evento_dados` WHERE Sensor_codSensor = "TEM" ORDER BY data, hora DESC LIMIT 10
				) sub
				ORDER BY data, hora;';
// $sql = 'SELECT idEvento_dad as id, data, hora, dados FROM `evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora';
$data = $conn->prepare($sql);

include 'execute-data.php';

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

//now print the dataPoints
// print json_encode($dataPoints2);
echo json_encode($dataPoints2, JSON_NUMERIC_CHECK);
