<?php
// setting header to json
header('Content-Type: application/json');

// database
$host = '127.0.0.1:3306'; 
$dbname = 'teste';
$user = 'root';
$pass = 'root';

// get connection
try {
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);  
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}
catch(PDOException $e) {
  if ($e->getCode() == 1045) {
    die('<div class="alert alert-danger" style="margin:1%;">'
      . 'Could not connect to the database. Set Database Username and Password in the file "/how-to/data-from-database.php"'
      . '<br><br>'
      . 'ERROR: ' . $e->getMessage()
    . '</div>');
  }
  if ($e->getCode() == 1049) {
    die('<div class="alert alert-danger" style="margin:1%;">'
      . 'Required database does not exist. Please import the canvasjs_db.sql file in the downloaded zip package '
      . '(<a href="https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-and-reset-a-root-password-in-mysql" target="_blank">Instructions to Import.</a>).'
      . '<br><br>'
      . 'ERROR: ' . $e->getMessage()
    . '</div>');
  }
}

// query to get data from the table
$sql = 'SELECT id, data, hora, dados, cod FROM `' . $dbname . '`.`profundidade` WHERE cod = "UL0" ORDER BY data, hora';
$STH = $DBH->prepare($sql);

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
