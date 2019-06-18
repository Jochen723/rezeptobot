<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

include 'db_verbindung.php';

// Create connection
$conn = get_db_connection();
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Emp {
      public $nutzernameVorhanden = false;
      public $passwortKorrekt  = false;
   }

 $mail = $_GET['mail'];
 $pass = $_GET['pass'];

 $e = new Emp();

$query = "SELECT * FROM user WHERE email = '".$mail."'";
$result = $conn->query($query);
while($row = $result->fetch_assoc()) {
    $e->nutzernameVorhanden = true;
    if ( password_verify($pass, $row["passwort"])) {
      $e->passwortKorrekt = true;
      $_SESSION['userid'] = $row['id'];
      $_SESSION['mail'] = $row['email'];

    }
}


echo json_encode($e, JSON_UNESCAPED_UNICODE);


//echo json_encode($myObj, JSON_UNESCAPED_UNICODE);
$conn->close(); // finally, close the connection


?>
