
$(document).ready(function () {

    var buyPopupMask = $('.buy-popup-mask');

    $('#btn-buy').click(function () {
        buyPopupMask.css('display', 'table');
        buyPopupMask.fadeIn();
    });

    $('#btn-buy-cancel').click(function () {
        buyPopupMask.fadeOut();
    });

    $('#btn-buy-confirm').click(function () {
        var pid = this.attributes['data-pid'].value;

        $.ajax({
            url: '/applications/create/'+pid,
            data: {},
            success: function () {buyPopupMask.fadeOut();},
            dataType: null,
            done:null
        });

    });

    $('#btn-buy, #btn-login-to-buy').click(function () {
        window.location = '/buy'
    });

});
