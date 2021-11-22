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
    <link href="../css/rezeptsuche.css" rel="stylesheet">

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
    <script src="../js/sucheNachZutat.js"></script>
</head>

<body>

<div id="navigation"></div>
<div class="submit">
    <div class="title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Suche nach Zutaten</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Zutaten</label>
                        <div class="form-group">
                            <div id="sortable">
                                <div id="zutatenreihe" class="box ui-sortable-handle">
                                    <div id="zutatenrow" class="row">
                                        <div id="zutatenzutat" class="col-lg-3 col-sm-3">
                                            <select class="form-control" id="zutatSelect1"></select>
                                        </div>
                                        <div class="col-lg-1 col-sm-1">
                                            <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light">Neue Zutat</a>
                        </div>
                        <button type="submit" class="btn btn-submit">Suche Rezepte</button>
                    </div>
                </div>
            </div>
            <!-- List Recipes -->
            <div class="list">
                <div class="container">
                    <div id="rezeptliste" class="row">
                        <div class="col-lg-12">
                            <h5><i class="fa fa-cutlery" aria-hidden="true"></i> von A bis Z</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div id="footer"></div>
</body>
</html>
