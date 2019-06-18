<!DOCTYPE html>
<html lang="en">
<?php
session_start();    // ALTE SESSION STARTEN

if(!isset($_SESSION['userid'])) {
    header('Location: login.php');

}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rezeptobot - Rezeptdetails</title>

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
    <link href="css/font-awesome.min.css" rel="stylesheet">
</head>

<script type = "text/javascript" language = "javascript">

$(document).ready(function(){

  $(".btn-wunderlist").click(function() {

    var jsonObj = [];

      var checkboxes = document.getElementsByName('wunderlistboxen');
      var checkboxesChecked = [];
        // loop over them all
        for (var i=0; i<checkboxes.length; i++) {
           // And stick the checked ones onto an array...
           if (checkboxes[i].checked) {
             var v = checkboxes[i].value;
             v = v.substring(0, v.length - 5);
             v = v.replace('  ',' ');
             jsonObj.push(v);
           }
        }

        $.ajax({
        type: "POST",
        data: {event: JSON.stringify(jsonObj)},
        dataType: 'text',  // what to expect back from the PHP script, if anything
        url: 'db/saveToWunderlist.php',
        success: function(php_script_response){


      //window.location.href = "uebersicht.php";
      }
        });

        $('#wunderlistmodal').modal('hide');


  });

  $(".btn-less-yield").click(function() {

    var anzahlPortionenText1 = document.getElementById('anzahlPortionenmodal').innerText;

    var anzahlPortionenText2 = anzahlPortionenText1.substr(0,anzahlPortionenText1.indexOf(' '));
    var anzahlPortionenText3 = anzahlPortionenText1.substr(anzahlPortionenText1.indexOf(' '));
    var integer = parseInt(anzahlPortionenText2, 10);
    if (integer >1) {
      integer2 = integer-1;
      document.getElementById('anzahlPortionenmodal').innerText = integer2 + anzahlPortionenText3;
    }

    var x = document.getElementsByClassName("modaleZutaten");
    for (var n = 0; n < x.length; n++) {
      var text = x[n].innerText;
      text = text.substring(1);
      var text2 = text.substring(0, text.indexOf(' '));
      var text3 = text.substring(text.indexOf(' '));
      var value = parseFloat(text2.replace(",", "."));

      zahl = Math.round (value/integer*integer2 * 100) / 100;  // 217.43;
      x[n].innerText = ' '+zahl + ' ' + text3;
    }



  });

  $(".btn-more-yield").click(function() {

    var anzahlPortionenText1 = document.getElementById('anzahlPortionenmodal').innerText;

    var anzahlPortionenText2 = anzahlPortionenText1.substr(0,anzahlPortionenText1.indexOf(' '));
    var anzahlPortionenText3 = anzahlPortionenText1.substr(anzahlPortionenText1.indexOf(' '));
    var integer = parseInt(anzahlPortionenText2, 10);
      integer2 = integer+1;
      document.getElementById('anzahlPortionenmodal').innerText = integer2 + anzahlPortionenText3;


      var x = document.getElementsByClassName("modaleZutaten");
      for (var n = 0; n < x.length; n++) {
        var text = x[n].innerText;
        text = text.substring(1);
        var text2 = text.substring(0, text.indexOf(' '));
        var text3 = text.substring(text.indexOf(' '));
        var value = parseFloat(text2.replace(",", "."));
        console.log('zu teilende Zahl: ' + value);

        zahl = Math.round (value/integer*integer2 * 100) / 100;  // 217.43;
        console.log(zahl);
        x[n].innerText = ' '+zahl + ' ' + text3;

      }



  });

var number = getUrlVars()["q"];

var aendernButton = document.getElementById('rezeptaendern');
aendernButton.href =  'rezeptaendern.php?q='+number; // Insted of calling setAttribute


 $.ajax({
          type:'GET',
          url:'db/getFullRecipe.php',
          dataType: "json",
    data: {
          'rezeptId': number
      },
          success:function(data){

            document.getElementById('rezepttitel').innerHTML = data[0][0].titel;
            var ColorsAvailable = document.getElementById('bodymodal');

            for (var i = 0; i < data[1].length; i++){
              var ul = document.getElementById("ingredients");
              var li = document.createElement("li");

              var test = data[1][i].anzahl == null ? '' : data[1][i].anzahl;

              test = test.replace(".0" , "");
              test = test.replace("." , ",")

              var zusatz = data[1][i].zusatz

              var inhalt = test + ' ' + data[1][i].einheit + ' ' + data[1][i].zutat;
              if (data[1][i].zusatz !== null && data[1][i].zusatz.length > 0 && data[1][i].zusatz !== "null") {
                inhalt +=  ' (' + zusatz+')';
              }


              li.appendChild(document.createTextNode(inhalt));
              li.setAttribute("id", "element4"); // added line
              ul.appendChild(li);

              var color, p, br;
              color=document.createElement("input");
              color.value=(inhalt + '</br>');
              color.type="checkbox";
              color.id="color";
              color.name="wunderlistboxen";
              p =document.createElement("span");
              p.classList.add("modaleZutaten");
              p.innerHTML = " " + inhalt;
              br =document.createElement("br");

              ColorsAvailable.appendChild(color);
              ColorsAvailable.appendChild(p);
              ColorsAvailable.appendChild(br);



            }
            var anzahlPortionenText = document.getElementById('anzahlPortionenmodal');
            anzahlPortionenText.innerText = data[0][0].anzahlPortionen + " " + data[0][0].einheit;

            var test = data[0][0].durchfuehrung;
            data[0][0].durchfuehrung.replace(/↵/, '<br/>');

            var ol = document.getElementById("zubereitung");
            var li2 = document.createElement("li");
            li2.appendChild(document.createTextNode(data[0][0].durchfuehrung));
            ol.appendChild(li2);

            document.getElementById("recipe_image").src=data[0][0].bildpfad;

            var por = document.getElementById("portionen");
            var pe = document.createElement("p");
            var x = document.createElement("STRONG");
            pe.appendChild(x);
            var i2 = document.createElement("i");
            i2.classList.add("fa", "fa-users");
            x.appendChild(i2);
            var x2 = document.createElement("B");
            var t = document.createTextNode(" " + data[0][0].anzahlPortionen + " " + data[0][0].einheit);
            x2.appendChild(t);
            x.appendChild(x2);
            por.appendChild(pe);

            var por2 = document.getElementById("vorbereitungszeit");
            var pe2 = document.createElement("p");
            var x2 = document.createElement("STRONG");
            pe2.appendChild(x2);
            var i3 = document.createElement("i");
            i3.classList.add("fa", "fa-clock-o");
            x2.appendChild(i3);
            var x3 = document.createElement("B");
            var t2 = document.createTextNode(" " + data[0][0].vorbereitungszeit + " Minuten");
            x3.appendChild(t2);
            x2.appendChild(x3);
            por2.appendChild(pe2);

            var por3 = document.getElementById("kochzeit");
            var pe3 = document.createElement("p");
            var x3 = document.createElement("STRONG");
            pe3.appendChild(x3);
            var i4 = document.createElement("i");
            i4.classList.add("fa", "fa-clock-o");
            x3.appendChild(i4);
            var x4 = document.createElement("B");
            var t3 = document.createTextNode(" " + data[0][0].kochzeit + " Minuten");
            x4.appendChild(t3);
            x3.appendChild(x4);
            por3.appendChild(pe3);

            for (var j = 0; j < data[2].length; j++){
              var por4 = document.getElementById("tag");
              a2 = document.createElement('a');
              a2.href =  '#'; // Insted of calling setAttribute
              a2.innerHTML = data[2][j].kategorie;

              por4.appendChild(a2);// <a>INNER_TEXT</a>
            }





            //<p><strong><i class="fa fa-users" aria-hidden="true"></i>  Personen</strong></p>
/*
      document.getElementById('bgr').style.backgroundImage="url("+data[0][0].bildpfad+")";
      //document.getElementById('rezeptbild').src= data[0][0].bildpfad;


      var div = document.getElementById("durchfuehrung");
      var p = document.createElement("p");
      p.setAttribute("class", "justify");

      p.innerHTML = data[0][0].durchfuehrung.replace(/↵/, '<br/>');;
      div.appendChild(p);

*/



          },
    error: function (data) {
    alert(data);
  },
      });

  function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
  });
  return vars;
}


});
</script>

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

    <!-- Detail Recipes-->
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

                    <!--
                    <p>Lorem ipsum dolor sit amet, usu eu vocibus laboramus appellantur, pro no natum ullum omittam. Mei vitae utinam complectitur eu. Te usu cibo vulputate. Id propriae adipisci pro. Legere nominati ut mel, natum libris at vix.</p>

-->
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
                            <div class="col-lg-6 col-sm-6">
                              <a id="rezeptaendern" href="rezeptaendern.php" class="btn" style="
                                  background-color: #363636;
                                  color: #fff;"> Rezept ändern</a>
                                  <a id="rezeptaendern" href="rezeptaendern.php"
                                  class="btn" data-toggle="modal" data-target="#wunderlistmodal" style="
                                      background-color: #363636;
                                      color: #fff;"> Wunderlist</a>
                                  <!-- Button trigger modal -->


<!-- Modal -->
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
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="nutrition-facts clearfix">
                        <h3>Nutrition Facts</h3>
                        <div>
                            <p>Calories:</p>
                            <p><strong>632 kcal</strong></p>
                        </div>
                        <div>
                            <p>Carbohydrate:</p>
                            <p><strong>37 g</strong></p>
                        </div>
                        <div>
                            <p>Fat:</p>
                            <p><strong>92 g</strong></p>
                        </div>
                        <div>
                            <p>Protein:</p>
                            <p><strong>63 g</strong></p>
                        </div>
                        <div>
                            <p>Cholesterol:</p>
                            <p><strong>0 mg</strong></p>
                        </div>

                    </div>
                  -->
                  <!--
                    <div class="blog-comment">
                        <h3>3 Comments</h3>
                        <hr/>
                        <ul class="comments">
                            <li>
                                <div class="post-comments">
                                    <p class="meta">Dec 1, 2018 &#8212; <a href="#">Deks</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                    <p>
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat. Cras ultricies ligula sed magna dictum porta.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="post-comments">
                                    <p class="meta">Dec 1, 2018 &#8212; <a href="#">Suto</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a sapien odio, sit amet
                                    </p>
                                </div>
                                <ul class="comments">
                                    <li>
                                        <div class="post-comments">
                                            <p class="meta">Dec 2, 2018 &#8212; <a href="#">Most</a> says : <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a sapien odio, sit amet
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="reply">
                            <h3>Leave a Reply</h3>
                            <form method="post" id="commentform" class="comment-form">
                                <p class="comment-form-comment">
                                    <textarea class="form-control" id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea>
                                </p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="comment-form-author">
                                            <label for="author">Name <span class="required">*</span></label>
                                            <input class="form-control" id="author" name="author" type="text" value="" size="30" maxlength="245" aria-required="true" required="required">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="comment-form-email">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input class="form-control" id="email" name="email" type="text" value="" size="30" maxlength="100" aria-required="true" required="required">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="comment-form-url">
                                            <label for="url">Website</label>
                                            <input class="form-control" id="url" name="url" type="text" value="" size="30" maxlength="200">
                                        </p>
                                    </div>
                                </div>
                                <p class="form-submit">
                                    <input class="btn btn-submit btn-block" name="submit" type="submit" id="submit" value="Post Comment">
                                </p>
                            </form>
                        </div>
                    </div>
                    >
                </div-->
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

    <!-- Javascript -->
    <script src="js/plugins/jquery.min.js"></script>
    <script src="js/plugins/popper.min.js"></script>
    <script src="js/plugins/bootstrap.min.js"></script>
    <script src="js/plugins/select2.min.js"></script>

    <script src="js/scripts.js"></script>

</body>

</html>
