$(document).on('click', '.deleteEnsinoButton', function() {
    console.log($(this).attr('id'));

    $('#ensino_id_input').val($(this).attr('id'));
});