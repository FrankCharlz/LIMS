var radius = 16;
var opacity = 0.5;

var redCircle = {
    color: '#f03',
    fillColor: '#f03',
    fillOpacity: opacity,
    radius: radius
};

var greenCircle = {
    color: 'red',
    fillColor: 'red',
    fillOpacity: opacity,
    radius: radius
};


$(document).ready(function () {
    var map = L.map('map').setView([-6.8512, 39.2544], 14);

    map.options.singleClickTimeout = 200;



    var popup = L.popup();

    function mapClicked(e) {

        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        var latlng = lat.toString()+'/'+lng.toString();

        var content = "<h4>Latitude: "+lat+'<br>Longitude: '+lng
            +"</h4><br><a href=plots/add/"+latlng+">Add plot information to database</a>"
            +"<br><a href=plots/view/"+latlng+">View plot information</a>";

        popup
            .setLatLng(e.latlng)
            .setContent(content)
            .openOn(map);
    }

    map.on('singleclick', mapClicked);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy;<a href="http://osm.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    /* end of map codes */
    $('#btn-show-plots').click(function () {

        $.get( "/api/plots", function(data) {
            console.log(data);
            for (var i = 0; i<data.length; i++) {
                var circle = L.circle([data[i].latitude, data[i].longitude], greenCircle).addTo(map);

                var popup = L.popup();
                popup.setContent('<h4>Plot '+data[i].plot_number+'</h4><br>'
                    +"<br><a href=plots/view/"+data[i].plot_id+">View plot information</a>"
                );

                circle.bindPopup(popup);

                if (i == 73) break;
            }
        });

    });


});
