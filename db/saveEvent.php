 <?php
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
$essen_id = $test->essen_id;
$titel = $test->titel;
$farbe = $test->farbe;

$query = "INSERT INTO event (datum,rezept_id,titel,farbe) VALUES ('".$datum."', ".$essen_id.",'".$titel."','".$farbe."')";
echo $query;
$conn->query($query);

 $conn->close(); // finally, close the connection


?>
