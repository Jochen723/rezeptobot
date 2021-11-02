 <?php
 header("Content-Type: text/html; charset=utf-8");
 include 'db_verbindung.php';

 $logs = array();

 try {
     // Create connection
     $conn = get_db_connection();
     mysqli_set_charset($conn,"utf8");
     print_r('test');

     // Check connection
     if ($conn->connect_error) {
         throw new Exception('Verbindung zur Datenbank nicht möglich!');
     }

     if (empty($_GET['rezeptId'])) { //RezeptId cannot be empty
         throw new Exception('Es wurde keine Rezept-ID übergeben.');
     }

     //Allgemeine Infos zum Rezept
     $rezeptId= $_GET['rezeptId'];
     $generalInformations = getGeneralInformations($rezeptId, $conn);
     $ingredients = getIngredients($rezeptId, $conn);
     $categories = getCategories($rezeptId, $conn);

     $response_data = [];
     array_push($response_data, $generalInformations);
     array_push($response_data, $ingredients);
     array_push($response_data, $categories);
     $conn->close();

     echo json_encode(array(
         'success' => true,
         'response' => $response_data
     ));

 } catch (Exception $ex){
     echo json_encode(array(
         'success' => false,
         'reason'  => $ex->getMessage(),
     ));
 }

 function getGeneralInformations($rezeptId, $conn) {
     $response = [];
     $sql = "SELECT * FROM rezept WHERE id = ?";
     $statement = $conn->prepare($sql);
     $statement->bind_param('s', $rezeptId);
     if (!$statement->execute()) {
         throw new Exception('Execute-Statement failed');
     }

     $result = $statement->get_result();
     if (mysqli_num_rows($result) < 1) {
         throw new Exception('Es konnte kein Rezept zur ID ' . $rezeptId . ' gefunden werden!');
     } else {
         while($row = $result->fetch_object()) {
             $response[] = $row;
         }
     }

     return $response;
 }

 function getIngredients($rezeptId, $conn) {
     $response = [];
     $query = 'SELECT anzahl,zutat,einheit,zusatz,zutatenliste_id,einheit_id FROM rezept_zutatenliste INNER JOIN zutatenliste ON rezept_zutatenliste.zutatenliste_id = `zutatenliste`.id INNER JOIN einheitenliste ON rezept_zutatenliste.einheit_id = einheitenliste.id WHERE rezept_id = ' . $rezeptId;
     $logs['log2'] = $query;
     $result = $conn->query($query);
     while($row2 = $result->fetch_assoc()) {
         $response[] = $row2;
     }

     return $response;
 }

 function getCategories($rezeptId, $conn) {
     $response = [];
     $sql = "SELECT * FROM kategorienliste INNER JOIN rezept_kategorienliste ON kategorienliste.id = rezept_kategorienliste.kategorien_id WHERE rezept_id = ?";
     $statement = $conn->prepare($sql);
     $statement->bind_param('s', $rezeptId);
     if (!$statement->execute()) {
         throw new Exception('Execute-Statement failed');
     }

     $result = $statement->get_result();
     while($row = $result->fetch_object()) {
         $response[] = $row;
     }

     return $response;
 }
?>
