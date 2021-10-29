<?php
 header("Content-Type: text/html; charset=utf-8");

 include 'db_verbindung.php';

 try {
     // Create connection
     $conn = get_db_connection();
     mysqli_set_charset($conn,"utf8");

     // Check connection
     if ($conn->connect_error) {
         throw new Exception('Verbindung zur Datenbank nicht möglich!');
     }

     if (empty($_POST['event'])) {
         throw new Exception('Es wurden keine Daten übergeben.');
     }

     $test = json_decode($_POST['event']);
     $kategorienliste = $test->kategorienliste;
     $bildpfad = '';

     $sql = "INSERT INTO rezept (titel, durchfuehrung, anzahlPortionen, einheit, kochzeit, vorbereitungszeit, bildpfad) 
        VALUES(?, ?, ?, ?, ?, ?, ?)";
     $statement = $conn->prepare($sql);
     $statement->bind_param('sssssss', $test->titel, $test->durchfuehrung, $test->anzahlPortionen,
         $test->einheit, $test->kochzeit, $test->vorbereitungszeit, $bildpfad);
     if (!$statement->execute()) {
         throw new Exception('Execute-Statement failed');
     }
     $new_id = $statement->insert_id;

     if (empty($new_id)) {
         throw new Exception('Speichern fehlgeschlagen');
     }

     foreach ($test->zutatenliste as $zutat) {
         $anzahl = $zutat->anzahl;
         if ($anzahl == '') {
             $anzahl = 'NULL';
         }

         $sql = "INSERT INTO rezept_zutatenliste (rezept_id, zutatenliste_id, anzahl, einheit_id, zusatz) VALUES (?, ?, ?, ?, ?)";
         $statement = $conn->prepare($sql);
         $statement->bind_param('sssss', $new_id, $zutat->zutat, $anzahl,
             $zutat->einheit, $zutat->zusatz);
         if (!$statement->execute()) {
             throw new Exception('Execute-Statement failed');
         }
     }

     foreach ($kategorienliste as $kategorie) {
         $sql = "INSERT INTO rezept_kategorienliste (rezept_id, kategorien_id) VALUES ?, ?";
         $statement = $conn->prepare($sql);
         $statement->bind_param('ss', $new_id, $kategorie->id);
         if (!$statement->execute()) {
             throw new Exception('Execute-Statement failed');
         }
     }

     echo json_encode(array(
         'success' => true,
         'response' => ''
     ));

 } catch (Exception $ex){
     echo json_encode(array(
         'success' => false,
         'reason'  => $ex->getMessage(),
     ));
 }
?>
