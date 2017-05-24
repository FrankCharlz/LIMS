
$(document).ready(function () {

    $('.tr-plot-link').click(function () {
        console.log($(this).data("href"));
        window.location = $(this).data("href").toString();
    });


    $('.btn-options').click(function () {
        //do something at least
    });




});
