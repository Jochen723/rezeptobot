$(document).ready(function(){
    
    $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
    });

    $(".btn-login").click(function() {

        var mail = document.getElementById('mail').value;
        var pw = document.getElementById('passwort').value;

        if (validateEmail(mail)) {
            document.getElementById("loginFailed").style.display = "none";
            $.ajax({
                type:'GET',
                url:'../backend/getLogin.php',
                dataType: "json",
                data: {
                    'mail': mail,
                    'pass': pw,
                },
                error: function () {
                    document.getElementById("loginFailed").innerHTML = "Benutzername oder Passwort falsch.";
                        document.getElementById("loginFailed").style.display = "inline";  
                    $("#overlay").fadeOut(300);
                  }
            }).done(function(data) {
                setTimeout(function(){
                    if (data.nutzernameVorhanden === false || data.passwortKorrekt == false) {
                        document.getElementById("loginFailed").innerHTML = "Benutzername oder Passwort falsch.";
                        document.getElementById("loginFailed").style.display = "inline";  
                    } else {
                        window.location.href = "../../startseite/masken/startseite.php";
                    }
                    $("#overlay").fadeOut(300);
                },500);
              });
          } else {
            document.getElementById("loginFailed").innerHTML = "Bitte geben Sie eine valide E-Mail Adresse ein."; 
            document.getElementById("loginFailed").style.display = "inline";        
          }
    });

    function validateEmail(mail) {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        return mail.match(validRegex);
    }
});