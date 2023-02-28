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

    if (null == $mail) {
        //createLog('Email-Adresse wurde nicht übergeben.');

    } else if (null == $pass) {
        //createLog('Passwort wurde nicht übergeben.');
    } else {
        $e = new Emp();

        //createLog('LOGIN ' . mysqli_real_escape_string($conn, $mail));
        $query = 'SELECT * FROM user WHERE email = \'' . mysqli_real_escape_string($conn, $mail) . '\'';
        //createLog($query);

        $result = $conn->query($query);

        while($row = $result->fetch_assoc()) {
            $e->nutzernameVorhanden = true;
            //createLog('Benutzername ' . $mail . ' ist vorhanden.');

            if ( password_verify($pass, $row["passwort"])) {
                $e->passwortKorrekt = true;
                $_SESSION['userid'] = $row['id'];
                $_SESSION['mail'] = $row['email'];
                //createLog('Passwort für Benutzername ' . $mail . ' ist korrekt.');
            } else {
                //createLog('Passwort für Benutzername ' . $mail . ' ist falsch.');
            }
        }
    }

    echo json_encode($e, JSON_UNESCAPED_UNICODE);


    //echo json_encode($myObj, JSON_UNESCAPED_UNICODE);
    $conn->close(); // finally, close the connection
?>
