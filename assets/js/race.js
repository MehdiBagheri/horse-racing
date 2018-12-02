import $ from 'jquery';

require('../css/race.css');

$(document).ready(function () {

    $("#createRace").click(function () {
        var numberOfParticipants = $("#participants").val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: 'create',
            data: {numberOfParticipants: numberOfParticipants},
            cache: false,
            success: function (a, b, c) {
                var columnHeader = "<th>  </th>";
                var horseSpeed = "<td>Speed</td>";
                var horseStrength = "<td>Strength</td>";
                var horseEndurance = "<td>Endurance</td>";
                var horseDistance = "<td>Distance</td>";
                var horsePosition = "<td>Position</td>";
                var horseTimer = "<td>Timer</td>";
                for (var i = 0; i < a.length; i++) {

                    columnHeader += "<th>horse_" + (i + 1) + "</th>";
                    horseSpeed += "<td>" + a[i][0]['speed'] + "</td>";
                    horseStrength += "<td>" + a[i][0]['strength'] + "</td>";
                    horseEndurance += "<td>" + a[i][0]['endurance'] + "</td>";
                    horseDistance += "<td>" + a[i][1]['distance'] + "</td>";
                    horsePosition += "<td>" + a[i][1]['position'] + "</td>";
                    horseTimer += "<td>" + a[i][1]['time'] + "</td>";
                }

                $("#tableHeader").html(columnHeader);
                $("#horseSpeed").html(horseSpeed);
                $("#horseStrength").html(horseStrength);
                $("#horseEndurance").html(horseEndurance);
                $("#horseDistance").html(horseDistance);
                $("#horsePosition").html(horsePosition);
                $("#horseTime").html(horseTimer);
            }, error(a, b, c) {
                alert(JSON.stringify(a));
            }
        });
    });

    var trigger = null;
    $("#runTheRace").click(function () {
        trigger = setInterval(progress, 10000);
    });

    function progress() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: 'getResult',
            data: {},
            cache: false,
            success: function (a, b, c) {
                if (a != 'null') {
                    var horseDistance = "<td>distance</td>";
                    var horsePosition = "<td>position</td>";
                    var horseTime = "<td>timer</td>";
                    for (var i = 0; i < a.length; i++) {
                        horseDistance += "<td>" + a[i][1]['distance'] + "</td>";
                        horsePosition += "<td>" + a[i][1]['position'] + "</td>";
                        horseTime += "<td>" + a[i][1]['time'] + "</td>";
                    }
                    $("#horseDistance").html(horseDistance);
                    $("#horsePosition").html(horsePosition);
                    $("#horseTime").html(horseTime);
                } else {
                    clearInterval(trigger);
                }
            }, error(a, b, c) {
                alert(JSON.stringify(a));
            }
        });

    }
});

