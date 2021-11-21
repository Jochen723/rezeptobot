<?php
header("Content-type: application/json; charset=utf-8");
include '../../datenbankverbindung/db_verbindung_pdo.php';

try {
    // Create connection
    $conn = get_db_connection();

    $test = json_decode($_POST['event']);

    setChangedGeneralInformations($test, $conn);
    setChangedIngridients($test, $conn);
    setChangedCategories($test, $conn);

    echo json_encode(array(
        'success' => true), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

} catch (Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}

function setChangedGeneralInformations($test, $conn) {

    $data = [
        'id' => $test->id,
        'titel' => $test->titel,
        'durchfuehrung' => $test->durchfuehrung,
        'anzahlPortionen' => $test->anzahlPortionen,
        'einheit' => $test->einheit,
        'kochzeit' => $test->kochzeit,
        'vorbereitungszeit' => $test->vorbereitungszeit
    ];

    $statement = $conn->prepare("UPDATE rezept SET titel=:titel, durchfuehrung=:durchfuehrung,
                                anzahlPortionen=:anzahlPortionen, einheit=:einheit, kochzeit=:kochzeit,
                                vorbereitungszeit=:vorbereitungszeit WHERE id =:id");
    $statement->execute($data);
}

function setChangedIngridients($test, $conn) {
    $statement = $conn->prepare("DELETE FROM rezept_zutatenliste WHERE rezept_id = ?");
    $statement->execute(array($test->id));

foreach ($test->zutatenliste as $zutat) {
    $anzahl = $zutat->anzahl;
    if ($anzahl == '') {
        $anzahl = 'NULL';
    }

    $data = [
        'rezept_id' => (int) $test->id,
        'zutatenliste_id' => (int) $zutat->zutat,
        'anzahl' => $anzahl,
        'einheit_id' => (int)$zutat->einheit,
        'zusatz' => $zutat->zusatz
    ];

    $sql = "INSERT INTO rezept_zutatenliste (rezept_id, zutatenliste_id, anzahl, einheit_id, zusatz) VALUES (:rezept_id, :zutatenliste_id, :anzahl, :einheit_id, :zusatz)";
    $statement = $conn->prepare($sql);
    $statement->execute($data);
}




}

function setChangedCategories($test, $conn) {
    $statement = $conn->prepare("DELETE FROM rezept_kategorienliste WHERE rezept_id = ?");
    $statement->execute(array($test->id));

    foreach ($test->kategorienliste as $kategorie) {

        $data = [
            'rezept_id' => (int) $test->id,
            'kategorien_id' => (int) $kategorie->id
        ];


        $sql = "INSERT INTO rezept_kategorienliste (rezept_id, kategorien_id) VALUES (:rezept_id, :kategorien_id)";
        $statement = $conn->prepare($sql);
        $statement->execute($data);
    }




}

?>
