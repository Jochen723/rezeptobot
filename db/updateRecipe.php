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
$kategorienliste = $test->kategorienliste;
$rezept_id = $test->rezept_id;

$bildpfad = '';


$query = "UPDATE rezept SET titel = '".$titel."',durchfuehrung = '".$durchfuehrung."', anzahlPortionen = ".$anzahlPortionen.",einheit='".$einheit."',kochzeit='".$kochzeit."',vorbereitungszeit='".$vorbereitungszeit."' WHERE id = " . $rezept_id;

$result = $conn->query($query);
 $last_insert = $conn->insert_id;

 $queryDel = "DELETE FROM rezept_zutatenliste WHERE rezept_id = " . $rezept_id;
 echo $queryDel;
 $conn->query($queryDel);


foreach ($zutatenliste as &$zutat) {
  $anzahl = $zutat->anzahl;
  if ($anzahl == '') {
    $anzahl = 'NULL';
  }
    $zutatsql = "INSERT INTO rezept_zutatenliste (rezept_id, zutatenliste_id, anzahl, einheit_id, zusatz) VALUES (".$rezept_id.",".$zutat->zutat.",".$anzahl.",".$zutat->einheit.", '".$zutat->zusatz."')";
    $conn->query($zutatsql);
}

foreach ($kategorienliste as &$kategorie) {
    $kategoriesql = "INSERT INTO rezept_kategorienliste (rezept_id, kategorien_id) VALUES (".$rezept_id.",".$kategorie->id.")";
  //$conn->query($kategoriesql);
}






 $conn->close(); // finally, close the connection


?>
