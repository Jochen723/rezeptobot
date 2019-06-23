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
    <!---Font Icon-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.min.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.ico" />
    <style>
    img {
    vertical-align: middle;
    border-style: none;
    height: 190px;



    }

    .recipes {
      height:384px;
    }
}
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



   <link rel='stylesheet' type='text/css' href='css/fullcalendar.css' />
	 <script type='text/javascript' src='js/jquery.js'></script>
	 <script type='text/javascript' src='js/moment.min.js'></script>
   <script type='text/javascript' src='js/fullcalendar.js'></script>
   <script src="js/bootstrap.min.js"></script>

   <link href="css/font-awesome.min.css" rel="stylesheet">

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
   <script src="js/eventscript.js"></script>
   <script type = "text/javascript" language = "javascript">




  </script>
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
                <?php
                if(isset($_SESSION['mail'])) {echo $_SESSION['mail'];}?>
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
								<input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
							</div>
							<div class="form-group">
								<label for="selectArt">Art des Essens:</label>
								<select class="form-control" id="selectArt">
									 <option value="ess" id="ess">Essensbestellung</option>
									 <option value="aus" id="aus">Auswärts</option>
									 <option value="son" id="son">Sonstiges</option>
								</select>
							</div>
							<div class="form-group" id="beschreibungDiv">

								</select>
							</div>


							<button type="button" id="target" class="btn btn-primary">Save changes</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

  </body>
</html>
