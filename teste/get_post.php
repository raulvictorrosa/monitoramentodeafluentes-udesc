<?php
//just to display raw values
// echo "<pre>";
// print_r($_POST);
// print_r("<br>");
// echo "</pre>";
 
//access the values
foreach($_POST['dados'] as $row){}

// database
$host = '127.0.0.1:3306'; 
$dbname = 'teste';
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
$i = 0;
$sql = 'INSERT INTO `' . $dbname . '`.`profundidade` SET data = "'.$row['data'].'", hora = "'.$row['hora'].'", dados = "'.$row['dado'].'", cod = "'.$row['cod'].'"';
// $sql = 'SELECT id, data, hora, dado, cod FROM `' . $dbname . '`.`profundidade` WHERE cod = "UL0" ORDER BY data, hora';
$STH = $db->prepare($sql);

//execute query
$STH->execute();
$STH->setFetchMode(PDO::FETCH_ASSOC);
