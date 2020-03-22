<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rezeptobot - Login</title>

        <!---Font Icon-->
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.min.css" rel="stylesheet">
        <link href="css/select2.min.css" rel="stylesheet">
        <link href="css/masken/login/login.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="favicon.ico" />
    </head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type = "text/javascript" language = "javascript">

    </script>

    <body>

        <!-- Featured Recipes-->
        <div class="featured">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <img id="recipe_image" src="logo/rezeptobot.png" alt="">
                        <h3>Rezeptobot</h3>
                    </div>
                    <div class="col-lg-8">
                        <div class="box grid recipes">
                            <div class="by" style="text-align: center;"><i class="fa" aria-hidden="true"></i> Login</div>
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

                                            <a id="rezeptaendern" class="btn btn-login" style="
                                                background-color: #363636;
                                                color: #fff;"> Login
                                            </a>
                                            <a id="rezeptaendern" href="registrierung.php" class="btn" style="
                                                background-color: #363636;
                                                color: #fff;"> Registrieren
                                            </a>
                                        </div>
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

    <script src="js/login.js"></script>

  </body>
</html>
