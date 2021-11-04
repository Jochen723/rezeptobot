$(document).ready(function(){

    onEntry();
    registerButtons();

    function onEntry() {
        //Rezept wird aus der Datenbank geladen
        $.ajax({
            type:'GET',
            url:'db/getFullRecipe.php',
            dataType: "json",
            data: {
                'rezeptId': getUrlVariables()["q"]
            },
            success:function(data){
                if(!data.success) {
                    alert(data.reason);
                } else {
                    //Rezepttitel
                    erstelleTitel(data);

                    erstelleKategorienliste(data);

                    erstelleZutatenliste(data);

                    //Durchführung
                    erstelleDurchfuehrung(data);

                    //Weitere Informationen
                    erstelleZusaetzlicheInformationen(data);
                }
            },
            error: function (xhr, txtStatus, errThrown) {
                console.log(
                    "XMLHttpRequest: ", xhr,
                    " Status:", txtStatus,
                    " Error:",  errThrown
                );
            },
        });
    }

    function registerButtons() {
        $(".btn-submit").click(function() {
            onRezeptaenderungSpeichern();
        });
    }

    function erstelleTitel(data) {
        document.getElementById('rezepttitel').value = data.generalInformations.titel;
    }

    function erstelleKategorienliste(data) {

        if (data.categories.length == 0) {
            befuelleEinzigeLeereKategorienliste();
        } else {
            for (var i = 0; i < data.categories.length; i++) {
                var idKategorie = "kategorieSelect" + (i+1);
                if (i == 0) {
                    belegeVorhandeneKategorienzeileVor(idKategorie, data.categories[i].id, data.categories[i].kategorie);
                } else {
                    erstelleNeueLeereKategorienzeile(idKategorie);
                    belegeVorhandeneKategorienzeileVor(idKategorie, data.categories[i].id, data.categories[i].kategorie);
                }
            }
        }
    }

    function erstelleZutatenliste(data) {
        if (data.ingredients.length == 0) {
            befuelleEinzigeLeereZutatenzeile('zutatSelect1', 'einheitSelect1');
        } else {
            for (var i = 0; i < data.ingredients.length; i++) {
                var idZutat = "zutatSelect" + (i+1);
                var idEinheit = "einheitSelect" + (i+1);
                var idAnzahl = "anzahlSelect" + (i+1);
                var idZusatz = "zusatzSelect" + (i+1);

                if (i == 0) {
                    befuelleEinzigeLeereZutatenzeile(idZutat, idEinheit, idAnzahl, idZusatz,
                      data.ingredients[i].zutatenliste_id, data.ingredients[i].einheit_id,
                      data.ingredients[i].anzahl, data.ingredients[i].zusatz);
                } else {
                    erweitereZutatenliste(idAnzahl, idEinheit, idZutat, idZusatz);
                    befuelleEinzigeLeereZutatenzeile(idZutat, idEinheit, idAnzahl,idZusatz,
                      data.ingredients[i].zutatenliste_id, data.ingredients[i].einheit_id,
                      data.ingredients[i].anzahl, data.ingredients[i].zusatz);
                }
            }
        }
    }

    function erstelleDurchfuehrung(data) {
        var test = data.generalInformations.durchfuehrung;
        document.getElementById('durchfuehrung').value = test;
    }

    function erstelleZusaetzlicheInformationen(data) {
        document.getElementById('anzahlPortionen').value = data.generalInformations.anzahlPortionen;
        document.getElementById('vorbereitungszeit').value = data.generalInformations.vorbereitungszeit;
        document.getElementById('kochzeit').value = data.generalInformations.kochzeit;
    }

    function belegeKompletteZutatenzeileVor(data, i, idZutat, idEinheit, idAnzahl) {
        belegeZutatenlisteVor(idZutat, data.ingredients[i].zutatenliste_id, data.ingredients[i].zutat);
        //belegeZutatenEinheitenlisteVor(idEinheit, data.ingredients[i].einheit_id, data.ingredients[i].einheit);
        //belegeZutatenAnzahllisteVor(idAnzahl, data.ingredients[i].anzahl);
    }

    function befuelleEinzigeLeereKategorienliste() {
        var idKategorie = "kategorieSelect1";
        $.ajax({
            type:'GET',
            url:'db/getCategoryList.php',
            dataType: "json",

            success:function(data){
                var x = document.getElementById(idKategorie);
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
    }

    function belegeVorhandeneKategorienzeileVor(idKategorie, kategorieId, kategorietext) {
        var x = document.getElementById(idKategorie);
        var option = document.createElement("option");
        option.text = kategorietext;
        option.id = kategorieId;
        x.add(option);
    }

    function erstelleNeueLeereKategorienzeile(idKategorie) {
        $("#sortable2").append('\
        <div id="kategoriereihe" class="box ui-sortable-handle">\
            <div id="kategorierow" class="row">\
                <div class="col-lg-2 col-sm-2">\
                    <i class="fa fa-arrows" aria-hidden="true"></i>\
                </div>\
                <div id="kategorieinstanz" class="col-lg-8 col-sm-8">\
                    <select class="form-control" name="category" id='+idKategorie+'></select>\
                </div>\
                <div class="col-lg-2 col-sm-2">\
                    <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>\
                </div>\
            </div>\
        </div>');
    }

    function befuelleEinzigeLeereZutatenzeile(idZutat, idEinheit, test, idZusatz, vorbelegungId, vorbelegung2, vorbelegung3, zusatztext) {
        $.ajax({
            type:'GET',
            url:'db/getIngredientList.php',
            dataType: "json",

            success:function(data){
                var x = document.getElementById(idZutat);
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement("option");
                    option.text = data[i].zutat;
                    option.id = data[i].id;
                    if (data[i].id == vorbelegungId) {
                      option.selected = 'selected';

                    }
                    x.add(option);

                    if (idZusatz) {
                        document.getElementById(idZusatz).value = zusatztext;
                    }
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
                var x = document.getElementById(idEinheit);
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement("option");
                    option.text = data[i].einheit;
                    option.id = data[i].id;
                    if (data[i].id == vorbelegung2) {
                      option.selected = 'selected';

                    }
                    x.add(option);
                }
            },
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
        });

        belegeZutatenAnzahllisteVor(test, vorbelegung3);
    }

    function erweitereZutatenliste(idAnzahl, idEinheit, idZutat, idZusatz) {
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
    }

    function erstelleNeueLeereKategorienzeile(idKategorie) {
        $("#sortable2").append('<div id="kategoriereihe" class="box ui-sortable-handle">\
              <div id="kategorierow" class="row">\
                <div class="col-lg-2 col-sm-2">\
                  <i class="fa fa-arrows" aria-hidden="true"></i>\
                </div>\
                <div id="kategorieinstanz" class="col-lg-8 col-sm-8">\
                <select class="form-control" name="category" id='+idKategorie+'></select>\
                </div>\
                <div class="col-lg-2 col-sm-2">\
                  <i class="fa fa-times-circle-o minusbtn" aria-hidden="true"></i>\
                </div>\
              </div>\
            </div>');
    }

    function belegeVorhandeneKategorienzeileVor(idKategorie, kategorieId, kategorietext) {
        var x = document.getElementById(idKategorie);
        var option = document.createElement("option");
        option.text = kategorietext;
        option.id = kategorieId;
        x.add(option);
    }

    function belegeZutatenEinheitenlisteVor(idEinheit, einheitId, einheitText) {
        var x = document.getElementById(idEinheit);
        var option = document.createElement("option");
        option.text = einheitText;
        option.id = einheitId;
        x.add(option);
    }

    function belegeZutatenAnzahllisteVor(idAnzahl, anzahl) {
        var zahl = anzahl;

        if (zahl) {
            zahl = zahl.replace(".0" , "");
            zahl = zahl.replace("." , ",")
            document.getElementById(idAnzahl).value = zahl;
        }

    }

    function onRezeptaenderungSpeichern() {
        if (document.getElementById("rezepttitel").value == "") {
            document.getElementById('modalbody').innerText = "Bitte geben Sie einen Rezepttitel ein!";
        } else {
            var jsonTest = readIngredients();
            var jsonTest2 = readCategories();
            var titel = document.getElementById("rezepttitel").value;
            var durchfuehrung = document.getElementById("durchfuehrung").value;
            var anzahlPortionen = document.getElementById("anzahlPortionen").value;
            var kochzeit = document.getElementById("kochzeit").value;
            var vorbereitungszeit = document.getElementById("vorbereitungszeit").value;

            if (anzahlPortionen == "") {
                anzahlPortionen = 0;
            }

            var passt = titel.length > 0;

            rezept = {
                "id": getUrlVariables()["q"],
                "titel": document.getElementById("rezepttitel").value,
                "durchfuehrung": document.getElementById("durchfuehrung").value,
                "anzahlPortionen" : anzahlPortionen,
                "einheit" : "Portionen",
                "kochzeit" : document.getElementById("kochzeit").value,
                "vorbereitungszeit" : document.getElementById("vorbereitungszeit").value,
                "zutatenliste" : ermittleZutatenliste(),
                "kategorienliste" : ermittleKategorienliste()
            };

            $.ajax({
                type:'POST',
                url:'db/saveChangedRecipe.php',
                data: {event: JSON.stringify(rezept)},
                dataType: "json",
                success:function(data){
                    window.location.href = "uebersicht.php";
                },
                error: function (xhr, txtStatus, errThrown) {
                    console.log(
                        "XMLHttpRequest: ", xhr,
                        " Status:", txtStatus,
                        " Error:",  errThrown
                    );
                },
            });
        }
    }

    function getUrlVariables() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }

    function readIngredients() {
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

        var new_obj = [];

        for (let i=0; i<elems.length; i++) {
            if (elems[i].id === "zutatenreihe") {
                elems2 = elems[i].childNodes;
                for (let j=0; j<elems2.length; j++) {
                    if (elems2[j].id === "zutatenrow") {
                        elems3 = elems2[j].childNodes;
                        for (let k=0; k<elems3.length; k++) {
                            if (elems3[k].id === "zutatenanzahl") {
                                elems4 = elems3[k].childNodes;
                                for (let l=0; l<elems4.length; l++) {
                                    if (elems4[l].id !== undefined && elems4[l].id !== "") {
                                        varanzahl = elems4[l].id;
                                    }
                                }
                            } else if (elems3[k].id === "zutateneinheit") {
                                elems5 = elems3[k].childNodes;
                                for (let m=0; m<elems5.length; m++) {
                                    if (elems5[m].id !== undefined && elems5[m].id !== "") {
                                        vareinheit = elems5[m].id;
                                        var selected = document.getElementById(vareinheit);
                                        opt = selected.options[selected.selectedIndex];
                                    }
                                }
                            } else if (elems3[k].id === "zutatenzutat") {
                                elems6 = elems3[k].childNodes;
                                for (let n=0; n<elems6.length; n++) {
                                    if (elems6[n].id !== undefined && elems6[n].id !== "") {
                                        varzutat = elems6[n].id;
                                        var selected = document.getElementById(varzutat);
                                        opt2 = selected.options[selected.selectedIndex];
                                    }
                                }
                            } else if (elems3[k].id === "zutatenzusatz") {
                                elems7 = elems3[k].childNodes;
                                for (let o=0; o<elems7.length; o++) {
                                    if (elems7[o].id !== undefined && elems7[0].id !== "") {
                                        varzusatz = elems7[o].id;
                                    }
                                }
                            }
                        }

                        new_obj.push({
                            'anzahl':document.getElementById(varanzahl).value,
                            'einheit':opt.id,
                            'zutat': opt2.id,
                            'zusatz': document.getElementById(varzusatz).value
                        });
                    }
                }
            }
        }

        return new_obj;
    }

    function readCategories() {
        let elems22 = document.getElementById('sortable2').childNodes;
        let elems23 = null;
        let elems24 = null;
        let elems25 = null;
        let varKategorie = null;

        for (let i2=0; i2<elems22.length; i2++) {
            if (elems22[i2].id === "kategoriereihe") {
                elems23 = elems22[i2].childNodes;
                for (let j3=0; j3<elems23.length; j3++) {
                    if (elems23[j3].id === "kategorierow") {
                        elems24 = elems23[j3].childNodes;
                        for (let k2=0; k2<elems24.length; k2++) {
                            if (elems24[k2].id === "kategorieinstanz") {
                                elems25 = elems24[k2].childNodes;
                                for (let l2=0; l2<elems25.length; l2++) {
                                    if (elems25[l2].id !== undefined && elems25[l2].id !== "") {
                                        varKategorie = elems25[l2].id;
                                        var selected = document.getElementById(varKategorie);
                                        var opt5 = selected.options[selected.selectedIndex];
                                        var new_obj2 = {
                                            'id':opt5.id,
                                        };

                                        return new_obj2;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function ermittleZutatenliste() {

        var zutatenliste = [];

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

        return zutatenliste;
    }

    function ermittleKategorienliste() {

        var kategorienliste = [];

        let elems22 = document.getElementById('sortable2').childNodes;
        let elems23 = null;
        let elems24 = null;
        let elems25 = null;
        let varKategorie = null;

        for (let i2=0; i2<elems22.length; i2++) {
            if (elems22[i2].id === "kategoriereihe") {
                elems23 = elems22[i2].childNodes;
                for (let j3=0; j3<elems23.length; j3++) {
                    if (elems23[j3].id === "kategorierow") {
                        elems24 = elems23[j3].childNodes;
                        for (let k2=0; k2<elems24.length; k2++) {
                            if (elems24[k2].id === "kategorieinstanz") {
                                elems25 = elems24[k2].childNodes;
                                for (let l2=0; l2<elems25.length; l2++) {
                                    if (elems25[l2].id !== undefined && elems25[l2].id !== "") {
                                        varKategorie = elems25[l2].id;
                                        var selected = document.getElementById(varKategorie);
                                        var opt5 = selected.options[selected.selectedIndex];
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

        return kategorienliste;
    }
});
