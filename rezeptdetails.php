<?php
session_start();    // ALTE SESSION STARTEN
if(!isset($_SESSION['userid'])) {
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
    <script type='text/javascript' src='js/jquery.js'></script><script type='text/javascript' src='js/moment.min.js'></script>
    <script type='text/javascript' src='js/fullcalendar.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="js/rezeptdetailsscript.js"></script>
    <script>

        function ermittleLinkZuRezeptAendern() {
            var vars = {};
            window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            window.location.href = "rezeptaendern.php?q=" + vars["q"];
        }

        $(document).ready(function(){
            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
      })
    </script>

      <script>
          $(function(){
              $("#navigation").load("header.html");
              $("#footer").load("footer.html");
          });
      </script>
  </head>
  <style>
      table, th, td {
          border:1px solid black;
      }
  </style>
  <body>
  <div id="navigation"></div>
  <center>
      <img src="logo/rezeptobot.png" alt="centered image" style="height:100%;" />
  </center>
      <div class="recipe-detail">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-lg-12 text-center">
                      <h4 id="rezeptdatum"></h4>
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
                                  <ul id ="ingredients" class="ingredients">
                                  </ul>
                              </div>
                              <div class="col-lg-6 col-sm-6">
                                  <h3>Zubereitung</h3>
                                  <ol id="zubereitung"class="directions">
                                  </ol>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-lg-12 col-sm-12">
                                  <a id="rezeptaendern" onclick="ermittleLinkZuRezeptAendern();" class="btn" style="
                                  background-color: #363636;
                                  color: #fff;"> Rezept ändern
                                  </a>
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
                                  <a id="rezeptaendern" href="uebersicht.php" class="btn btn-delete" style="
                                  background-color: #363636;
                                  color: #fff;"> Rezept löschen
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
                                              <div id="bodymodal" class="modal-body"></div>
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
                                                      <div class="form-group" id="beschreibungDiv"></div>
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
                      <div class="row">
                        <div class="col-lg-12 text-center" id="kommentare">
                            <br/>
                            <h4 id="kochzaehler2">Kommentare</h4>
                            <div id="eventdaten">
                            </div>
                        </div>
                        <div class="col-lg-12 text-center" id="neuerKommentar">
                            <br/>
                            <h4 id="kochzaehler2">neuer Kommentar</h4>

                            <div class="form-group">
                                <textarea id="newComment" class="form-control" rows="4" required="required"></textarea>
                            </div>
                            <a id="rezeptaendern" class="btn btn-comment" style="
                            background-color: #363636;
                            color: #fff;"> Kommentar speichern
                            </a>
                        </div>
                          <div class="col-lg-12 text-center">
                              <br/>
                              <h4 id="kochzaehler"></h4>
                              <div id="eventdaten">
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
                              <div class="form-group" id="beschreibungDiv">
                                  </select>
                              </div>
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

          <!-- Copyright -->
          <div class="copyright">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-12">Made with <i class="fa fa-heart" aria-hidden="true"></i> &#8212; Copyright &copy; 2018 <a href="index.html">Grill -  Recipes & Food Blog Template</a>. All Rights Reserved. </div>
                  </div>
              </div>
          </div>
      </div>
  </body>
</html>
