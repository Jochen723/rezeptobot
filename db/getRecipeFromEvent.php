<?php
session_start();
$name = $_SESSION['userid'];

 header('Content-Type: application/json; charset=utf-8');

 include 'db_verbindung.php';

 // Create connection
 $conn = get_db_connection();
 mysqli_set_charset($conn,"utf8");
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
$json = [];

$appid = $_GET['event_id'];

 $sql = 'SELECT event.datum, rezept.titel, event.event_id, rezept.bildpfad, rezept.id FROM event as event INNER JOIN rezept as rezept ON event.rezept_id = rezept.id WHERE event.event_id = ' . $appid;
 $result = $conn->query($sql);
 while($row = $result->fetch_assoc()) {
     $json[] = $row;
 }

 echo json_encode($json, JSON_UNESCAPED_UNICODE);
 $conn->close(); // finally, close the connection

?>
