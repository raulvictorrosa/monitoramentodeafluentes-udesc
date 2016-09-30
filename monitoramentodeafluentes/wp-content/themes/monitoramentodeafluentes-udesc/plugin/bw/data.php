<?php
/*$result = $wpdb->get_results('SELECT idEvento_dad, data, hora, dados, Sensor_codSensor FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" LIMIT 5;');
$data = array();
foreach($result as $row) {
	$data[] = $row;
};
$result->close();

print json_encode($data);*/

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '127.0.0.1:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'monitoramentodeafluentes');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf('SELECT idEvento_dad, data, hora, dados, Sensor_codSensor FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora #LIMIT 20');

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
if (is_array($result) || is_object($result)) {
  foreach($result as $row) {
		$data[] = $row;
	}
}
/*foreach($result as $row) {
	$data[] = $row;
}*/

//free memory associated with result
if ($result) {
	$result->close();
}

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
