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

        <title>Rezeptobot - Kochübersicht</title>
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.min.css" rel="stylesheet">
        <link href="css/select2.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="favicon.ico" />
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type='text/javascript' src='js/jquery.js'></script>
	    <script type='text/javascript' src='js/moment.min.js'></script>
        <script type='text/javascript' src='js/fullcalendar.js'></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script src="js/rezeptdetails.js"></script>

        <script>
            $(function(){
                $("#navigation").load("header.html");
                $("#footer").load("footer.html");
            });
        </script>
    </head>


    <body>

        <div id="navigation"></div>

        <div class="recipe-detail">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <h4>Oct 30, 2018</h4>
                        <h1 id="rezepttitel"></h1>
                        <div class="by"><i class="fa fa-user" aria-hidden="true"></i> Jonas Kortum</div>
                    </div>
                    <div class="col-lg-8">
                        <img id="recipe_image" src="#" alt="">
                        <div class="info">
                            <div class="row">
                                <div id="portionen" class="col-lg-4 col-sm-4">
                                    <p>Portionen</p>
                                </div>
                                <div id="vorbereitungszeit" class="col-lg-4 col-sm-4">
                                    <p>Vorbereitungszeit</p>
                                </div>
                                <div id="kochzeit" class="col-lg-4 col-sm-4">
                                    <p>Kochzeit</p>
                                </div>
                            </div>
                        </div>
                        <div id="tag" class="tag">
                        </div>
                        <div class="ingredient-direction">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <h3>Zutaten</h3>
                                    <!--
                                    <button type="button" class="btn btn-secondary btn-less-ingredients_yield">eine Portion weniger</button>
                                    <button type="button" class="btn btn-secondary btn-more-ingredients_yield">eine Portion mehr</button><br>
                                    -->
                                    <ul id ="ingredients" class="ingredients"></ul>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <h3>Zubereitung</h3>
                                    <ol id="zubereitung"class="directions"></ol>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                <!--
                                    <a id="rezeptaendern" href="rezeptaendern.php" class="btn" style="
                                        background-color: #363636;
                                        color: #fff;"> Rezept ändern
                                    </a>
                                -->
                                    <a id="rezeptaendern" href="rezeptaendern.php"
                                        class="btn" data-toggle="modal" data-target="#wunderlistmodal" style="
                                        background-color: #363636;
                                        color: #fff;"> Wunderlist
                                    </a>
                                    <a id="rezeptaendern" href="rezeptaendern.php"
                                        class="btn" data-toggle="modal" data-target="#heutegekochtmodal" style="
                                        background-color: #363636;
                                        color: #fff;"> heute gekocht
                                    </a>
                                    <a id="rezeptaendern" href="rezeptaendern.php"
                                        class="btn" data-toggle="modal" data-target="#planenmodal" style="
                                        background-color: #363636;
                                        color: #fff;"> Rezept planen
                                    </a>
                                    <div class="modal fade" id="wunderlistmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Zutaten zur Wunderlist hinzufügen</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="bodymodalbuttons" class="modal-body" style="text-align: center;">
                                                    <h5 class="modal-title" id="anzahlPortionenmodal"></h5>
                                                    <button type="button" class="btn btn-secondary btn-less-yield">eine Portion weniger</button>
                                                    <button type="button" class="btn btn-secondary btn-more-yield">eine Portion mehr</button><br>
                                                </div>
                                                <div id="bodymodal" class="modal-body"></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                                                    <button type="button" class="btn btn-primary btn-wunderlist">Hinzufügen</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="heutegekochtmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Heute gekocht</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="bodymodalbuttons" class="modal-body" style="text-align: center;">
                                                    <h5 class="modal-title" id="anzahlPortionenmodal"></h5>
                                                    <label for="exampleInputEmail1">Wenn Sie bestätigen, wird das Rezept zum heutigen Tag im Kalender hinzugefügt.</label>
                                                </div>
                                                <div id="bodymodal" class="modal-body">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary btn-heutegekocht">Hinzufügen</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="planenmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Rezept planen</h2>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <h5 id="modalTitel" >Test</H5>
                                                            <label>Datum:</label>
                                                            <input class="form-control" id="modalDateGeplant" name="date" placeholder="MM/DD/YYY" type="text"/>
                                                        </div>
                                                        <div class="form-group" id="beschreibungDiv">
                                                        </div>
                                                        <button type="button" id="changeTarget" class="btn btn-primary btn-geplant">Save changes</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="planenmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			    <div class="modal-dialog" role="document">
  				    <div class="modal-content">
  					    <div class="modal-header">
  						    <h2>Event ändern</h2>
  					    </div>
  					    <div class="modal-body">
  						    <form>
  							    <div class="form-group">
                                    <h5 id="modalTitel" >Test</H5>
  								    <label>Datum:</label>
  								    <input class="form-control" id="modalDate" name="date" placeholder="MM/DD/YYY" type="text"/>
  							    </div>
  							    <div class="form-group" id="beschreibungDiv"></div>
  							    <button type="button" id="changeTarget" class="btn btn-primary">Save changes</button>
  						    </form>
  					    </div>
  					    <div class="modal-footer">
  						    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  					    </div>
  				    </div>
  			    </div>
  		    </div>

            <!-- Footer -->
            <div id="footer"></div>
        </div>
  </body>
</html>
