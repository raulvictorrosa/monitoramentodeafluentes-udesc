<?php
// setting header to json
header('Content-Type: application/json');

include 'con-db.php';

// query to get data from the table
$sql = 'SELECT id, data, hora, dados, cod FROM `profundidade` WHERE cod = "UL0" ORDER BY data, hora';
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
