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
	<script type = "text/javascript" language = "javascript">
	function renderDate(date) {
			var res = date.split("/");

			return res[2] + '-' + res[0] + '-' + res[1];
		}

    $( document ).ready(function() {
		$("#target").click(function(){

			var color = '#00cc99';

			var e = document.getElementById("selectArt");
			var titel = e.options[e.selectedIndex].innerText;

			if (null != document.getElementById("inputGericht")) {
				titel = 'Alternativ: ' + document.getElementById("inputGericht").value;
			}


			if (document.getElementById("selectArt").value === 'ess') {
				color = '#FFCC99';
			} else if (document.getElementById("selectArt").value == 'aus') {
				color = '#66CCFF';
			} else {
				color = '#FFFFCC';
			}



			var myObj = {
		"datum": renderDate(document.getElementById('date').value),
		"essen_id": 0,
		"titel" : titel,
		"farbe" : color
        }


			$('#calendar').fullCalendar('renderEvent', {
                title: titel,
                start: renderDate(document.getElementById('date').value),
                allDay: true,
				backgroundColor : color
              });

			$.ajax({
  type: "POST",
  data: {event: JSON.stringify(myObj)},
  dataType: "json",
  url: 'db/saveEvent.php',
  success:function(data){
  },
  error: function (request, error) {
    },
});

$('#exampleModal').modal('hide');
		});

		$('#exampleModal').on('shown.bs.modal', function () {


			var elem = document.getElementById("selectArt");
			elem.addEventListener("change", test);

			function test() {


				if (document.getElementById("selectArt").value == "son") {
					if (null == document.getElementById("labelGericht")) {
				        var elem2 = document.getElementById("beschreibungDiv");
				        var label = document.createElement('label');
				        label.setAttribute("id", "labelGericht");
				        label.innerHTML  = "Titel des Rezepts";
				        var input = document.createElement("input");
                        input.type = "text";
						input.setAttribute("id", "inputGericht");
                        input.classList.add("form-control");
                        elem2.appendChild(label);
				        elem2.appendChild(input);
				    }

				} else {
					if (null !== document.getElementById("labelGericht")) {
					    document.getElementById("labelGericht").remove();
						document.getElementById("inputGericht").remove();
					}
				}



				}







		})

		var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
  dd = '0' + dd;
}

if (mm < 10) {
  mm = '0' + mm;
}

today = mm + '/' + dd + '/' + yyyy;



        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'custom1',
                right: 'title'
        },
            defaultDate: yyyy + '-'+mm+'-'+dd,
            navLinks: true,
			height: 600,
      locales: 'ar-dz',
            editable: true,
			eventDrop: function(event, delta, revertFunc) {

			var myObj2 = {
		"datum": event.start.format(),
		"event_id": event.id,
        }

		$.ajax({
  type: "POST",
  data: {event: JSON.stringify(myObj2)},
  dataType: "json",
  url: 'db/updateEvent.php',
  success:function(data){
  },
  error: function (error) {
    },
});



  },
            eventLimit: true,

            customButtons: {
                custom1: {
                    text: 'Alternatives Gericht hinzufügen',
                    click: function () {
						$("#exampleModal").modal()
                    }
                }
            },


        });

		$('body').on('click', 'button.fc-prev-button', function() {
			var events = $('#calendar').fullCalendar('clientEvents');
	if(events.length > 0)
{
for(var i in events)
{
$('#calendar').fullCalendar('removeEvents',events[i].id);
}
}
$.ajax({
            type:'GET',
            url:'db/loadEvents.php',
            dataType: "json",

            success:function(data){
				for (var i = 0; i < data.length; i++) {
					$('#calendar').fullCalendar('renderEvent', {
                        id : data[i].event_id,
						title: data[i].titel,
                        start: data[i].datum,
                        allDay: true,
						backgroundColor : data[i].farbe
                    });
				}
            },
			error: function (request, error) {

    },
        });
});

$('body').on('click', 'button.fc-next-button', function() {
var events = $('#calendar').fullCalendar('clientEvents');
	if(events.length > 0)
{
for(var i in events)
{
$('#calendar').fullCalendar('removeEvents',events[i].id);
}
}
$.ajax({
            type:'GET',
            url:'db/loadEvents.php',
            dataType: "json",

            success:function(data){
				for (var i = 0; i < data.length; i++) {
					$('#calendar').fullCalendar('renderEvent', {
						id : data[i].event_id,
                        title: data[i].titel,
                        start: data[i].datum,
                        allDay: true,
						backgroundColor : data[i].farbe
                    });
				}
            },
			error: function (request, error) {

    },
        });
});
$(".fc-today-button").click(function() {
	var events = $('#calendar').fullCalendar('clientEvents');
	if(events.length > 0)
{
for(var i in events)
{
$('#calendar').fullCalendar('removeEvents',events[i].id);
}
}
$.ajax({
            type:'GET',
            url:'db/loadEvents.php',
            dataType: "json",

            success:function(data){
				for (var i = 0; i < data.length; i++) {
					$('#calendar').fullCalendar('renderEvent', {
						id : data[i].event_id,
                        title: data[i].titel,
                        start: data[i].datum,
                        allDay: true,
						backgroundColor : data[i].farbe
                    });
				}
            },
			error: function (request, error) {
        console.log(arguments);
    },
        });
});

		$.ajax({
            type:'GET',
            url:'db/loadEvents.php',
            dataType: "json",

            success:function(data){
				for (var i = 0; i < data.length; i++) {
					$('#calendar').fullCalendar('renderEvent', {
						id : data[i].event_id,
                        title: data[i].titel,
                        start: data[i].datum,
                        allDay: true,
						backgroundColor : data[i].farbe
                    });
				}
            },
			error: function (request, error) {
        console.log(arguments);
    },
        });


    });

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
                    <!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Demo
              </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="homepage-1.html">Homepage-1</a>
                            <a class="dropdown-item" href="homepage-2.html">Homepage-2</a>
                            <a class="dropdown-item" href="homepage-3.html">Homepage-3</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Recipes
              </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="browse-recipes.html">Browse Recipes</a>
                            <a class="dropdown-item" href="recipe-detail.html">Recipe Detail</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="uebersicht.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                von A - Z
              </a>
                    </li>
                  -->
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

  </body>
</html>
