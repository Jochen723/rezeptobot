function renderDate(date) {
    var res = date.split("/");
    return res[2] + '-' + res[0] + '-' + res[1];
}
function renderDate2(date) {
    var res = date.split("-");
    return res[1] + '/' + res[2] + '/' + res[0];
}

var carName = "Volvo";
var newDate = "";

$( document ).ready(function() {
  var ttt = [];
  var event22 = 'test';

  $.ajax({
    type:'GET',
    url:'db/loadEvents.php',
    dataType: "json",
    success:function(data){
      for (var i = 0; i < data.length; i++) {
        var tttt = {
          id: data[i].event_id,
          title : data[i].titel,
          start : data[i].datum,
          backgroundColor : data[i].farbe
        };

        ttt.push(tttt);
      }

      $('#calendar').fullCalendar({
        events: ttt,
        header: {
          left: 'prev,next today',
          center: 'custom1',
          right: 'title'
        },
        eventClick: function(info) {
          carName = info;
          document.getElementById('modalDate').value=renderDate2(info.start._i);
          document.getElementById('modalTitel').innerHTML = info.title;
          document.getElementById('modalDate').name = info.id;
          $("#changeModal").modal();
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
    },
  });

  $("#deleteEvent").click(function(){
    var ev = carName;

    var myObj = {
        "event_id" : ev.id
    }

    $.ajax({
      type: "POST",
      data: {event: JSON.stringify(myObj)},
      dataType: "text",
      url: 'db/deleteEvent.php',
      success: function(php_script_response){
        $('#calendar').fullCalendar( 'removeEvents', ev.id );
        $('#changeModal').modal('hide');
    }
  });
});

  $("#changeTarget").click(function(){
    newDate = renderDate(document.getElementById('modalDate').value);
    var myObj = {
      "datum": newDate,
      "event_id" : document.getElementById('modalDate').name
    }

    $.ajax({
      type: "POST",
      data: {event: JSON.stringify(myObj)},
      dataType: "text",
      url: 'db/updateEvent.php',
      success: function(php_script_response){
        var ev = carName;
      ev.start._i = newDate;
      $('#calendar').fullCalendar( 'removeEvents', ev.id );
      $('#calendar').fullCalendar('renderEvent', {
        title: ev.title,
        start: newDate,
        allDay: true,
        backgroundColor : ev.backgroundColor
      });
      $('#changeModal').modal('hide');
    }
  });
});

$("#target").click(function(){
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

    $('#calendar').fullCalendar('renderEvent', {
        title: titel,
        start: renderDate(document.getElementById('date').value),
        allDay: true,
        backgroundColor : color
    });

    $.ajax({
        type: "POST",
        data: {event: JSON.stringify(myObj)},
        dataType: "json",
        url: 'db/saveEvent.php',
    });

    $('#exampleModal').modal('hide');
});

$('#exampleModal').on('shown.bs.modal', function () {

var elem = document.getElementById("selectArt");
elem.addEventListener("change", test);

function test() {
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
}
})
});
