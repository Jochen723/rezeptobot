function validateEmail(email) {
    var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return re.test(email);
}

$(document).ready(function(){

    $(".btn-regis").click(function() {
        var mail = document.getElementById('mail').value;
        var pw1 = document.getElementById('passwort').value;
        var pw2 = document.getElementById('passwortWiederholen').value;

        if (!validateEmail(mail)) {
            alert("Mail nicht valide");
        } else {
            if (pw1 !== pw2) {
                alert("Passwörter stimmen nicht überein");
            } else {
                if (pw1 === '') {
                    alert("Bitte Passwort eingeben");
                } else {
                    $.ajax({
                        type:'GET',
                        url:'db/checkRegistrierung.php',
                        dataType: "json",
                        data: {
                            'mail': mail,
                            'pass': pw1,
                        },
                        success:function(data){
                            if (data.vorhanden === true) {
                                alert("Mail-Adresse ist bereits vorhanden");
                            } else {
                                alert("Registrierung erfolgreich");
                                window.location.href = "login.php";
                            }
                        },
                    });
                }
            }
        }
    });
});