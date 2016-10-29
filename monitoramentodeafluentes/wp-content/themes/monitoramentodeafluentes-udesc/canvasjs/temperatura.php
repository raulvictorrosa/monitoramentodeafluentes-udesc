<?php
include 'temp-select-data.php';

$dataPoints2 = array();
if (is_array($data) || is_object($data)) {
  foreach($data as $row) {
    $epoch = strtotime($row['data'].' '.$row['hora']);
    $temperatura = ($row['dados']);
    $newData = array('x'=>$epoch, 'y'=>$temperatura);
    $dataPoints2[] = $newData;
  }
}

// var_dump($dataPoints);
// echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
