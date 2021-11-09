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

    $statement = $conn->prepare("SELECT event.rezept_id, rezept.titel, rezept.bildpfad FROM event INNER JOIN rezept ON event.rezept_id = rezept.id WHERE event.user_id = :user_id");
    if ($statement->execute($data)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))  {
            array_push($response, $row);
        }

        $count_array = array();

        for ($i=0; $i < count($response); $i++) {

            $tee = $response[$i]['rezept_id'];

            if (!isset($count_array[$tee]) || array_key_exists($count_array[$response[$i]['rezept_id']], $response) == false) {
                $count_array[$response[$i]['rezept_id']] = 1;
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

foreach ($count_array as $rezept) {
  $bike1 = new Motorcycle();
  $bike1->rezept_id = $rezept['rezept_id'];
  $bike1->anzahl = $rezept;
  $bike1->titel = 'Titel 1';
  $bike1->bildpfad = 'images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg';

  array_push($bikes, $bike1);

  // code...
}


for ($i=0; $i < count($count_array); $i++) {





}

/*
$bike1 = new Motorcycle();
$bike1->rezept_id = 60;
$bike1->anzahl = 2;
$bike1->titel = 'Titel 1';
$bike1->bildpfad = 'images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg';
$bike2 = new Motorcycle();
$bike2->rezept_id = 62;
$bike2->anzahl = 4;
$bike2->titel = 'Titel 2';
$bike2->bildpfad = 'images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg';
$bike3 = new Motorcycle();
$bike3->rezept_id = 64;
$bike3->anzahl = 3;
$bike3->titel = 'Titel 3';
$bike3->bildpfad = 'images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg';


$bikes = array($bike1, $bike2, $bike3);
*/
usort($bikes, "cmp");


    } else {
        throw new Exception($statement->errorInfo());
    }

    echo json_encode(array(
        'success' => true,
        'response' => $bikes
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
