<?php
//access the values
foreach($_POST['dados'] as $row) {}

include 'con-db.php';

// query to get data from the table
// $sql = 'INSERT INTO `' . $dbname . '`.`profundidade` SET data = "'.$row['data'].'", hora = "'.$row['hora'].'", dados = "'.$row['dado'].'", cod = "'.$row['cod'].'"';
$sql = 'INSERT INTO `' . $dbname . '`.`evento_dados` SET data = "'.$row['data'].'", hora = "'.$row['hora'].'", dados = "'.$row['dado'].'", Sensor_codSensor = "'.$row['cod'].'"';
$data = $conn->prepare($sql);

include 'execute-data.php';
