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
    <script type='text/javascript' src='js/jquery.js'></script>
	  <script type='text/javascript' src='js/moment.min.js'></script>
    <script type='text/javascript' src='js/fullcalendar.js'></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="js/rezeptdetailsscript.js"></script>
	  <script>
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
                                <a id="rezeptaendern" href="rezeptaendern.php" class="btn" style="
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
      <div id="bodymodal" class="modal-body">
      </div>
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
      <footer>
          <div class="container">
              <div class="row">
                  <div class="col-lg-3 col-sm-6">
                      <h5>About</h5>
                      <p>Nunc at augue gravida est fermentum vulputate. gravida est fermentum vulputate Pellentesque et ipsum in dui malesuada tempus.</p>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <h5>Archive</h5>
                      <ul>
                          <li><a href="#">June 2018</a></li>
                          <li><a href="#">July 2018</a></li>
                          <li><a href="#">August 2018</a></li>
                          <li><a href="#">September 2018</a></li>
                      </ul>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <h5>Recipes</h5>
                      <ul>
                          <li><a href="browse-recipes.html">Browse Recipes</a></li>
                          <li><a href="recipe-detail.html">Recipe Detail</a></li>
                          <li><a href="submit-recipes.html">Submit Recipe</a></li>
                      </ul>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <h5>Newsletter</h5>
                      <form>
                          <div class="form-group">
                              <input type="text" class="form-control">
                          </div>
                          <button type="submit" class="btn">Subscribe</button>
                      </form>
                  </div>
              </div>
          </div>
      </footer>

      <!-- Copyright -->
      <div class="copyright">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">Made with <i class="fa fa-heart" aria-hidden="true"></i> &#8212; Copyright &copy; 2018 <a href="index.html">Grill -  Recipes & Food Blog Template</a>. All Rights Reserved. </div>
              </div>
          </div>
      </div>

  </body>
</html>
