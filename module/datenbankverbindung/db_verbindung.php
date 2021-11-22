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
$conn = new mysqli($servername, $username, $password, $dbname);

return $conn;
}
