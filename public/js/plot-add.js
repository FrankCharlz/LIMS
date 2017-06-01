
$(document).ready(function () {

    var boundariesListContainer = $('#bound-ul');

    $('#btn-add-bound').click(function () {

        boundariesListContainer.append(
            $('<li>').html('<input type=text>')
        );

    });

});
