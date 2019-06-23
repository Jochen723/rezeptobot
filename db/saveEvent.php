 <?php
 session_start();
 header("Content-Type: text/html; charset=utf-8");

 include 'db_verbindung.php';

 // Create connection
 $conn = get_db_connection();
  mysqli_set_charset($conn,"utf8");
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 $json = $_POST['event'];

$test = json_decode($json);

$datum = $test->datum;
$titel = $test->titel;
$farbe = $test->farbe;
$rezept_id = $test->rezept_id;
$user_id = $_SESSION['userid'];



$query = "INSERT INTO event (datum,rezept_id,titel,farbe,user_id) VALUES ('".$datum."', ".$rezept_id.",'".$titel."','".$farbe."', ".$user_id.")";
echo $query;
$conn->query($query);

 $conn->close(); // finally, close the connection


?>
