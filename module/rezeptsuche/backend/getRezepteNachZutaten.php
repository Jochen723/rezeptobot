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
    $response = array();

    $sql = "SELECT one.rezept_id, rezept.bildpfad, rezept.titel, rezept.id";

    //


    $i = 1;
    foreach ($test->zutatenliste as $zutat) {
        if ($i == 1) {
            $sql = $sql . " FROM (SELECT * FROM `rezept_zutatenliste` WHERE zutatenliste_id = " . $zutat->zutat . ") AS one";
        } else {
            $sql = $sql . " INNER JOIN (SELECT * FROM `rezept_zutatenliste` WHERE zutatenliste_id = " . $zutat->zutat . ") AS one".$i." ON one.rezept_id = one".$i.".rezept_id";
        }
        $i++;

    }

    $sql = $sql . " INNER JOIN rezept ON one.rezept_id = rezept.id";

    $statement = $conn->prepare($sql);
    if ($statement->execute()) {
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
?>
