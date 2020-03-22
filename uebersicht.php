<?php
    session_start();    // ALTE SESSION STARTEN
    if (!isset($_SESSION['userid'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rezeptobot - Übersicht</title>

        <!---Font Icon-->
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.min.css" rel="stylesheet">
        <link href="css/select2.min.css" rel="stylesheet">
        <link href="css/masken/uebersicht/uebersicht.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="favicon.ico" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/uebersicht.js"></script>

        <script>
            $(function(){
              $("#navigation").load("header.html");
              $("#footer").load("footer.html");
            });
        </script>
    </head>

    <body>
        <div id="navigation"></div>

        <!-- List Recipes -->
        <div class="list">
            <div class="container">
                <div id="rezeptliste" class="row">
                    <div class="col-lg-12">
                        <h5><i class="fa fa-cutlery" aria-hidden="true"></i>  von A bis Z</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div id="footer"></div>

        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">Made with <i class="fa fa-heart" aria-hidden="true"></i> &#8212; Copyright &copy; 2018 <a href="index.php">Grill -  Recipes & Food Blog Template</a>. All Rights Reserved.  </div>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="js/plugins/jquery.min.js"></script>
        <script src="js/plugins/popper.min.js"></script>
        <script src="js/plugins/bootstrap.min.js"></script>
        <script src="js/plugins/select2.min.js"></script>
        <script src="js/plugins/jquery-ui.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
