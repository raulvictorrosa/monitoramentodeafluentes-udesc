<?php
include 'con-db.php';

// Recebe a id enviada no método GET
// $id = 2;

$sql = 'SELECT id, data, hora, dados, cod FROM `profundidade` WHERE cod = "UL0" ORDER BY data, hora';
// $sql = 'SELECT idEvento_dad as id, data, hora, dados FROM `evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora';
// $sql = 'SELECT id, data, hora, dados, cod FROM `profundidade` WHERE cod = "UL0" AND id = "'.$id.'" ORDER BY data, hora';
$data = $conn->prepare($sql);

include 'execute-data.php';
