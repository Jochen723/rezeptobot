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
    <script src="../js/neuesRezept.js"></script>
</head>

<body>

    <!-- Navigation -->
    <div id="navigation"></div>
    <div class="submit">
        <div class="title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Neues Rezept hinzufügen</h2>
                    </div>
                </div>
            </div>
        </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Titel des Rezepts</label>
                        <input id="rezepttitel" type="text" class="form-control"">
                    </div>
                    <div class="form-group">
                        <label>Kategorien</label>
                        <div id="sortable2">
                            <div id="kategoriereihe" class="box ui-sortable-handle">
                                <div id="kategorierow" class="row">
                                    <div class="col-lg-2 col-sm-2">
                                        <i class="fa fa-arrows" aria-hidden="true"></i>
                                    </div>
                                    <div id="kategorieinstanz" class="col-lg-8 col-sm-8">
                                        <select class="form-control" id="kategorieSelect1"></select>
                                    </div>
                                    <div class="col-lg-2 col-sm-2">
                                        <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-light2" style="
                                background-color: #363636;
                                color: #fff;">Weitere Kategorie
                        </a>
                        <br>
                        <br>
                        <div class="form-group">
                            <label>Zutaten:</label>
                            <div id="sortable">
                                <div id="zutatenreihe" class="box ui-sortable-handle">
                                    <div id="zutatenrow" class="row">
                                        <div class="col-lg-1 col-sm-1">
                                            <i class="fa fa-arrows" aria-hidden="true"></i>
                                        </div>
                                        <div id="zutatenanzahl" class="col-lg-1 col-sm-1">
                                            <label for="sel2">Anzahl:</label>
                                            <input type="text" class="form-control" id="anzahlSelect1">
                                        </div>
                                        <div id="zutateneinheit" class="col-lg-3 col-sm-3">
                                            <label for="sel2">Einheit:</label>
                                            <select class="form-control" id="einheitSelect1"></select>
                                        </div>
                                        <div id="zutatenzutat" class="col-lg-3 col-sm-3">
                                            <label for="sel2">Zutat:</label>
                                            <select class="form-control" id="zutatSelect1"></select>
                                        </div>
                                        <div id="zutatenzusatz" class="col-lg-3 col-sm-3">
                                            <label for="sel2">Zusatz:</label>
                                            <input type="text" class="form-control" id="zusatzSelect1">
                                        </div>
                                        <div class="col-lg-1 col-sm-1">
                                            <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-light">Neue Zutat</a>
                        </div>
                        <div class="form-group">
                            <label>Durchführung:</label>
                            <textarea id="durchfuehrung" class="form-control" rows="4" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Zusätzliche Informationen</label>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Portionen</label>
                            <div class="col-sm-10">
                                <input id="anzahlPortionen" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vorbereitungszeit</label>
                            <div class="col-sm-10">
                                <input id="vorbereitungszeit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kochzeit</label>
                            <div class="col-sm-10">
                                <input id="kochzeit" type="text" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">Rezept speichern</button>
                    </div>
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
