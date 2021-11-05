$( document ).ready(function() {

    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
        format: 'dd.mm.yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options);




    //Das Event, welches geklickt wurde, muss zwischengespeichert werden
    var clickedEvent = '';

    ladeEventsUndErstelleKalender();
    registriereButtons();
    registriereAuswahlboxAlternativesGericht();

    function ladeEventsUndErstelleKalender() {

        var eventliste = [];
        $.ajax({
            type:'GET',
            url:'db/loadEvents.php',
            dataType: "json",
            success:function(data){

                for (var i = 0; i < data.length; i++) {
                    var eventObjekt = {
                        id: data[i].event_id,
                        title : data[i].titel,
                        start : data[i].datum,
                        backgroundColor : data[i].farbe
                    };
                    eventliste.push(eventObjekt);
                }

                erstelleKalender(eventliste);


            },
        });
    }

    function erstelleKalender(eventliste) {
        $('#calendar').fullCalendar({
            events: eventliste,
            header: {
                left: 'prev,next today',
                center: 'custom1',
                right: 'title'
            },
            firstDay: 1,
            height: 700,
            eventClick: function(info) {
                onEventGeklickt(info);
            },
            customButtons: {
                custom1: {
                    text: 'Alternatives Gericht hinzufügen',
                    click: function () {
                        $("#exampleModal").modal()
                    }
                }
            },
        });
    }

    function registriereButtons() {

        $("#deleteEvent").click(function(){
            onEventLoeschen();
        });

        $("#changeTarget").click(function(){
            onEventVerschieben();
        });

        $("#target").click(function(){
            onAlternativesGerichtHinzufuegen();
        });
    }

    function registriereAuswahlboxAlternativesGericht() {

        $('#exampleModal').on('shown.bs.modal', function () {
            zeigeEingabefeldAlternativesGericht();

        })

    }

    function zeigeEingabefeldAlternativesGericht() {
        var elem = document.getElementById("selectArt");
        elem.addEventListener("change", function() {
            if (document.getElementById("selectArt").value == "son") {
                if (null == document.getElementById("labelGericht")) {
                    var elem2 = document.getElementById("beschreibungDiv");
                    var label = document.createElement('label');
                    label.setAttribute("id", "labelGericht");
                    label.innerHTML  = "Titel des Rezepts";
                    var input = document.createElement("input");
                    input.type = "text";
                    input.setAttribute("id", "inputGericht");
                    input.classList.add("form-control");
                    elem2.appendChild(label);
                    elem2.appendChild(input);
                }
            } else {
                if (null !== document.getElementById("labelGericht")) {
                    document.getElementById("labelGericht").remove();
                    document.getElementById("inputGericht").remove();
                }
            }
        });
    }

    function onEventGeklickt(info) {

        clickedEvent = info;
        $.ajax({
            type: "GET",
            data: {
                'event_id': info.id
            },
            dataType: "json",
            url: 'db/getRecipeFromEvent.php',
            success: function(data) {

                if(!data.success) {
                    alert(data.reason);
                } else {
                    document.getElementById('modaltitellink').innerText = '';
                    document.getElementById('modaltitellink').href = '';

                    document.getElementById('modalDate').value=renderDate2(data.event.datum);
                    document.getElementById('modaltitellink').innerText = data.recipe.titel ? data.recipe.titel : data.event.titel;
                    document.getElementById('modaltitellink').href = data.recipe.id ? 'rezeptdetails.php?q='+data.recipe.id : '';
                    document.getElementById('modalDate').name = data.event.event_id;
                    if (data.recipe.bildpfad) {
                        document.getElementById('modalImage').src = data.recipe.bildpfad;
                    } else {
                        document.getElementById('modalImage').removeAttribute('src');
                    }
                    $("#changeModal").modal();
                }


            },
            error: function (xhr, txtStatus, errThrown) {
                console.log(
                    "XMLHttpRequest: ", xhr,
                    " Status:", txtStatus,
                    " Error:",  errThrown
                );
            }
        });
    }

    function onEventLoeschen() {
        var deletedEventObject = {
            "event_id" : clickedEvent.id
        }

        $.ajax({
            type: "POST",
            data: {event: JSON.stringify(deletedEventObject)},
            dataType: "text",
            url: 'db/deleteEvent.php',
            success: function(){
                $('#calendar').fullCalendar( 'removeEvents', clickedEvent.id );
                $('#changeModal').modal('hide');
            },
            error: function (xhr, txtStatus, errThrown) {
                console.log(
                    "XMLHttpRequest: ", xhr,
                    " Status:", txtStatus,
                    " Error:",  errThrown
                );
            },
        });
    }

    function onEventVerschieben() {
        var newDate = renderDate(document.getElementById('modalDate').value);
        var movedEventObject = {
            "datum": newDate,
            "event_id" : document.getElementById('modalDate').name
        }

        $.ajax({
            type: "POST",
            data: {event: JSON.stringify(movedEventObject)},
            dataType: "text",
            url: 'db/updateEvent.php',
            success: function() {
                clickedEvent.start._i = newDate;
                $('#calendar').fullCalendar( 'removeEvents', clickedEvent.id );
                $('#calendar').fullCalendar('renderEvent', {
                    title: clickedEvent.title,
                    id: clickedEvent.id,
                    start: newDate,
                    allDay: true,
                    backgroundColor : clickedEvent.backgroundColor
                });
                $('#changeModal').modal('hide');
            },
            error: function (xhr, txtStatus, errThrown) {
                console.log(
                    "XMLHttpRequest: ", xhr,
                    " Status:", txtStatus,
                    " Error:",  errThrown
                );
            }
        });
    }

    function onAlternativesGerichtHinzufuegen() {
        var color = '#00cc99';

        var e = document.getElementById("selectArt");
        var titel = e.options[e.selectedIndex].innerText;

        if (null != document.getElementById("inputGericht")) {
            titel = 'Alternativ: ' + document.getElementById("inputGericht").value;
        }

        if (document.getElementById("selectArt").value === 'ess') {
            color = '#FFCC99';
        } else if (document.getElementById("selectArt").value == 'aus') {
            color = '#66CCFF';
        } else {
            color = '#FFFFCC';
        }

        var myObj = {
            "datum": renderDate(document.getElementById('date').value),
            "rezept_id": 0,
            "titel" : titel,
            "farbe" : color
        }

        fuegeEventDemKalenderHinzu(titel, color);

        $.ajax({
            type: "POST",
            data: {event: JSON.stringify(myObj)},
            dataType: "json",
            url: 'db/saveEvent.php',
        });

        $('#exampleModal').modal('hide');
    }

    function fuegeEventDemKalenderHinzu(titel, color) {
        $('#calendar').fullCalendar('renderEvent', {
            title: titel,
            start: renderDate(document.getElementById('date').value),
            allDay: true,
            backgroundColor : color
        });
    }

    function renderDate(date) {
        var res = date.split(".");
        return res[2] + '-' + res[1] + '-' + res[0];
    }
    function renderDate2(date) {
        if (date) {
            var res = date.split("-");
            return res[1] + '/' + res[2] + '/' + res[0];
        }
        return '';

    }
});
