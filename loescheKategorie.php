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

    <!---Font Icon-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.min.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/loeschekategoriescript.js"></script>
    <script>
        $(function(){
            $("#navigation").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>
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


                <!-- Javascript -->
                <script src="js/plugins/jquery.min.js"></script>
                <script src="js/plugins/popper.min.js"></script>
                <script src="js/plugins/bootstrap.min.js"></script>
                <script src="js/plugins/select2.min.js"></script>
                <script src="js/plugins/jquery-ui.js"></script>
                <script src="js/scripts.js"></script>
</body>
</html>
