 <?php
 header("Content-Type: text/html; charset=utf-8");

 include 'db_verbindung.php';

 // Create connection
 $conn = get_db_connection();
  mysqli_set_charset($conn,"utf8");
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 $appid = $_GET['rezeptId'];
 $sql = 'select * from rezept WHERE id = ' . $appid;
 $result = $conn->query($sql);
 while($row = $result->fetch_assoc()) {
     $json[] = $row;
 }


 $sql2 = 'SELECT anzahl,zutat,einheit,zusatz FROM rezept_zutatenliste INNER JOIN zutatenliste ON rezept_zutatenliste.zutatenliste_id = `zutatenliste`.id INNER JOIN einheitenliste ON rezept_zutatenliste.einheit_id = einheitenliste.id WHERE rezept_id = ' . $appid;

	$json2 = [];

 $result2 = $conn->query($sql2);
 while($row2 = $result2->fetch_assoc()) {
     $json2[] = $row2;
 }


 $jsonArray = [];

 array_push($jsonArray, $json);
 array_push($jsonArray, $json2);
 echo json_encode($jsonArray);
 $conn->close(); // finally, close the connection


?>
