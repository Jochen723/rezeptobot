$(document).ready(function(){
    $(".btn-login").click(function() {
        var mail = document.getElementById('mail').value;
        var pw = document.getElementById('passwort').value;

        $.ajax({
            type:'GET',
            url:'../backend/getLogin.php',
            dataType: "json",
            data: {
                'mail': mail,
                'pass': pw,
            },
            success:function(data) {
                if (data.nutzernameVorhanden === false) {
                    alert("Der Benutzername ist nicht vorhanden");
                } else if (data.passwortKorrekt == false) {
                    alert("Passwort ist falsch");
                } else {
                    window.location.href = "../../startseite/masken/startseite.php";
                }
            },
        });
    });
});
