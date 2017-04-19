
$(document).ready(function () {



    $('.btn-del-app').click(function () {
        var btn = this;
        var aid = btn.attributes['data-id'].value;

        $.ajax({
            url: '/applications/cancel/'+aid,
            data: {},
            success: function () {$(btn.parentNode.parentNode).fadeOut(); /*hide the parent tr*/},
            dataType: null,
            done: function (data) {console.log(data);}
        });

    });




});
