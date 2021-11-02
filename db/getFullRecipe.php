<?php
header("Content-type: application/json; charset=utf-8");
include 'db_verbindung_pdo.php';

try {
    // Create connection
    $conn = get_db_connection();

    if (empty($_GET['rezeptId'])) { //RezeptId cannot be empty
        throw new Exception('Es wurde keine Rezept-ID übergeben.');
    }

    //Allgemeine Infos zum Rezept
    $rezeptId= $_GET['rezeptId'];

    $generalInformations = getGeneralInformations($rezeptId, $conn);
    $ingredients = getIngredients($rezeptId, $conn);
    $categories = getCategories($rezeptId, $conn);

    echo json_encode(array(
        'generalInformations' => $generalInformations,
        'ingredients' => $ingredients,
        'categories' => $categories,
        'success' => true), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

} catch (Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}

function getGeneralInformations($rezeptId, $conn) {
    $response = array();
    $statement = $conn->prepare("SELECT * FROM rezept WHERE id = ?");
    if ($statement->execute(array($rezeptId))) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            $response = $row;
        }
    } else {
        throw new Exception($statement->errorInfo());
    }

    return $response;
}

function getIngredients($rezeptId, $conn) {
    $response = array();
    $statement = $conn->prepare("SELECT anzahl,zutat,einheit,zusatz,zutatenliste_id,einheit_id FROM rezept_zutatenliste INNER JOIN zutatenliste ON rezept_zutatenliste.zutatenliste_id = zutatenliste.id INNER JOIN einheitenliste ON rezept_zutatenliste.einheit_id = einheitenliste.id WHERE rezept_id = ?");
    if ($statement->execute(array($rezeptId))) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            array_push($response, $row);
        }
    } else {
        throw new Exception($statement->errorInfo());
    }

    return $response;
}

function getCategories($rezeptId, $conn) {
    $response = array();
    $statement = $conn->prepare("SELECT * FROM kategorienliste INNER JOIN rezept_kategorienliste ON kategorienliste.id = rezept_kategorienliste.kategorien_id WHERE rezept_id = ?");
    if ($statement->execute(array($rezeptId))) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            array_push($response, $row);
        }
    } else {
        throw new Exception($statement->errorInfo());
    }

    return $response;
}
?>
