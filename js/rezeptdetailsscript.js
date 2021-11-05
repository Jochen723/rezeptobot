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

                    //Zutaten
                    erstelleZutatenliste(data);

                    //Durchführung
                    erstelleDurchfuehrung(data);

                    //Rezeptbild
                    erstelleBild(data);

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
        $(".btn-geplant").click(function() {
            onRezeptPlanen();
        });

        $(".btn-heutegekocht").click(function() {
            onHeuteGekocht();
        });

        $(".btn-wunderlist").click(function() {
            onWunderlist();
        });

        $(".btn-less-yield").click(function() {
            onLessButton();
        });

        $(".btn-more-yield").click(function() {
            onMoreButton();
        });

        $(".btn-delete").click(function() {
            onDelete();
        });
    }

    function erstelleTitel(data) {
        var today =  new Date(data.generalInformations.hinzugefuegt);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        document.getElementById('rezeptdatum').innerHTML = dd + '.' + mm + '.' + yyyy;
        document.getElementById('rezepttitel').innerHTML = data.generalInformations.titel;
    }

    function erstelleZutatenliste(data) {
        var ColorsAvailable = document.getElementById('bodymodal');

        for (var i = 0; i < data.ingredients.length; i++) {

            var ul = document.getElementById("ingredients");
            var li = document.createElement("li");
            var test = data.ingredients[i].anzahl == null ? '' : data.ingredients[i].anzahl;
            test = test.replace(".0" , "");
            test = test.replace("." , ",")
            var zusatz = data.ingredients[i].zusatz
            var inhalt = test + ' ' + data.ingredients[i].einheit + ' ' + data.ingredients[i].zutat;
            if (data.ingredients[i].zusatz !== null && data.ingredients[i].zusatz.length > 0 && data.ingredients[i].zusatz !== "null") {
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
    }

    function erstelleDurchfuehrung(data) {
        data.generalInformations.durchfuehrung.replace(/↵/, '<br/>');
        var ol = document.getElementById("zubereitung");
        var li2 = document.createElement("li")
        var myDiv = document.createElement("div");
        myDiv.id = 'myDiv';
        myDiv.innerHTML = data.generalInformations.durchfuehrung;
        li2.appendChild(myDiv);
        ol.appendChild(li2);
    }

    function erstelleBild(data) {
        document.getElementById("recipe_image").src=data.generalInformations.bildpfad;
    }

    function erstelleZusaetzlicheInformationen(data) {
        //Portionen
        var por = document.getElementById("portionen");
        var pe = document.createElement("p");
        var x = document.createElement("STRONG");
        pe.appendChild(x);
        var i2 = document.createElement("i");
        i2.classList.add("fa", "fa-users");
        x.appendChild(i2);
        var x2 = document.createElement("B");
        var t = document.createTextNode(" " + data.generalInformations.anzahlPortionen + " " + data.generalInformations.einheit);
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
        var t2 = document.createTextNode(" " + data.generalInformations.vorbereitungszeit + " Minuten");
        x3.appendChild(t2);
        x2.appendChild(x3);
        por2.appendChild(pe2);

        //Kochzeit
        var por3 = document.getElementById("kochzeit");
        var pe3 = document.createElement("p");
        var x3 = document.createElement("STRONG");
        pe3.appendChild(x3);
        var i4 = document.createElement("i");
        i4.classList.add("fa", "fa-clock-o");
        x3.appendChild(i4);
        var x4 = document.createElement("B");
        var t3 = document.createTextNode(" " + data.generalInformations.kochzeit + " Minuten");
        x4.appendChild(t3);
        x3.appendChild(x4);
        por3.appendChild(pe3);
    }

    function onRezeptPlanen() {
        var number = getUrlVariables()["q"];
        var test = document.getElementById('modalDateGeplant').value;
        var test2 = renderDateArray(test);

        if (test2.length == 3) {
            var myObj = {
                "datum": test2[2] + '-' + test2[0] + '-' + test2[1],
                "titel" : document.getElementById('rezepttitel').innerHTML,
                "farbe" : "#00cc99",
                "rezept_id" : number
            }

            $.ajax({
                type: "POST",
                data: {event: JSON.stringify(myObj)},
                dataType: 'text',  // what to expect back from the PHP script, if anything
                url: 'db/saveEvent.php',
                success: function(php_script_response){
                    $('#planenmodal').modal('hide');
                }
            });
        }
    }

    function onHeuteGekocht() {
        var number = getUrlVariables()["q"];

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;
        var myObj = {
            "datum": yyyy+'-'+mm+'-'+dd,
            "titel" : document.getElementById('rezepttitel').innerHTML,
            "farbe" : "#00cc99",
            "rezept_id" : number
        }


        $.ajax({
            type: "POST",
            data: {event: JSON.stringify(myObj)},
            dataType: 'text',  // what to expect back from the PHP script, if anything
            url: 'db/saveEvent.php',
            success: function(php_script_response){
                $('#heutegekochtmodal').modal('hide');

            }
        });
    }

    function onWunderlist() {
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
    }

    function onMoreButton() {
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
    }

    function onLessButton() {
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
    }

    function onDelete() {
        var number = getUrlVariables()["q"];

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = mm + '/' + dd + '/' + yyyy;
        var myObj = {
            "datum": yyyy+'-'+mm+'-'+dd,
            "titel" : document.getElementById('rezepttitel').innerHTML,
            "farbe" : "#00cc99",
            "rezept_id" : number
        }


        $.ajax({
            type: "POST",
            data: {
                'rezeptId': getUrlVariables()["q"]
            },
            dataType: "json",
            url: 'db/deleteRecipe.php',
            success: function(php_script_response){
                alert("deleted")
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

    function getUrlVariables() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }

    function renderDate(date) {
        var res = date.split("/");

        return res[2] + '-' + res[0] + '-' + res[1];
    }

    function renderDateArray(date) {
        var res = date.split("/");
        return res;
    }
});