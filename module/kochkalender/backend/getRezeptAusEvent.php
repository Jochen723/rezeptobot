<?php
header("Content-type: application/json; charset=utf-8");
include '../../datenbankverbindung/db_verbindung_pdo.php';

try {
    // Create connection
    $conn = get_db_connection();

    if (empty($_GET['event_id'])) { //RezeptId cannot be empty
        throw new Exception('Es wurde keine Event-ID übergeben.');
    }

    $eventId= $_GET['event_id'];
    $responseEvent = array();
    $responseRezept = array();

    $sql = 'SELECT * FROM event WHERE event_id = ?';

    $statement = $conn->prepare($sql);
    if ($statement->execute(array((int)$eventId))) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            $responseEvent = $row;
        }
    } else {
        throw new Exception($statement->errorInfo());
    }

    if (strcmp($responseEvent['rezept_id'], '0') !== 0) {
        $sql2 = 'SELECT id, titel, bildpfad FROM rezept WHERE id = ?';
        $statement2 = $conn->prepare($sql2);
        $test2 = (int)$responseEvent['rezept_id'];
        if ($statement2->execute(array($test2))) {
            while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC))  {
                $responseRezept = $row2;
            }
        } else {
            throw new Exception($statement2->errorInfo());
        }

    }

    echo json_encode(array(
        'event' => $responseEvent,
        'recipe' => $responseRezept,
        'success' => true), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

} catch (Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}
?>
