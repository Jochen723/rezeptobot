 <?php
 header('Content-Type: application/json; charset=utf-8');

 include '../../datenbankverbindung/db_verbindung.php';

 // Create connection
 $conn = get_db_connection();
 mysqli_set_charset($conn,"utf8");
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }



 $sql = 'select * from zutatenliste ORDER BY zutat ASC';
 $result = $conn->query($sql);
 while($row = $result->fetch_assoc()) {
     $json[] = $row;
 }

 echo json_encode($json, JSON_UNESCAPED_UNICODE);
 $conn->close(); // finally, close the connection


?>
