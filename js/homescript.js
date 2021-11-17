$(document).ready(function(){

    $.ajax({
        type:'GET',
        url:'db/getNextPlannedRecipe.php',
        dataType: "json",
        data: {
        },
        success:function(data){
            if(!data.success) {
                alert(data.reason);
            } else {

                data.response.forEach(function (rezept) {
                    var te = document.getElementById('nextPlanned');
                    var div1 =document.createElement("div");
                    div1.className = 'col-lg-4';
                    var div2 =document.createElement("div");
                    div2.className = 'box clearfix';
                    var h6 = document.createElement ("h6");
                    h6.align = 'center';
                    h6.innerHTML = renderDate2(rezept.datum);
                    var a = document.createElement('a');
                    a.setAttribute('href','rezeptdetails.php?q='+rezept.rezept_id);

                    var img = document.createElement('img');
                    img.src = rezept.bildpfad;
                    a.appendChild(img);

                    var h3 = document.createElement ("h3");
                    h3.innerHTML += rezept.titel.link('rezeptdetails.php?q='+rezept.rezept_id);
                    div2.appendChild(h6);
                    div2.appendChild(a);
                    div2.appendChild(h3);
                    div1.appendChild(div2);
                    te.appendChild(div1);
                });

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


    //Rezept wird aus der Datenbank geladen
    $.ajax({
        type:'GET',
        url:'db/getMostPopularRecipe.php',
        dataType: "json",
        data: {
        },
        success:function(data){
            if(!data.success) {
                alert(data.reason);
            } else {

              data.response.forEach(function (rezept) {
                var te = document.getElementById('mostPopular');
                var div1 =document.createElement("div");
                div1.className = 'col-lg-4';
                var div2 =document.createElement("div");
                div2.className = 'box clearfix';
                var h6 = document.createElement ("h6");
                h6.align = 'center';
                h6.innerHTML = rezept.anzahl + 'x';
                var a = document.createElement('a');
                a.setAttribute('href','rezeptdetails.php?q='+rezept.rezept_id);

                var img = document.createElement('img');
                img.src = rezept.bildpfad;
                a.appendChild(img);

                var h3 = document.createElement ("h3");
                h3.innerHTML += rezept.titel.link('rezeptdetails.php?q='+rezept.rezept_id);
                div2.appendChild(h6);
                div2.appendChild(a);
                div2.appendChild(h3);
                div1.appendChild(div2);
                te.appendChild(div1);
              });

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

    function renderDate2(date) {
        var res = date.split("-");

        return res[2] + '.' + res[1] + '.' + res[0];
    }



});
