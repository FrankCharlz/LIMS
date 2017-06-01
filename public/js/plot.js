var confimMessage = "<p>Please confirm your application for this plot.</p><p>If you click <b>confirm</b> this plot will be added to your land applicatons list, then you can pay later</p>";
var cancelMessage = "<p>Please confirm the <b>removal</b> of your application for this plot.</p><p>If you click <b>confirm</b> this application will be actively cancelled.</p>";

$(document).ready(function () {

    var buyPopupMask = $('.buy-popup-mask');

    $('#btn-buy').click(function () {
        buyPopupMask.css('display', 'table');
        $('#message').html(confimMessage);
        buyPopupMask.fadeIn();
    });

    $('#btn-buy-cancel').click(function () {
        buyPopupMask.fadeOut();
    });

    $('#btn-buy-confirm').click(function () {
        var pid = this.attributes['data-pid'].value;

        var aid = this.attributes['data-aid'].value;
        aid = parseInt(aid);

        if (!isNaN(aid) && aid > 0) {
            //valid application id means wants to cancel an application
            $.ajax({
                url: '/applications/cancel/'+aid,
                data: {},
                success: function () {buyPopupMask.fadeOut();},
                dataType: null,
                done:null
            });

        } else {
            // means wants to make an application
            $.ajax({
                url: '/applications/create/'+pid,
                data: {},
                success: function () {buyPopupMask.fadeOut();},
                dataType: null,
                done:null
            });
        }



    });

    $('#btn-app-cancel').click(function () {
        buyPopupMask.css('display', 'table');
        $('#message').html(cancelMessage);
        buyPopupMask.fadeIn();
    });

});
