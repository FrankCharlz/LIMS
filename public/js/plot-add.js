
$(document).ready(function () {

    var boundariesListContainer = $('#bound-ul');

    $('#btn-add-bound').click(function () {

        boundariesListContainer.append(
            $('<li>').html('<input type="text" autofocus><i onclick="removeListItem(this)" class="fa fa-trash-o remove-li" aria-hidden="true"></i>')
        );

    });

    $('#btn-submit').click(function () {
        var cert_file = $('#btn-cert').val();



        var area = $("input[name='area']").val();
        console.log(parseFloat(area));

        if (isNaN(parseFloat(area))) {
            alert("The area you entered is not in correct format");
            return false;
        }

        if (parseFloat(area) > 9999 || parseFloat(area) < 0) {
            alert("The area you entered ["+area+"] is out of range");
            return false;
        }

        if (cert_file == "") {
            alert("No photo is uploaded for the plot certificate. \nPlease select a photo");
            return false;
        }

        $('ul#bound-ul li').each(function () {
            var inp = $(this).find('input');
            console.log(inp)
        });

        //extracting boundaries
        var boundaries = '[';
        $('ul#bound-ul li').each(function () {
            var point = $(this).find('input').val();
            point = '[' + point + ']';
            boundaries += point;
            boundaries += ','
        });

        boundaries = boundaries.slice(0, -1); //remove last comma
        boundaries += ']';
        console.log(boundaries);
        $('input[name=boundaries]').val(boundaries);

    });




});

function removeListItem(node) {
    var li = node.parentNode;
    var ul = li.parentNode;
    ul.removeChild(li);
}
