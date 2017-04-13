
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
        $.ajax({
            url: '/application/create/uid/pid',
            data: {},
            success: null,
            dataType: null,
            done: function () {buyPopupMask.fadeOut();}
        });
    });




});
