var radius = 16;
var opacity = 0.5;

var color1 = {
    color: '#c11d1d',
    fillColor: '#d22020',
    fillOpacity: opacity,
    radius: radius,
    weight: 1
};

var color2 = {
    color: '#ffa2e2',
    fillColor: '#b472a0',
    fillOpacity: opacity,
    radius: radius,
    weight: 1
};

var color3 = {
    color: '#9370DB',
    fillColor: '#8a69ce',
    fillOpacity: opacity,
    radius: radius,
    weight: 1
};

var color4 = {
    color: '#808080',
    fillColor: '#b4b4b4',
    fillOpacity: opacity,
    radius: radius,
    weight: 1
};

var colors = [color1, color2, color3, color4];

const DEFAULT_ZOOM = 14;
const DEFAULT_CENTER = [-6.8512, 39.2544];

$(document).ready(function () {

    //try to retrieve map state from session if exists
    var last_zoom = window.sessionStorage.getItem('last_zoom');
    var last_lat = window.sessionStorage.getItem('last_lat');
    var last_lng = window.sessionStorage.getItem('last_lng');

    var last_center = DEFAULT_CENTER;
    if (last_lat != null && last_lng != null) last_center = [parseFloat(last_lat), parseFloat(last_lng)];
    if (last_zoom == null) last_zoom = 14;


    var map = L.map('map', { center: last_center, zoom: last_zoom});

    var custom_content_1 = document.getElementById('custom-popup-content').outerHTML;
    var custom_content_2 = document.getElementById('custom-popup-content-2').outerHTML;

    L.tileLayer(
        'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy;<a href="http://osm.org/copyright">OpenStreetMap</a>',
            opacity: 0.5,
            maxZoom: 20,
            maxNativeZoom: 18 //to zoom beyond native
        }
    ).addTo(map);

    window.onbeforeunload = function(){
        // store map state to js session storage
        window.sessionStorage.setItem('last_zoom', map.getZoom());
        window.sessionStorage.setItem('last_lat', map.getCenter().lat);
        window.sessionStorage.setItem('last_lng', map.getCenter().lng);
        return null;
    };


    map.options.singleClickTimeout = 200;


    var popup = L.popup();

    function mapClicked(e) {

        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        var latlng = lat.toString()+'/'+lng.toString();

        var custom_content = custom_content_1.replaceAll('__LATLANG', latlng);
        console.log(custom_content);

        var content = "<h4>Latitude: "+lat+'<br>Longitude: '+lng +"</h4>"+ custom_content;

        popup
            .setLatLng(e.latlng)
            .setContent(content)
            .openOn(map);
    }

    map.on('singleclick', mapClicked);

    map.on('zoomend', function() {

    });

    var showSavedPlots = function () {

        $.get( "/plots/all", function(data) {
            console.log('got plots:'+ data.length);

            for (var i = 0; i<data.length; i++) {

                var boundaries = data[i]['boundaries'];


                boundaries = JSON.parse(boundaries);
                //console.log(boundaries);
                var color_index = parseInt(data[i]['usage_id']) % colors.length; //todo: dejangalize here

                console.log(data[i].id);
                var plot = L.polygon(boundaries, colors[color_index]).addTo(map);

                var popup = L.popup(); //init popup

                var custom_content = custom_content_2
                    .replaceAll('__PLOT_ID', data[i].id)
                    .replaceAll('__PLOT_NO', data[i]['plot_number'])
                    .replaceAll('__LATLANG', (data[i].latitude+','+data[i].longitude));

                custom_content =  "<h4>Latitude: "+data[i].latitude+'<br>Longitude: '+data[i].longitude+"</h4>"+ custom_content;

                popup.setContent(custom_content);

                plot.bindPopup(popup);

                //if (i == 50) break; //limit
            }
        });

    };

    //show saved plots with different colors for their status...
    showSavedPlots();

});

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function copyToClipboard(text) {
    //latlang come as 09505/494949
    //gotta replace / with ,
    text = text.replace('/', ',');
    window.prompt("Copy the coordinates: Ctrl+C, Enter", text);
}