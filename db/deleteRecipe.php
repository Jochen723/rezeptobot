<?php

header("Content-Type: application/json; charset=utf-8");
include 'db_verbindung.php';

try {
    // Create connection
    $conn = get_db_connection();
    mysqli_set_charset($conn, "utf8");

    // Check connection
    if ($conn->connect_error) {
        throw new Exception('Verbindung zur Datenbank nicht möglich!');
    }

    if (empty($_POST['rezeptId'])) { //RezeptId cannot be empty
        throw new Exception('Es wurde keine Rezept-ID übergeben.');
    }

    //Allgemeine Infos zum Rezept
    $rezeptId = $_POST['rezeptId'];

    deleteGeneralInformations($rezeptId, $conn);
    deleteIngredients($rezeptId, $conn);
    deleteCategories($rezeptId, $conn);
    //$categories = getCategories($rezeptId, $conn);
    $response_data = [];


    echo json_encode(array(
        'success' => true,
        'response' => $response_data
    ));

} catch (Exception $ex) {
    echo json_encode(array(
        'success' => false,
        'reason' => $ex->getMessage(),
    ));
}

function deleteGeneralInformations($rezeptId, $conn) {
    $sql = 'DELETE from rezept WHERE id = ' . $rezeptId;
    $result = $conn->query($sql);
}

function deleteIngredients($rezeptId, $conn) {
    $sql = 'DELETE from rezept_zutatenliste WHERE rezept_id = ' . $rezeptId;
    $result = $conn->query($sql);
}

function deleteCategories($rezeptId, $conn) {
    $sql = 'DELETE from rezept_kategorienliste WHERE rezept_id = ' . $rezeptId;
    $result = $conn->query($sql);
}

function deleteEvents($rezeptId, $conn) {
    $sql = 'DELETE from event WHERE rezept_id = ' . $rezeptId;
    $result = $conn->query($sql);
}

function getGeneralInformations($rezeptId, $conn)
{

    /*
    $sql = "SELECT * FROM rezept WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $rezeptId);
    $statement->execute();
    if (!$statement->execute()) {
        throw new Exception('Execute-Statement failed');
    }

    $result = $statement->get_result();
*/

    $sql = 'select * from rezept WHERE id = ' . $rezeptId;
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        return $row;
    }

    return null;
}

function getIngredients($rezeptId, $conn)
{
    $response = array();
    $sql = 'SELECT anzahl,zutat,einheit,zusatz,zutatenliste_id,einheit_id FROM rezept_zutatenliste INNER JOIN zutatenliste ON rezept_zutatenliste.zutatenliste_id = `zutatenliste`.id INNER JOIN einheitenliste ON rezept_zutatenliste.einheit_id = einheitenliste.id WHERE rezept_id = ' . $rezeptId;
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        array_push($response, $row);
    }

    return $response;
}

function getCategories($rezeptId, $conn)
{
    $response = array();
    $sql = 'SELECT * FROM kategorienliste INNER JOIN rezept_kategorienliste ON kategorienliste.id = rezept_kategorienliste.kategorien_id WHERE rezept_id = ' . $rezeptId;
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        array_push($response, $row);
    }

    return $response;
}

