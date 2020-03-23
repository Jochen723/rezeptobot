var zutatenliste = [];
var kategorienliste = [];

function ermittleZutatenliste() {
    // Der Container mit den eingegebenen Zutaten
    let  elems = document.getElementById('sortable').childNodes;
    let anzahl = null;
    let zusatz = null;
    let einheit = null;
    let zutat = null;

    //Es wird über alle Zutaten iteriert
    for (let i=0; i<elems.length; i++) {
        //Wenn der Container, der die Zutaten enthält
        if (elems[i].id === 'zutatenreihe') {
            for (let j=0; j<elems[i].childNodes.length; j++) {
                if (elems[i].childNodes[j].id === 'zutatenrow') {
                    for (let k=0; k<elems[i].childNodes[j].childNodes.length; k++) {
                        if (elems[i].childNodes[j].childNodes[k].id === 'zutatenanzahl') {
                            for (let l=0; l<elems[i].childNodes[j].childNodes[k].childNodes.length; l++) {
                                if (elems[i].childNodes[j].childNodes[k].childNodes[l].id !== undefined && elems[i].childNodes[j].childNodes[k].childNodes[l].id !== "") {
                                    anzahl = elems[i].childNodes[j].childNodes[k].childNodes[l].id;
                                }
                            }
                        } else if (elems[i].childNodes[j].childNodes[k].id === "zutateneinheit") {
                            for (let m=0; m<elems[i].childNodes[j].childNodes[k].childNodes.length; m++) {
                                if (elems[i].childNodes[j].childNodes[k].childNodes[m].id !== undefined && elems[i].childNodes[j].childNodes[k].childNodes[m].id !== "") {
                                    var tmpEinheit = elems[i].childNodes[j].childNodes[k].childNodes[m].id;
                                    einheit = document.getElementById(tmpEinheit).options[document.getElementById(tmpEinheit).selectedIndex];
                                }
                            }
                        } else if (elems[i].childNodes[j].childNodes[k].id === "zutatenzutat") {
                            for (let n=0; n<elems[i].childNodes[j].childNodes[k].childNodes.length; n++) {
                                if (elems[i].childNodes[j].childNodes[k].childNodes[n].id !== undefined && elems[i].childNodes[j].childNodes[k].childNodes[n].id !== "") {
                                    var tmpZutat = elems[i].childNodes[j].childNodes[k].childNodes[n].id;
                                    zutat = document.getElementById(tmpZutat).options[document.getElementById(tmpZutat).selectedIndex];
                                }
                            }
                        } else if (elems[i].childNodes[j].childNodes[k].id === "zutatenzusatz") {
                            for (let o=0; o<elems[i].childNodes[j].childNodes[k].childNodes.length; o++) {
                                if (elems[i].childNodes[j].childNodes[k].childNodes[o].id !== undefined && elems[i].childNodes[j].childNodes[k].childNodes[0].id !== "") {
                                    zusatz = elems[i].childNodes[j].childNodes[k].childNodes[o].id;
                                }
                            }
                        }
                    }
                    var new_obj = {
                        'anzahl':document.getElementById(anzahl).value,
                        'einheit':einheit.id,
                        'zutat': zutat.id,
                        'zusatz': document.getElementById(zusatz).value
                    };
                    zutatenliste.push(new_obj);
                }
            }
        }
    }
}

function ermittleKategorienliste() {
    let elems22 = document.getElementById('sortable2').childNodes;
    let varKategorie = null;

    for (let i2=0; i2<elems22.length; i2++) {
        if (elems22[i2].id === "kategoriereihe") {
            for (let j3=0; j3<elems22[i2].childNodes.length; j3++) {
                if (elems22[i2].childNodes[j3].id === "kategorierow") {
                    for (let k2=0; k2<elems22[i2].childNodes[j3].childNodes.length; k2++) {
                        if (elems22[i2].childNodes[j3].childNodes[k2].id === "kategorieinstanz") {
                            for (let l2=0; l2<elems22[i2].childNodes[j3].childNodes[k2].childNodes.length; l2++) {
                                if (elems22[i2].childNodes[j3].childNodes[k2].childNodes[l2].id !== undefined && elems22[i2].childNodes[j3].childNodes[k2].childNodes[l2].id !== "") {
                                    varKategorie = elems22[i2].childNodes[j3].childNodes[k2].childNodes[l2].id;
                                    var selected = document.getElementById(varKategorie);
                                    var opt5 = selected.options[selected.selectedIndex];
                                    console.log(opt5);
                                    var new_obj2 = {
                                        'id':opt5.id,
                                    };

                                    kategorienliste.push(new_obj2);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


$(document).ready(function(){

    //Beim Klick auf speichern
    $(".btn-submit").click(function() {
        var anzahlPortionen,
            rezept;


        if ("" === document.getElementById("rezepttitel").value) {
            document.getElementById('modalbody').innerText = "Bitte geben Sie einen Rezepttitel ein!";
            $("#exampleModal").modal();
            document.getElementById("rezepttitel").style.border = "2px solid red";
        } else {

            ermittleZutatenliste();
            ermittleKategorienliste();

            if ("" === document.getElementById("anzahlPortionen").value) {
                anzahlPortionen = 0;
            }


            if (document.getElementById("rezepttitel").value.length > 0) {
                rezept = {
                    "titel": document.getElementById("rezepttitel").value,
                    "durchfuehrung": document.getElementById("durchfuehrung").value,
                    "anzahlPortionen" : anzahlPortionen,
                    "einheit" : "Portionen",
                    "kochzeit" : document.getElementById("kochzeit").value,
                    "vorbereitungszeit" : document.getElementById("vorbereitungszeit").value,
                    "zutatenliste" : zutatenliste,
                    "kategorienliste" : kategorienliste
                };

                $.ajax({
                    type: "POST",
                    data: {event: JSON.stringify(rezept)},
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    url: 'db/saveNewRecipe.php',
                    success: function(php_script_response){
                        window.location.href = "uebersicht.php";
                    }
                });
            }
        }
    });

    //Die Liste der möglichen Kategorien wird geladen;
    $.ajax({
        type:'GET',
        url:'db/getCategoryList.php',
        dataType: "json",

        success:function(moeglicheKategorien){
            var kategorie,
                kategorienContainer = document.getElementById("kategorieSelect1");

            for (var i = 0; i < moeglicheKategorien.length; i++) {
                kategorie = document.createElement("option");
                kategorie.text = moeglicheKategorien[i].kategorie;
                kategorie.id = moeglicheKategorien[i].id;
                kategorienContainer.add(kategorie);
            }
        },
        error: function (error) {
            console.log('Fehler');
            alert(" Can't do because: " + error);
        },
    });

    //Die Liste der möglichen Zutaten wird geladen
    $.ajax({
        type:'GET',
        url:'db/getIngredientList.php',
        dataType: "json",

        success:function(moeglicheZutaten){
            var zutat,
                zutatenContainer = document.getElementById("zutatSelect1");

            for (var i = 0; i < moeglicheZutaten.length; i++) {
                zutat = document.createElement("option");
                zutat.text = moeglicheZutaten[i].zutat;
                zutat.id = moeglicheZutaten[i].id;
                zutatenContainer.add(zutat);
            }
        },
        error: function (error) {
            console.log('Fehler');
            alert(" Can't do because: " + error);
        },
    });

    //Die Liste der möglichen Einheiten wird gelesen
    $.ajax({
        type:'GET',
        url:'db/getUnitList.php',
        dataType: "json",

        success:function(moeglicheEinheiten){
            var einheit,
                einheitenContainer = document.getElementById("einheitSelect1");

            for (var i = 0; i < moeglicheEinheiten.length; i++) {
                einheit = document.createElement("option");
                einheit.text = moeglicheEinheiten[i].einheit;
                einheit.id = moeglicheEinheiten[i].id;
                einheitenContainer.add(einheit);

            }
        },
        error: function (error) {
            console.log('Fehler');
            alert(" Can't do because: " + error);
        },
    });
});