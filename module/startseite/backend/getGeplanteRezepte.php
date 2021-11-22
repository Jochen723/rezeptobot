<?php
header("Content-Type: text/html; charset=utf-8");

include '../../datenbankverbindung/db_verbindung_pdo.php';

try {
    // Create connection
    $conn = get_db_connection();

    session_start();
    $response = array();

    $data = [
        'user_id' => (int) $_SESSION['userid']
    ];

    $statement = $conn->prepare("SELECT event.rezept_id, rezept.titel, rezept.bildpfad FROM event INNER JOIN rezept ON event.rezept_id = rezept.id WHERE event.user_id = :user_id");
    if ($statement->execute($data)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            array_push($response, $row);
        }

        $count_array = array();
        $count_array_titel = array();
        $count_array_bildpfad = array();

        for ($i=0; $i < count($response); $i++) {

            $tee = $response[$i]['rezept_id'];

            if (!isset($count_array[$tee]) || array_key_exists($count_array[$response[$i]['rezept_id']], $response) == false) {
                $count_array[$response[$i]['rezept_id']] = 1;
                $count_array_titel[$response[$i]['rezept_id']] = $response[$i]['titel'];
                $count_array_bildpfad[$response[$i]['rezept_id']] = $response[$i]['bildpfad'];
            } else {
                $count_array[$response[$i]['rezept_id']] = $count_array[$response[$i]['rezept_id']] + 1;
            }
        }

        class Motorcycle
{
    public $rezept_id;
    public $anzahl;
    public $titel;
    public $bildpfad;
}

$bikes = array();

foreach ($count_array as $key => $value) {
  $bike1 = new Motorcycle();
  $bike1->rezept_id = $key;
  $bike1->anzahl = $value;
  $bike1->titel = $count_array_titel[$key];
  $bike1->bildpfad = $count_array_bildpfad[$key];

  array_push($bikes, $bike1);

}




usort($bikes, "cmp");


    } else {
        throw new Exception($statement->errorInfo());
    }

    echo json_encode(array(
        'success' => true,
        'response' => array_slice($bikes, 0, 3)
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
