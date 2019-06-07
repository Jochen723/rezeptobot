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
$event_id = $test->event_id;

$query = "UPDATE event SET datum = '".$datum."' WHERE event_id = ".$event_id."; ";

$result = $conn->query($query);

 $conn->close(); // finally, close the connection


?> 