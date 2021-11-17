<?php
header("Content-Type: text/html; charset=utf-8");

include 'db_verbindung_pdo.php';

try {
    // Create connection
    $conn = get_db_connection();

    session_start();
    $response = array();

    $data = [
        'user_id' => (int) $_SESSION['userid']
    ];

    $statement = $conn->prepare("SELECT * FROM event INNER JOIN rezept ON event.rezept_id = rezept.id WHERE event.user_id = :user_id AND datum >= CURRENT_TIMESTAMP ORDER BY datum LIMIT 3");
    if ($statement->execute($data)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            array_push($response, $row);
        }
    } else {
        throw new Exception($statement->errorInfo());
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

function cmp($a, $b) {
    return strcmp($b->anzahl, $a->anzahl);
}


?>
