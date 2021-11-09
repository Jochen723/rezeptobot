<?php
header("Content-type: application/json; charset=utf-8");

include 'db_verbindung_pdo.php';

 try {
     // Create connection
     $conn = get_db_connection();
     session_start();

     if (empty($_POST['event'])) {
         throw new Exception('Es wurden keine Daten übergeben.');
     }

     $test = json_decode($_POST['event']);

     $data = [
         'rezept_id' => $test->rezept_id,
         'user_id' => (int) $_SESSION['userid'],
         'kommentar' => $test->kommentar
     ];


     $sql = "INSERT INTO kommentare (rezept_id, user_id, kommentar) VALUES (:rezept_id, :user_id, :kommentar)";
     $statement = $conn->prepare($sql);
     $statement->execute($data);

     $data = [
         'user_id' => (int) $_SESSION['userid'],
     ];

     $response = array();
     $statement = $conn->prepare("SELECT * FROM user WHERE id = :user_id");
     if ($statement->execute($data)) {
         while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
             array_push($response, $row);
         }
     }

     echo json_encode(array(
         'success' => true,
         'response' => $response
     ));

 } catch (Exception $ex){
     echo json_encode(array(
         'success' => false,
         'reason'  => $ex->getMessage(),
     ));
 }
?>
