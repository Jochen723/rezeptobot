$(document).ready(function(){

    onEntry();
    registerButtons();

    function onEntry() {
        befuelleKategorienliste();
    }

    function registerButtons() {
        $(".btn-submit").click(function() {
            onKategorieLoeschen();
        });
    }

    function befuelleKategorienliste() {
        $.ajax({
            type:'GET',
            url:'../backend/getKategorien.php',
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

    function onKategorieLoeschen() {
        var selected = document.getElementById('kategorieSelect1');
        var opt = selected.options[selected.selectedIndex];
        var test = opt.id;
        alert(test);

        var myObj = {
            "kategorie": test
        }

        $.ajax({
            type:'POST',
            data: {event: JSON.stringify(myObj)},
            url:'../backend/deleteKategorie.php',
            dataType: "json",

            success:function(data){
              window.location.href = "../masken/kategorieuebersicht.php";
            },
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
        });
    }
});
