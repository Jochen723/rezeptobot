$(document).ready(function(){

    var zutatenliste = [];

    onEntry();
    registerButtons();

    function onEntry() {
        befuelleZutatenliste();
    }

    function registerButtons() {
        $(".btn-submit").click(function() {
            onRezepteNachZutatenSuchen();
        });
    }

    function befuelleZutatenliste() {
        $.ajax({
            type:'GET',
            url:'../backend/getZutaten.php',
            dataType: "json",

            success:function(data){
                var x = document.getElementById("zutatSelect1");
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
    }

    function onRezepteNachZutatenSuchen() {

        zutatenliste = [];
        ermittleZutatenliste();

        var selected = document.getElementById('zutatSelect1');
        var opt = selected.options[selected.selectedIndex];
        var test = opt.id;

        rezept = {
            "zutatenliste" : zutatenliste,
        };

        $.ajax({
            type:'POST',
            data: {event: JSON.stringify(rezept)},
            url:'../backend/getRezepteNachZutaten.php',
            dataType: "json",

            success:function(data){
                var rezeptliste = document.getElementById('rezeptliste');
                rezeptliste.innerHTML = '';

                for (var i = 0; i < data.response.length; i++) {
                    var g = document.createElement('div');
                    g.classList.add("col-lg-4", "col-sm-6");
                    g.id = "recipe" + (i+1);

                    var box = document.createElement('div');
                    box.classList.add("box", "grid", "recipes");

                    var by = document.createElement('div');
                    by.classList.add("by");

                    var i2 = document.createElement("i");
                    i2.classList.add("fa", "fa-user");
                    by.appendChild(i2);

                    var a = document.createElement('a');
                    a.href = "../../rezeptdetails/masken/rezeptdetails.php?q=" + data.response[i].id;
                    var img = document.createElement('img');

                    if (data.response[i].bildpfad.length > 0) {
                        img.src = '../../../' + data.response[i].bildpfad;
                    } else {
                        img.src = '../../../images/kein-bild-vorhanden.jpg';
                    }

                    a.appendChild(img);
                    box.appendChild(by);
                    box.appendChild(a);

                    var a2 = document.createElement('a');
                    a2.id = "recipe_title" + (i+1);
                    var linkText = document.createTextNode(data.response[i].titel);
                    a2.appendChild(linkText);
                    a2.href = "../../rezeptdetails/masken/rezeptdetails.php?q=" + data.response[i].id;
                    var h = document.createElement("H2");

                    h.appendChild(a2);
                    box.appendChild(h);

                    g.appendChild(box);
                    rezeptliste.appendChild(g);
                }
            },
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
        });
    }

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
                            'zutat': zutat.id,
                        };
                        zutatenliste.push(new_obj);
                    }
                }
            }
        }
    }
});