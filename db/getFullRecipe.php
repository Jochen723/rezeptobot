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
    $events = getEvents($rezeptId, $conn);
    $comments = getComments($rezeptId, $conn);

    echo json_encode(array(
        'generalInformations' => $generalInformations,
        'ingredients' => $ingredients,
        'categories' => $categories,
        'events' => $events,
        'comments' => $comments,
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

function getEvents($rezeptId, $conn) {
    session_start();
    $response = array();

    $data = [
        'rezept_id' => (int) $rezeptId,
        'user_id' => (int) $_SESSION['userid']
    ];

    $statement = $conn->prepare("SELECT * FROM event WHERE rezept_id = :rezept_id AND user_id = :user_id");
    if ($statement->execute($data)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            array_push($response, $row);
        }
    } else {
        throw new Exception($statement->errorInfo());
    }

    return $response;
}

function getComments($rezeptId, $conn) {
  $response = array();

  $data = [
      'rezept_id' => (int) $rezeptId,
      'user_id' => (int) $_SESSION['userid']
  ];

  $statement = $conn->prepare("SELECT kommentare.rezept_id, kommentare.kommentar, kommentare.hinzugefuegt, user.email FROM kommentare INNER JOIN user ON kommentare.user_id = user.id WHERE rezept_id = :rezept_id AND user_id = :user_id");
  if ($statement->execute($data)) {
      while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
          array_push($response, $row);
      }
  } else {
      throw new Exception($statement->errorInfo());
  }

  return $response;
}
?>
