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

$appid = $_GET['rezeptId'];
$sql = 'SELECT rezept.titel, rezept.id, rezept.bildpfad FROM `rezept_kategorienliste` AS one INNER JOIN rezept as rezept ON one.rezept_id = rezept.id WHERE kategorien_id = ' . $appid . ' ORDER BY rezept.titel ASC';

$result = $conn->query($sql);

$json = null;

while($row = $result->fetch_assoc()) {
    $json[] = $row;
}

echo json_encode($json);
$conn->close();

?>
