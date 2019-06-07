// Grill v1.2
$(document).ready(function() {

  var zahl = 2;

    $('.js-search-category, .js-search-category2').select2();


    $(".js-search-ingredients").select2({
        maximumSelectionLength: 4
    });

    $("#sortable").sortable();
    $("#sortable").disableSelection();

    $(".btn-light").click(function() {

      console.log(zahl);
      var idZutat = "zutatSelect"+zahl;
      var idEinheit = "einheitSelect"+zahl;
      var idAnzahl = "anzahlSelect"+zahl;
      var idZusatz = "zusatzSelect"+zahl;

        event.preventDefault();
        $("#sortable").append('<div id="zutatenreihe" class="box ui-sortable-handle">\
                    <div id="zutatenrow" class="row">\
                      <div class="col-lg-1 col-sm-1">\
                        <i class="fa fa-arrows" aria-hidden="true"></i>\
                      </div>\
                      <div id="zutatenanzahl" class="col-lg-1 col-sm-1">\
                        <label for="sel2">Anzahl:</label><input type="text" class="form-control" id='+idAnzahl+'>\
                      </div>\
                      <div id="zutateneinheit" class="col-lg-3 col-sm-3">\
                        <label for="sel2">Einheit:</label><select class="form-control" id='+idEinheit+'></select>\
                      </div>\
                      <div id="zutatenzutat" class="col-lg-3 col-sm-3">\
                        <label for="sel2">Zutat:</label><select class="form-control" id='+idZutat+'></select>\
                      </div>\
                      <div id="zutatenzusatz" class="col-lg-3 col-sm-3">\
                        <label for="sel2">Zusatz:</label><input type="text" class="form-control" id='+idZusatz+'>\
                      </div>\
                      <div class="col-lg-1 col-sm-1">\
                        <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>\
                      </div>\
                    </div>\
                  </div>');


                  $.ajax({
                          type:'GET',
                          url:'getIngredientList.php',
                          dataType: "json",

                          success:function(data){
                      var x = document.getElementById(idZutat);
                              for (var i = 0; i < data.length; i++) {
                        var option = document.createElement("option");
                        option.text = data[i].zutat;
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
                              url:'getUnitList.php',
                              dataType: "json",

                              success:function(data){

                          var x = document.getElementById(idEinheit);
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
                      zahl++;
    });

    $("#sortable").on("click", ".minusbtn", function() {
        $(this).parent().parent().parent().remove();
    });





});

function test () {
  let  elems = document.getElementById('sortable').childNodes;
  let elems2 = null;
  let elems3 = null;
  let elems4 = null;
  let elems5 = null;
  let elems6 = null;
  let varanzahl = null;
  let vareinheit = null;
  let varzutat = null;

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
                      console.log(document.getElementById(varanzahl).value);
                    }
                  }
                } else if (elems3[k].id === "zutateneinheit") {
                  elems5 = elems3[k].childNodes;
                  //console.log("Neue Zutateneinheit");
                  for (let m=0; m<elems5.length; m++) {
                    if (elems5[m].id !== undefined && elems5[m].id !== "") {
                      vareinheit = elems5[m].id;
                      var selected = document.getElementById(vareinheit);
                      var opt = selected.options[selected.selectedIndex];
                      //console.log(vareinheit);
                      console.log(opt.id);
                    }
                  }
                } else if (elems3[k].id === "zutatenzutat") {
                  elems6 = elems3[k].childNodes;
                  //console.log("Neue Zutatenzutat");
                  for (let n=0; n<elems6.length; n++) {
                    if (elems6[n].id !== undefined && elems6[n].id !== "") {
                      varzutat = elems6[n].id;
                      var selected = document.getElementById(varzutat);
                      var opt = selected.options[selected.selectedIndex];
                      //console.log(varzutat);
                      console.log(opt.id);
                    }
                  }
                }
              }
            }

          }
        }
    }
}

/*
else if (elems3[k].id === "zutateneinheit") {
  elems5 = elems3[k].childNodes;
  console.log("Neue Zutateneinheit");
  for (let m=0; m<elems5.length; m++) {
    if (elems5[m].id !== undefined && elems5[m].id !== "") {
      console.log(elems5[m].id);
      console.log(document.getElementById(elem5s[m]));
    }

  }
}*/
