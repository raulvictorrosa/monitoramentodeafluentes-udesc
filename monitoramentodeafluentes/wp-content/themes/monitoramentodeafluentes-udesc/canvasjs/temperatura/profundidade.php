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

// echo '<pre style="margin-top: 450px">';
// var_dump($dataPoints);
// echo '</pre>';
// echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
