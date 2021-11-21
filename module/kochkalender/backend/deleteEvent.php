<?php
 header("Content-Type: text/html; charset=utf-8");

 include '../../datenbankverbindung/db_verbindung.php';

 // Create connection
 $conn = get_db_connection();
  mysqli_set_charset($conn,"utf8");
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 $json = $_POST['event'];

$test = json_decode($json);

$datum = $test->event_id;

$query = "DELETE FROM event WHERE event_id = ".$datum."";
echo $query;
$conn->query($query);

 $conn->close(); // finally, close the connection


?>
