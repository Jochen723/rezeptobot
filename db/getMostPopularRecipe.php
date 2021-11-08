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

    $statement = $conn->prepare("SELECT * FROM event WHERE user_id = :user_id");
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

        $array = json_decode(json_encode($count_array), true);

    } else {
        throw new Exception($statement->errorInfo());
    }

    echo json_encode(array(
        'success' => true,
        'response' => $array
    ));

} catch (Exception $ex){
    echo json_encode(array(
        'success' => false,
        'reason'  => $ex->getMessage(),
    ));
}
?>
