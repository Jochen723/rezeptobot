 <?php
 header("Content-Type: text/html; charset=utf-8");

 include 'db_verbindung.php';

$empfaenger = "jonaskortum@googlemail.com";
$betreff = "Die Mail-Funktion";
$from = "From: Vorname Nachname <kortum@familie-kortum.com>";
$text = "Hier lernt Ihr, wie man mit PHP Mails verschickt";

mail($empfaenger, $betreff, $text, $from);

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


 $sql2 = 'SELECT anzahl,zutat,einheit,zusatz,zutatenliste_id,einheit_id FROM rezept_zutatenliste INNER JOIN zutatenliste ON rezept_zutatenliste.zutatenliste_id = `zutatenliste`.id INNER JOIN einheitenliste ON rezept_zutatenliste.einheit_id = einheitenliste.id WHERE rezept_id = ' . $appid;

	$json2 = [];

 $result2 = $conn->query($sql2);
 while($row2 = $result2->fetch_assoc()) {
     $json2[] = $row2;
 }

 $sql3 = 'SELECT * FROM kategorienliste INNER JOIN rezept_kategorienliste ON kategorienliste.id = rezept_kategorienliste.kategorien_id WHERE rezept_id = ' . $appid;

	$json3 = [];

 $result3 = $conn->query($sql3);
 while($row3 = $result3->fetch_assoc()) {
     $json3[] = $row3;
 }


 $jsonArray = [];

 array_push($jsonArray, $json);
 array_push($jsonArray, $json2);
 array_push($jsonArray, $json3);
 echo json_encode($jsonArray);
 $conn->close(); // finally, close the connection


?>
