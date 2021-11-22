$(document).ready(function(){

    registerButtons();

    function registerButtons() {
        $(".btn-submit").click(function() {
            onKategorieSpeichern();
        });
    }

    function onKategorieSpeichern() {

        var myObj = {
            "kategorie": document.getElementById("kategorietitel").value,
        }

        $.ajax({
            type:'POST',
            data: {event: JSON.stringify(myObj)},
            url:'../backend/postKategorie.php',
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
