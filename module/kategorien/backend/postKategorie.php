<?php
 header("Content-Type: text/html; charset=utf-8");

 include '../../datenbankverbindung/db_verbindung_pdo.php';

 try {
     // Create connection
     $conn = get_db_connection();

     if (empty($_POST['event'])) {
         throw new Exception('Es wurden keine Daten übergeben.');
     }

     $test = json_decode($_POST['event']);

     $data = [
         'kategorie' => $test->kategorie,
         'bildpfad' => ''
     ];


     $sql = "INSERT INTO kategorienliste (kategorie, bildpfad) VALUES (:kategorie, :bildpfad)";
     $statement = $conn->prepare($sql);
     $statement->execute($data);

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
