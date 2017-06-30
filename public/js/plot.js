
$(document).ready(function () {

    var buyPopupMask = $('.buy-popup-mask');

    $('#btn-cancel').click(function () {
        buyPopupMask.fadeOut();
    });


    $('#btn-cancel-application, #btn-buy-plot, #btn-delete-plot, #btn-remove-from-sales, #btn-sell-plot').click(function () {
        buyPopupMask.css('display', 'table');
        buyPopupMask.fadeIn();
    });


    $('#btn-cancel-application-confirm').click(function () {
        var aid = this.attributes['data-aid'].value;

        $.ajax({
            url: '/applications/cancel/'+aid,
            data: {},
            success: function () {buyPopupMask.fadeOut(); window.location.reload(true);},
            dataType: null,
            done:null
        });

    });


    $('#btn-buy-plot-confirm').click(function () {
        var pid = this.attributes['data-pid'].value;
        // means wants to make an application
        $.ajax({
            url: '/applications/create/'+pid,
            data: {},
            success: function () {buyPopupMask.fadeOut(); window.location.reload(true); },
            dataType: null,
            done:null
        });
    });


    $('#btn-remove-from-sales-confirm').click(function () {
        //and cancel all applications on the land
        var pid = this.attributes['data-pid'].value;
        $.ajax({
            url: '/plots/'+pid+'/remove-on-sale',
            data: {},
            success: function () {buyPopupMask.fadeOut(); window.location.reload(true); },
            dataType: null,
            done:null
        });
    });

    $('#btn-sell-plot-confirm').click(function () {
        var pid = this.attributes['data-pid'].value;
        $.ajax({
            url: '/plots/'+pid+'/put-on-sale',
            data: {},
            success: function () {buyPopupMask.fadeOut(); window.location.reload(true); },
            dataType: null,
            done:null
        });


    });

    $('#btn-app-cancel').click(function () {
        buyPopupMask.css('display', 'table');
        $('#message').html(cancelMessage);
        buyPopupMask.fadeIn();
    });


    //hide the div when someone clicks on the sp-close
    $('span#sp-close').click(function () {
        $('div.just-added').fadeOut();
    });


    //initializing maps


    initMap();

});


function initMap() {

    var point = {
        lat: parseFloat(document.getElementById('lat').value),
        lng: parseFloat(document.getElementById('lng').value)
    };
    var zoom = 20;

    var gmap = new google.maps.Map(document.getElementById('gmap'), {
        zoom: zoom,
        center: point,
        mapTypeId: 'satellite',
        disableDefaultUI: true
    });

    var smap = L.map('smap').setView([ point.lat, point.lng], zoom);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy;<a href="http://osm.org/copyright">OpenStreetMap</a>'
    }).addTo(smap);
    smap.dragging.disable();
    smap.touchZoom.disable();
    smap.doubleClickZoom.disable();
    smap.scrollWheelZoom.disable();
    smap.boxZoom.disable();
    smap.keyboard.disable();
    if (smap.tap) smap.tap.disable();

}