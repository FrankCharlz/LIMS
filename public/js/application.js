
$(document).ready(function () {

    $('.tr-plot-link').click(function () {
        console.log($(this).data("href"));
        window.location = $(this).data("href").toString();
    });


    $('.btn-del-app').click(function () {
        var aid = this.attributes['data-aid'].value;
        $.ajax({
            url: '/applications/delete/'+aid,
            data: {},
            success: function () {window.location.reload(true); },
            dataType: null,
            done:null
        });
    });




});
