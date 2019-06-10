<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Grill - Submit Recipes</title>

    <!---Font Icon-->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.min.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="icon" href="favicon.ico" />

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type = "text/javascript" language = "javascript">

var jsonObj = [];
var jsonObj2 = [];



function myFunction() {
  document.getElementById("rezepttitel").style.border = "1px solid #ced4da";
}

function getUrlVars() {
var vars = {};
var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
});
return vars;
}



$(document).ready(function(){

var ingredients = null;

  $(".btn-submit").click(function() {
    if (document.getElementById("rezepttitel").value == "") {
      document.getElementById('modalbody').innerText = "Bitte geben Sie einen Rezepttitel ein!";
      $("#exampleModal").modal();
      document.getElementById("rezepttitel").style.border = "2px solid red";
    } else {

      let  elems = document.getElementById('sortable').childNodes;
      let elems2 = null;
      let elems3 = null;
      let elems4 = null;
      let elems5 = null;
      let elems6 = null;
      let elems7 = null;
      let varanzahl = null;
      let vareinheit = null;
      let varzutat = null;
      let varzusatz = null;
      let opt = null;
      let opt2 = null;

      for (let i=0; i<elems.length; i++) {
          if (elems[i].id === "zutatenreihe") {
            //console.log("Neue Zutatenreihe");
            elems2 = elems[i].childNodes;
              for (let j=0; j<elems2.length; j++) {

                if (elems2[j].id === "zutatenrow") {
                  //console.log("Neue Zutatenrow");
                  elems3 = elems2[j].childNodes;

                  for (let k=0; k<elems3.length; k++) {
                    if (elems3[k].id === "zutatenanzahl") {
                      elems4 = elems3[k].childNodes;
                      //console.log("Neue Zutatenanzahl");
                      for (let l=0; l<elems4.length; l++) {
                        if (elems4[l].id !== undefined && elems4[l].id !== "") {
                          varanzahl = elems4[l].id;
                          //console.log(varanzahl);

                        }
                      }
                    } else if (elems3[k].id === "zutateneinheit") {
                      elems5 = elems3[k].childNodes;
                      //console.log("Neue Zutateneinheit");
                      for (let m=0; m<elems5.length; m++) {
                        if (elems5[m].id !== undefined && elems5[m].id !== "") {
                          vareinheit = elems5[m].id;
                          var selected = document.getElementById(vareinheit);
                          opt = selected.options[selected.selectedIndex];
                        }
                      }
                    } else if (elems3[k].id === "zutatenzutat") {
                      elems6 = elems3[k].childNodes;
                      //console.log("Neue Zutatenzutat");
                      for (let n=0; n<elems6.length; n++) {
                        if (elems6[n].id !== undefined && elems6[n].id !== "") {
                          varzutat = elems6[n].id;
                          var selected = document.getElementById(varzutat);
                          opt2 = selected.options[selected.selectedIndex];
                          //console.log(varzutat);

                        }
                      }
                    } else if (elems3[k].id === "zutatenzusatz") {
                      elems7 = elems3[k].childNodes;
                      //console.log("Neue Zutatenanzahl");
                      for (let o=0; o<elems7.length; o++) {
                        if (elems7[o].id !== undefined && elems7[0].id !== "") {
                          varzusatz = elems7[o].id;
                          //console.log(varanzahl);

                        }
                      }
                    }
                  }
                  var new_obj = {
                    'anzahl':document.getElementById(varanzahl).value,
                    'einheit':opt.id,
                    'zutat': opt2.id,
                    'zusatz': document.getElementById(varzusatz).value
                  };

                      jsonObj.push(new_obj);
                }

              }
            }


        }

        let elems22 = document.getElementById('sortable2').childNodes;
        let elems23 = null;
        let elems24 = null;
        let elems25 = null;
        let varKategorie = null;

        for (let i2=0; i2<elems22.length; i2++) {
            if (elems22[i2].id === "kategoriereihe") {
              //console.log("Neue Zutatenreihe");
              elems23 = elems22[i2].childNodes;
              for (let j3=0; j3<elems23.length; j3++) {
                if (elems23[j3].id === "kategorierow") {
                  console.log("Neue Zutatenrow");
                  elems24 = elems23[j3].childNodes;
                  for (let k2=0; k2<elems24.length; k2++) {
                    if (elems24[k2].id === "kategorieinstanz") {
                      elems25 = elems24[k2].childNodes;
                      console.log("Neue Zutatenanzahl");
                      for (let l2=0; l2<elems25.length; l2++) {
                        if (elems25[l2].id !== undefined && elems25[l2].id !== "") {
                          varKategorie = elems25[l2].id;
                          var selected = document.getElementById(varKategorie);
                          var opt5 = selected.options[selected.selectedIndex];
                          console.log(opt5);
                          var new_obj2 = {
                            'id':opt5.id,

                          };

                              jsonObj2.push(new_obj2);
                        }
                      }
                    }
                  }
                }
              }
              }
          }


      var jsonTest = jsonObj;
      var jsonTest2 = jsonObj2;

      var number = getUrlVars()["q"];

      var titel = document.getElementById("rezepttitel").value;
      var durchfuehrung = document.getElementById("durchfuehrung").value;
      var anzahlPortionen = document.getElementById("anzahlPortionen").value;
      var kochzeit = document.getElementById("kochzeit").value;
      var vorbereitungszeit = document.getElementById("vorbereitungszeit").value;

      if (anzahlPortionen == "") {
        anzahlPortionen = 0;
      }

      var passt = titel.length > 0;

      if (passt) {
        var myObj = {
            "titel": titel,
            "durchfuehrung": durchfuehrung,
            "anzahlPortionen" : anzahlPortionen,
            "einheit" : "Portionen",
            "kochzeit" : kochzeit,
            "vorbereitungszeit" : vorbereitungszeit,
            "zutatenliste" : jsonTest,
            "kategorienliste" : jsonTest2,
            "rezept_id" : number
        }


        $.ajax({
        type: "POST",
        data: {event: JSON.stringify(myObj)},
        dataType: 'text',  // what to expect back from the PHP script, if anything
        url: 'db/updateRecipe.php',
        success: function(php_script_response){
      //window.location.href = "uebersicht.php";
      }
        });
      }
    }
  });

  $.ajax({
          type:'GET',
          url:'db/getCategoryList.php',
          dataType: "json",

          success:function(data){
      var x = document.getElementById("kategorieSelect1");
              for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].kategorie;
        option.id = data[i].id;
        x.add(option);

      }
          },
    error: function (request, error) {
      console.log(arguments);
      alert(" Can't do because: " + error);
  },
      });


  $.ajax({
          type:'GET',
          url:'db/getUnitList.php',
          dataType: "json",

          success:function(data){

      var x = document.getElementById("einheitSelect1");
              for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].einheit;
        option.id = data[i].id;
        x.add(option);

      }
          },
    error: function (request, error) {
      console.log(arguments);
      alert(" Can't do because: " + error);
  },
      });



      var number = getUrlVars()["q"];

      $.ajax({
              type:'GET',
              url:'db/getFullRecipe.php',
              dataType: "json",
              data: {
                    'rezeptId': number
                },

              success:function(data){

                var ings = null;

                $.ajax({
                        type:'GET',
                        url:'db/getIngredientAndUnitList.php',
                        dataType: "json",

                        success:function(data2){
                          ings = data2;


                          var ueb = document.getElementById('ueberschrift');
                          var h = document.createElement("H2");            // Create a <h1> element
                          var t = document.createTextNode("Rezept "+data[0][0].titel + " ändern");     // Create a text node
                          h.appendChild(t);
                          ueb.appendChild(h);

                          document.getElementById('rezepttitel').value = data[0][0].titel;
                          document.getElementById('durchfuehrung').value = data[0][0].durchfuehrung;
                          document.getElementById('anzahlPortionen').value = data[0][0].anzahlPortionen;
                          document.getElementById('vorbereitungszeit').value = data[0][0].vorbereitungszeit;
                          document.getElementById('kochzeit').value = data[0][0].kochzeit;

                          document.getElementById("zutatenreihe").remove();

                          var idZutat = null;
                          var idEinheit = null;
                          var idAnzahl = null;
                          var idZusatz = null;
                          var zahl = 1;

                          for (var i = 0; i < data[1].length; i++){

                            idZutat = "zutatSelect"+zahl;
                            idEinheit = "einheitSelect"+zahl;
                            idAnzahl = "anzahlSelect"+zahl;
                            idZusatz = "zusatzSelect"+zahl;

                            var test = data[1][i].anzahl == null ? '' : data[1][i].anzahl;

                            test = test.replace(".0" , "");
                            test = test.replace("." , ",")

                            $("#sortable").append('<div id="zutatenreihe" class="box ui-sortable-handle">\
                                        <div id="zutatenrow" class="row">\
                                          <div class="col-lg-1 col-sm-1">\
                                            <i class="fa fa-arrows" aria-hidden="true"></i>\
                                          </div>\
                                          <div id="zutatenanzahl" class="col-lg-1 col-sm-1">\
                                            <label for="sel2">Anzahl:</label><input type="text" value="'+test+'" class="form-control" id='+idAnzahl+'>\
                                          </div>\
                                          <div id="zutateneinheit" class="col-lg-3 col-sm-3">\
                                            <label for="sel2">Einheit:</label><select class="form-control" id='+idEinheit+'></select>\
                                          </div>\
                                          <div id="zutatenzutat" class="col-lg-3 col-sm-3">\
                                            <label for="sel2">Zutat:</label><select class="form-control" id='+idZutat+'></select>\
                                          </div>\
                                          <div id="zutatenzusatz" class="col-lg-3 col-sm-3">\
                                            <label for="sel2">Zusatz:</label><input type="text" value="'+data[1][i].zusatz+'" class="form-control" id='+idZusatz+'>\
                                          </div>\
                                          <div class="col-lg-1 col-sm-1">\
                                            <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>\
                                          </div>\
                                        </div>\
                                      </div>');

                                      zahl++;

                                      var x = document.getElementById(idZutat);
                                      for (var j = 0; j < ings[0].length; j++) {

                                        var option = document.createElement("option");
                                        option.text = ings[0][j].zutat;
                                        option.id = ings[0][j].id;


                                          if (data[1][i].zutatenliste_id == ings[0][j].id) {
                                             console.log('passt');
                                             option.setAttribute('selected', 'selected');
                                          }
                                          x.add(option);


                                      }

                                      var x = document.getElementById(idEinheit);
                                      for (var k = 0; k < ings[1].length; k++) {

                                        var option = document.createElement("option");
                                        option.text = ings[1][k].einheit;
                                        option.id = ings[1][k].id;


                                          if (data[1][i].einheit_id == ings[1][k].id) {
                                             console.log('passt');
                                             option.setAttribute('selected', 'selected');
                                          }
                                          x.add(option);


                                      }
                          }

                        },
                  error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                    });



/*
for (var j = 0; j < ingredients.length; j++) {
  var x = document.getElementById(idZutat);
  console.log(idZutat);

    var option = document.createElement("option");

    option.text = ingredients[j].zutat;
    option.id = ingredients[j].id;
    x.add(option);

}
*/






              },
        error: function (request, error) {
          alert(" Can't do because: " + error);
      },
          });


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
                      <a class="nav-link" href="index.php">Kalender</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="uebersicht.php">Von A - Z</a>
                  </li>
                  <li class="nav-item btn-submit-recipe">
                      <a class="nav-link" href="neuesrezept.php"><i class="fa fa-upload" aria-hidden="true"></i> neues Rezept</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>

    <!-- Submit Recipe-->
    <div class="submit">
        <div class="title">
            <div class="container">
                <div class="row">
                    <div id="ueberschrift" class="col-lg-12">

                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group">
                            <label>Titel des Rezepts</label>
                            <input id="rezepttitel" type="text" class="form-control" oninput="myFunction()">
                        </div>

                        <div class="form-group">
                              <label>Kategorien</label>

                            <div id="sortable2">
                                <div id="kategoriereihe" class="box ui-sortable-handle">
                                  <div id="kategorierow" class="row">
                                    <div class="col-lg-2 col-sm-2">
                                        <i class="fa fa-arrows" aria-hidden="true"></i>
                                    </div>
                                    <div id="kategorieinstanz" class="col-lg-8 col-sm-8">
                                      <select class="form-control" id="kategorieSelect1">
                                      </select>
                                    </div>
                                    <div class="col-lg-2 col-sm-2">
                                        <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>


                        </div>
<a href="#" class="btn btn-light2" style="
    background-color: #363636;
    color: #fff;">Weitere Kategorie</a>
<br><br>



                        <!--
                        <div class="form-group">
                            <label>Short summary</label>
                            <textarea class="form-control" rows="4" required="required"></textarea>
                        </div>
                      -->
                      <!--
                        <div class="form-group">
                            <label>Tag</label>
                            <input type="text" class="form-control">
                        </div>
                      -->
<!--
                        <div class="form-group">
                            <label>Upload your photos</label>
                            <input type="file" class="form-control-file">
                        </div>
                      -->
                        <div class="form-group">
                            <label>Zutaten:</label>

                            <div id="sortable">
                                <div id="zutatenreihe" class="box ui-sortable-handle">
                                    <div id="zutatenrow" class="row">
                                        <div class="col-lg-1 col-sm-1">
                                            <i class="fa fa-arrows" aria-hidden="true"></i>
                                        </div>
                                        <div id="zutatenanzahl" class="col-lg-1 col-sm-1">
                                          <label for="sel2">Anzahl:</label>
                                            <input type="text" class="form-control" id="anzahlSelect1">
                                        </div>
                                        <div id="zutateneinheit" class="col-lg-3 col-sm-3">
                                          <label for="sel2">Einheit:</label>
                                          <select class="form-control" id="einheitSelect1">
                                          </select>
                                        </div>
                                        <div id="zutatenzutat" class="col-lg-3 col-sm-3">
                                          <label for="sel2">Zutat:</label>
                                          <select class="form-control" id="zutatSelect1">
                                          </select>
                                        </div>
                                        <div id="zutatenzusatz" class="col-lg-3 col-sm-3">
                                          <label for="sel2">Zusatz:</label>
                                            <input type="text" class="form-control" id="zusatzSelect1">
                                        </div>
                                        <div class="col-lg-1 col-sm-1">
                                            <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <a href="#" class="btn btn-light">Neue Zutat</a>

                        </div>

                        <div class="form-group">
                            <label>Durchführung:</label>
                            <textarea id="durchfuehrung" class="form-control" rows="4" required="required"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Zusätzliche Informationen</label>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Portionen</label>
                            <div class="col-sm-10">
                                <input id="anzahlPortionen" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vorbereitungszeit</label>
                            <div class="col-sm-10">
                                <input id="vorbereitungszeit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kochzeit</label>
                            <div class="col-sm-10">
                                <input id="kochzeit" type="text" class="form-control">
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label>Nutrition Facts</label>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Calories</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Carbohydrate</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Fat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Protein</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cholesterol</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
-->
                        <button type="submit" class="btn btn-submit">Rezept speichern</button>

                    </div>
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

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fehlende Eingaben</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modalbody"class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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