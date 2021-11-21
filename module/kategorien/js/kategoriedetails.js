$(document).ready(function(){

	    var number = getUrlVars()["q"];


    $.ajax({
        type:'GET',
        url:'../backend/getRezepteZuKategorie.php',
        dataType: "json",
        data: {
            'rezeptId': number
        },
        success:function(data){
            var rezeptliste = document.getElementById('kategorien');

            for (var i = 0; i < data.length; i++) {
                console.log(i);

                var g = document.createElement('div');
                g.classList.add("col-lg-4", "col-sm-6");

                var box = document.createElement('div');
                box.classList.add("box", "grid", "recipes");

                var by = document.createElement('div');
                by.classList.add("by");

                var i2 = document.createElement("i");
                i2.classList.add("fa", "fa-user");
                by.appendChild(i2);

                var a = document.createElement('a');
                a.href = "../../rezeptdetails/masken/rezeptdetails.php?q=" + data[i].id;
                var img = document.createElement('img');


                if (data[i].bildpfad.length > 0) {
                    img.src = '../../../' + data[i].bildpfad;
                } else {
                    img.src = '../../../images/kein-bild-vorhanden.jpg';
                }

                a.appendChild(img);
                box.appendChild(by);
                box.appendChild(a);

                var a2 = document.createElement('a');
                var linkText = document.createTextNode(data[i].titel);
                a2.appendChild(linkText);
                a2.href = "../../rezeptdetails/masken/rezeptdetails.php?q=" + data[i].id;
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

function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
});
