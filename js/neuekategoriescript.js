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
            url:'db/saveNewCategory.php',
            dataType: "json",

            success:function(data){
                window.location.href = "kategorien.php";
            },
            error: function (request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
        });
    }
});