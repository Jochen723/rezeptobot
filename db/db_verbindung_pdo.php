<?php

function get_db_connection() {

/*
$servername = "rdbms.strato.de";
$username = "U3698553";
$password = "pauli1992!";
$dbname = "DB3698553";
*/


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rezeptobot";

// Create connection
    try {
        $connectionString = 'mysql:host='.$servername.';dbname='.$dbname.'';
        $pdo = new PDO($connectionString, $username, $password);
        $pdo->exec('SET CHARACTER SET utf8');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
return $pdo;
}
