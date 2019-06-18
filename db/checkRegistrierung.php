<?php
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
      public $name = "";
      public $hobbies  = "";
      public $birthdate = "";
   }

 $mail = $_GET['mail'];
 $pass = $_GET['pass'];

 $e = new Emp();
 $e->vorhanden = false;

$query = "SELECT * FROM user WHERE email = '".$mail."'";
$result = $conn->query($query);
while($row = $result->fetch_assoc()) {
    $e->vorhanden = true;

}

if ($e->vorhanden == false) {
  $passwort_hash = password_hash($pass, PASSWORD_DEFAULT);

  if ( password_verify($pass, $passwort_hash)) {
    $query = "INSERT INTO user (email, passwort) VALUES ('".$mail."','".$passwort_hash."')";
    $result = $conn->query($query);
  }
}


   echo json_encode($e, JSON_UNESCAPED_UNICODE);


//echo json_encode($myObj, JSON_UNESCAPED_UNICODE);
$conn->close(); // finally, close the connection


?>
