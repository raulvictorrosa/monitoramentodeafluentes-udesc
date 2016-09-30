<?php
// setting header to json
header('Content-Type: application/json');

// database
$host = '127.0.0.1:3306'; 
$dbname = 'monitoramentodeafluentes';
$user = 'root';
$pass = 'root';

// get connection
try {
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);  
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  

	$db = $DBH;
}
catch(PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
	die();
}

// query to get data from the table
$sql = 'SELECT idEvento_dad, data, hora, dados, Sensor_codSensor FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora #LIMIT 20';
$STH = $db->prepare($sql);

//execute query
$STH->execute();
$STH->setFetchMode(PDO::FETCH_ASSOC);

//loop through the returned data
$data = array();
if (is_array($STH) || is_object($STH)) {
  foreach($STH as $row) {
		$data[] = $row;
	}
}

//now print the data
print json_encode($data);







// class DBConnection {
// 	function DBConnection() {
//     $host = '127.0.0.1:3306'; 
//     $dbname = 'monitoramentodeafluentes';
//     $user = 'root';
//     $pass = 'root';

//     try {
// 			$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);  
// 			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  

// 			return $DBH;
//     }
//     catch(PDOException $e) {
// 			echo 'ERROR: ' . $e->getMessage();
//     }
// 	}
// }

// function get_all() {
// 	$db = new DBConnection();

// 	$sql = 'SELECT idEvento_dad, data, hora, dados, Sensor_codSensor FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora #LIMIT 20';
// 	$STH = $db->prepare($sql);
// 	$STH->execute();
// 	$STH->setFetchMode(PDO::FETCH_ASSOC);

// 	return $STH;
// }

// echo get_all();
