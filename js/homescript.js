$(document).ready(function(){

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
                
                Object.entries(data.response).forEach(entry => {
                    var te = document.getElementById('mostPopular');
                    var div1 =document.createElement("div");
                    div1.className = 'col-lg-4';
                    var div2 =document.createElement("div");
                    div2.className = 'box clearfix';
                    var h6 = document.createElement ("h6");
                    h6.align = 'center';
                    h6.innerHTML = i+1 + '.';
                    var a = document.createElement('a');
                    a.setAttribute('href','');

                    var img = document.createElement('img');
                    img.src = 'images/526586-420x280-fix-brokkoli-schinken-quiche.jpeg';
                    a.appendChild(img);


                    var h3 = document.createElement ("h3");
                    h3.innerHTML += 'Das leckerste Rezept'.link('');
                    div2.appendChild(h6);
                    div2.appendChild(a);
                    div2.appendChild(h3);
                    div1.appendChild(div2);
                    te.appendChild(div1);
                });

                for (var i = 0; i < data.response.length; i++) {

                }



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


});