<!DOCTYPE html>
<html lang="en">

  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Grill - Homepage 1#</title>

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
        <script src="js/registrierung.js"></script>
    </head>

    <body>

    <!-- Featured Recipes-->
    <div class="featured" style="margin-top: -10px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <img id="recipe_image" src="logo/rezeptobot.png" alt="">
                    <h3>Rezeptobot</h3>
                </div>
                <div class="col-lg-8">
                    <div class="box grid recipes">
                        <div class="by" style="text-align: center;"><i class="fa" aria-hidden="true"></i> Registrieren</div>
                        <div class="content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label style="margin-top: 10px;">E-Mail</label>
                                            <input id="mail" type="text" class="form-control">
                                        </div>
                                    <div class="form-group">
                                        <label>Passwort</label>
                                        <input id="passwort" type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Passwort wiederholen</label>
                                        <input id="passwortWiederholen" type="password" class="form-control">
                                    </div>
                                    <a id="rezeptaendern" class="btn btn-regis" style="
                                        background-color: #363636;
                                        color: #fff;"> Registrieren
                                    </a>
                                    <a id="rezeptaendern" href="login.php" class="btn" style="
                                        background-color: #363636;
                                        color: #fff;"> Abbrechen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
