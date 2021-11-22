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
    <script src="../js/loescheKategorie.js"></script>
</head>

<body>

<div id="navigation"></div>
<div class="submit">
    <div class="title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Kategorie löschen</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Kategorien</label>
                        <div id="sortable2">
                            <div id="kategoriereihe" class="box ui-sortable-handle">
                                <div id="kategorierow" class="row">
                                    <div id="kategorieinstanz" class="col-lg-8 col-sm-8">
                                        <select class="form-control" id="kategorieSelect1"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">Kategorie löschen</button>
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
</body>
</html>
