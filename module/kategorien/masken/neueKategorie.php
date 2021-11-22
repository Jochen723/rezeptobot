<?php
session_start();    // ALTE SESSION STARTEN
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rezeptobot - neues Rezept</title>

    <link href="../../../css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/styles.min.css" rel="stylesheet">
    <link href="../../../css/select2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.ico" />
    <link href="../css/kategorien.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../../js/plugins/jquery.min.js"></script>
    <script src="../../../js/plugins/popper.min.js"></script>
    <script src="../../../js/plugins/bootstrap.min.js"></script>
    <script src="../../../js/plugins/select2.min.js"></script>
    <script src="../../../js/plugins/jquery-ui.js"></script>
    <script src="../../../js/scripts.js"></script>
    <script type='text/javascript' src='../../../js/jquery.js'></script>
    <script type='text/javascript' src='../../../js/moment.min.js'></script>
    <script type='text/javascript' src='../../../js/fullcalendar.js'></script>
    <script>
        $(function(){
          $("#navigation").load("../../allgemein/header.php");
          $("#footer").load("../../allgemein/footer.html");
        });
    </script>
    <script src="../js/neueKategorie.js"></script>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid justify-content-center">
        <a class="navbar-brand" href="index.php"><i class="fa fa-cutlery" aria-hidden="true"></i>  Rezeptobot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                <span class="navbar-text">
                    <?php if(isset($_SESSION['mail'])) {echo $_SESSION['mail'];}?>
                </span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="eventkalender.php">Kalender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uebersicht.php">Von A - Z</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item btn-submit-recipe">
                    <a class="nav-link" href="neuesrezept.php"><i class="fa fa-upload" aria-hidden="true"></i> neues Rezept</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="submit">
    <div class="title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Neue Kategorie hinzufügen</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Titel der Kategorie</label>
                        <input id="kategorietitel" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-submit">Kategorie speichern</button>
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fehlende Eingaben</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modalbody"class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
</body>
</html>
