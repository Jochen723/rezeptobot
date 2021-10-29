$(document).ready(function(){

    onEntry();
    registerButtons();

    function onEntry() {
        getIngredients();
        getUnits();
        getCategories();
    }

    function registerButtons() {
        $(".btn-submit").click(function() {
            onRezeptSpeichern();
        });
    }

    function getIngredients() {
        $.ajax({
            type:'GET',
            url:'db/getIngredientList.php',
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

    function getUnits() {
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
    }

    function getCategories() {
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
    }

    function onRezeptSpeichern() {

        //Check, ob Rezpettitel vorhanden

        if (document.getElementById("rezepttitel").value == "") {
            document.getElementById('modalbody').innerText = "Bitte geben Sie einen Rezepttitel ein!";
            //$("#exampleModal").modal();
            //document.getElementById("rezepttitel").style.border = "2px solid red";


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

            if (passt) {
                var myObj = {
                    "titel": titel,
                    "durchfuehrung": durchfuehrung,
                    "anzahlPortionen" : anzahlPortionen,
                    "einheit" : "Portionen",
                    "kochzeit" : kochzeit,
                    "vorbereitungszeit" : vorbereitungszeit,
                    "zutatenliste" : jsonTest,
                    "kategorienliste" : jsonTest2
                }


                $.ajax({
                    type: "POST",
                    data: {event: JSON.stringify(myObj)},
                    dataType: 'text',
                    url: 'db/saveNewRecipe.php',
                    success: function(php_script_response){
                        window.location.href = "uebersicht.php";
                    }
                });
            }
        }
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
});