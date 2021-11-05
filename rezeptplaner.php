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
        <!---Font Icon-->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.min.css" rel="stylesheet">
        <link href="css/select2.min.css" rel="stylesheet">
        <link href="css/masken/rezeptplaner/rezeptplaner.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="icon" href="favicon.ico" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel='stylesheet' type='text/css' href='css/fullcalendar.css' />
	    <script type='text/javascript' src='js/jquery.js'></script>
	    <script type='text/javascript' src='js/moment.min.js'></script>
        <script type='text/javascript' src='js/fullcalendar.js'></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        <script src="js/rezeptplaner.js"></script>
        <script>
            $(function(){
                $("#navigation").load("header.html");
                $("#footer").load("footer.html");
            });
         </script>
    </head>
    <body>
        <div id="navigation"></div>
        <center>
            <img src="logo/rezeptobot.png" alt="centered image" style="height:100%;width:auto" />
        </center>
	    <div id='calendar' style="margin-top: 8px; margin-left: 20px; margin-right: 20px;"></div>
	    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2>Event hinzufügen</h2>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label>Datum:</label>
								<input class="form-control" id="date" name="date" placeholder="DD.MM.YYYY" type="text"/>
							</div>
							<div class="form-group">
								<label for="selectArt">Art des Essens:</label>
								<select class="form-control" id="selectArt">
									 <option value="ess" id="ess">Essensbestellung</option>
									 <option value="aus" id="aus">Auswärts</option>
									 <option value="son" id="son">Sonstiges</option>
								</select>
							</div>
							<div class="form-group" id="beschreibungDiv"></div>
							<button type="button" id="target" class="btn btn-primary">Speichere Event</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
					</div>
				</div>
			</div>
		</div>

        <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog" role="document">
  				<div class="modal-content">
  					<div class="modal-header">
  						<h2>Event ändern</h2>
  					</div>
  					<div class="modal-body">
  						<form>
  							<div class="form-group">
                                <img id="modalImage">
                                <h5><a id="modaltitellink" href="#"></a></H5>
  								<label>Datum:</label>
  								<input class="form-control" id="modalDate" name="date" placeholder="DD.MM.YYYY" type="text"/>
  							</div>
  							<div class="form-group" id="beschreibungDiv"></div>
  							<button type="button" id="changeTarget" class="btn btn-primary">Speichere Event</button>
                            <button type="button" id="deleteEvent" class="btn btn-primary">Löschen</button>
  						</form>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
  					</div>
  				</div>
  			</div>
  		</div>
  </body>
</html>