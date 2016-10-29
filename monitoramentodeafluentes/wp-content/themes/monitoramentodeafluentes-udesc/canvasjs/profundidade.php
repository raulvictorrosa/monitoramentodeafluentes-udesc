<?php
include 'prof-select-data.php';

$dataPoints = array();
if (is_array($data) || is_object($data)) {
  foreach($data as $row) {
    $epoch = strtotime($row['data'].' '.$row['hora']);
    $profundidade = (2.14-$row['dados']);
    $newData = array('x'=>$epoch, 'y'=>$profundidade);
    $dataPoints[] = $newData;
  }
}

// var_dump($dataPoints);
// echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
