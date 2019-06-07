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

  $json = $_POST['event'];

$test = json_decode($json);
 $titel = $test->titel;
$durchfuehrung = $test->durchfuehrung;
$anzahlPortionen = $test->anzahlPortionen;
$einheit = $test->einheit;
$kochzeit = $test->kochzeit;
$vorbereitungszeit = $test->vorbereitungszeit;
$zutatenliste = $test->zutatenliste;

$bildpfad = '';

$query = "INSERT INTO rezept (titel, durchfuehrung, anzahlPortionen, einheit, kochzeit, vorbereitungszeit, bildpfad) VALUES ('".$titel."', '".$durchfuehrung."', ".$anzahlPortionen.",'".$einheit."','".$kochzeit."','".$vorbereitungszeit."','".$bildpfad."')";
echo $query;

$result = $conn->query($query);
 $last_insert = $conn->insert_id;



foreach ($zutatenliste as &$zutat) {
  $anzahl = $zutat->anzahl;
  if ($anzahl == '') {
    $anzahl = 'NULL';
  }
    $zutatsql = "INSERT INTO rezept_zutatenliste (rezept_id, zutatenliste_id, anzahl, einheit_id, zusatz) VALUES (".$last_insert.",".$zutat->zutat.",".$anzahl.",".$zutat->einheit.", '".$zutat->zusatz."')";

  $conn->query($zutatsql);
}






 $conn->close(); // finally, close the connection


?>
