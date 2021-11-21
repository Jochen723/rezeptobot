$(document).ready(function(){

    $.ajax({
        type:'GET',
        url:'../backend/getRezeptuebersicht.php',
        dataType: "json",
        data: {
            'rezeptId': 1
        },
        success:function(data){
            var rezeptliste = document.getElementById('rezeptliste');

            for (var i = 0; i < data.length; i++) {
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
                a2.href = "rezeptdetails.php?q=" + data[i].id;
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
});
