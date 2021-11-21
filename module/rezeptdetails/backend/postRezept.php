<?php
 header("Content-Type: text/html; charset=utf-8");

 include '../../datenbankverbindung/db_verbindung_pdo.php';

 try {
     // Create connection
     $conn = get_db_connection();

     if (empty($_POST['event'])) {
         throw new Exception('Es wurden keine Daten übergeben.');
     }

     //$jsonobj = '{"titel":"a0511","durchfuehrung":"","anzahlPortionen":0,"einheit":"Portionen","kochzeit":"","vorbereitungszeit":"","zutatenliste":[{"anzahl":"1","einheit":"8","zutat":"158","zusatz":""}],"kategorienliste":{"id":"1"}}';

     $test = json_decode($_POST['event']);
     $kategorienliste = $test->kategorienliste;
     $bildpfad = '';

     $data = [
         'titel' => $test->titel,
         'durchfuehrung' => $test->durchfuehrung,
         'anzahlPortionen' => $test->anzahlPortionen,
         'einheit' => $test->einheit,
         'kochzeit' => $test->kochzeit,
         'vorbereitungszeit' => $test->vorbereitungszeit,
         'bildpfad' => $bildpfad
     ];

     $sql = "INSERT INTO rezept (titel, durchfuehrung, anzahlPortionen, einheit, kochzeit, vorbereitungszeit, bildpfad)
        VALUES(:titel, :durchfuehrung, :anzahlPortionen, :einheit, :kochzeit, :vorbereitungszeit, :bildpfad)";
     $statement = $conn->prepare($sql);
     $statement->execute($data);
     $new_id = $conn->lastInsertId();

     if (empty($new_id)) {
         throw new Exception('Speichern fehlgeschlagen');
     }

     foreach ($test->zutatenliste as $zutat) {
         $anzahl = $zutat->anzahl;
         if ($anzahl == '') {
             $anzahl = 'NULL';
         }

         $data = [
             'rezept_id' => $new_id,
             'zutatenliste_id' => $zutat->zutat,
             'anzahl' => $anzahl,
             'einheit_id' => $zutat->einheit,
             'zusatz' => $zutat->zusatz
         ];


         $sql = "INSERT INTO rezept_zutatenliste (rezept_id, zutatenliste_id, anzahl, einheit_id, zusatz) VALUES (:rezept_id, :zutatenliste_id, :anzahl, :einheit_id, :zusatz)";
         $statement = $conn->prepare($sql);
         $statement->execute($data);
     }

     foreach ($kategorienliste as $kategorie) {

         $data = [
             'rezept_id' => $new_id,
             'kategorien_id' => $kategorie->id
         ];

         $sql = "INSERT INTO rezept_kategorienliste (rezept_id, kategorien_id) VALUES (:rezept_id, :kategorien_id)";
         $statement = $conn->prepare($sql);
         $statement->execute($data);
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
