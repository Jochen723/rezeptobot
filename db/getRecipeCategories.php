<?php
header("Content-Type: text/html; charset=utf-8");
 include 'db_verbindung.php';
 include 'logfile.php';

 // Create connection
 $conn = get_db_connection();
   mysqli_set_charset($conn,"utf8");
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

$sql = 'select * from kategorienliste ORDER BY id ASC';

$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $json[] = $row;
}

echo json_encode($json);
$conn->close();

?>
