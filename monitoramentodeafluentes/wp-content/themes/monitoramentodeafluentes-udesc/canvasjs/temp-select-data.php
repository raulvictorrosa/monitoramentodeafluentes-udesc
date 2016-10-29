<?php
include 'con-db.php';

$sql = 'SELECT idEvento_dad as id, data, hora, dados, Sensor_codSensor FROM (
    			SELECT * FROM `evento_dados` WHERE Sensor_codSensor = "TEM" ORDER BY data, hora DESC LIMIT 10
				) sub
				ORDER BY data, hora;';
$data = $conn->prepare($sql);

include 'execute-data.php';
