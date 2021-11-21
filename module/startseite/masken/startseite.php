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

        <title>Rezeptobot - Home</title>

        <!---Font Icon-->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet">
        <link href="../../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../../css/styles.min.css" rel="stylesheet">
        <link href="../../../css/select2.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="favicon.ico" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../../../js/plugins/jquery.min.js"></script>
        <script src="../../../js/plugins/popper.min.js"></script>
        <script src="../../../js/plugins/bootstrap.min.js"></script>
        <script src="../../../js/plugins/select2.min.js"></script>
        <script src="../../../js/plugins/jquery-ui.js"></script>
        <script src="../../../js/scripts.js"></script>
        <script>
            $(function(){
              $("#navigation").load("../../allgemein/header.php");
              $("#footer").load("../../allgemein/footer.html");
            });
        </script>
        <script src="../js/startseite.js"></script>
    </head>

    <body>

        <!-- Navigation -->
        <div id="navigation"></div>




        <!-- Carousel -->
        <!--
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="images/879716-420x280-fix-nudel-kasseler-pfanne-mit-wirsing700x350.jpg" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption text-left">
                            <h1><a href="recipe-detail.html">Das Rezept des Tages</a></h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="recipe-detail.php?q=42" role="button">Zum Rezept</a></p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="second-slide" src="images/recipe2-1920x600.jpg" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1><a href="recipe-detail.html">Spanish Mac & Cheese</a></h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="recipe-detail.html" role="button">Read more</a></p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="third-slide" src="images/recipe3-1920x600.jpg" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1><a href="recipe-detail.html">Skillet Scalloped Potatoes</a></h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="recipe-detail.html" role="button">Read more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="third-slide" src="images/Himbeer_Fool_0.jpg" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1><a href="recipe-detail.html">Skillet Scalloped Potatoes</a></h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="recipe-detail.html" role="button">Read more</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        -->

        <!-- Top Recipes -->
        <center>
          <img src="../../../logo/rezeptobot.png" alt="rezeptobot" style="height:100%;" />
        </center>
        <div class="top">

            <div class="container">
                <h5><i class="fa fa-cutlery" aria-hidden="true"></i> Deine geplanten Rezepte</h5>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box clearfix">
                            <h6 align="center">03.06.2019</h6>
                            <a href="recipe-detail.html"><img src="../../../images/Himbeer_Fool_0.jpg" alt=""></a>
                            <h3><a href="../../rezeptdetails/masken/rezeptdetails.php">Himbeer-Fool</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box clearfix">
                            <h6 align="center">03.06.2019</h6>
                            <a href="recipe-detail.html"><img src="../../../images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg" alt=""></a>
                            <h3><a href="../../rezeptdetails/masken/rezeptdetails.php">Brokkoli - Schinken - Quiche</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box clearfix">
                            <h6 align="center">03.06.2019</h6>
                            <a href="recipe-detail.html"><img src="../../../images/Himbeer_Fool_0.jpg" alt=""></a>
                            <h3><a href="../../rezeptdetails/masken/rezeptdetails.php">Hähnchenbrustfilet mit Country-Kartoffeln
                                </a></h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Top Recipes -->
        <div class="top">
            <div class="container">
                <h5><i class="fa fa-cutlery" aria-hidden="true"></i> Deine aktuellen Lieblingsrezepte</h5>
                <div class="row" id="mostPopular">
                </div>

            </div>
        </div>
        <!--
        <div class="list">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h5><i class="fa fa-cutlery" aria-hidden="true"></i>  List Recipes</h5>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="box grid recipes">
                            <div class="by">
                                <i class="fa fa-user" aria-hidden="true"></i> Gerina Amy
                            </div>
                            <a href="recipe-detail.html"><img src="images/recipe2.jpg" alt=""></a>
                            <h2><a href="recipe-detail.html">Milk fruit fresh with vegetables </a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <div class="tag">
                                <a href="#">Milk</a>
                                <a href="#">Lemon</a>
                                <a href="#">Sayur</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="box grid recipes">
                        <div class="by">
                            <i class="fa fa-user" aria-hidden="true"></i> Gerina Amy
                        </div>
                        <a href="recipe-detail.html"><img src="images/recipe3.jpg" alt=""></a>
                        <h2><a href="recipe-detail.html">Pink Happy Pia Chocolate Sweet</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                        <div class="tag">
                            <a href="#">Chocolate</a>
                            <a href="#">Lemon</a>
                            <a href="#">Sayur</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->


    <!-- Footer -->
    <div id="footer"></div>

  </body>
</html>
