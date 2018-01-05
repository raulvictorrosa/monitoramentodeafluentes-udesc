<?php
// database
error_reporting(E_ERROR | E_PARSE);
$host = '127.0.0.1:3306';
// $dbname = 'teste';
$dbname = 'monitoramentodeafluentes-teste';
$user = 'root';
$pass = 'root';

// get connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    if ($e->getCode() == 1045) {
        die('<div class="alert alert-danger" style="margin:1%;">'
            . 'Could not connect to the database. Set Database Username and Password in the file "/canvasjs/con-db.php"'
            . '<br><br>'
            . 'ERROR: ' . $e->getMessage()
        . '</div>');
    }
    if ($e->getCode() == 1049) {
        die('<div class="alert alert-danger" style="margin:1%;">'
            // . 'Required database does not exist. Please import the canvasjs_db.sql file in the downloaded zip package '
            . 'Required database does not exist.'
            // . '(<a href="https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-and-reset-a-root-password-in-mysql" target="_blank">Instructions to Import.</a>).'
            . '<br><br>'
            . 'ERROR: ' . $e->getMessage()
        . '</div>');
    }
}
