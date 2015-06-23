$('#locale_selector').on('change', function() {
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_codes&locale=" + this.value + "&mode=0" ,
        dataType: "html",
        success: function(response) {
            $("#code_selector").html(response);

            if (response == '') {
                $('#code_selector').parent().parent().hide();
            } else {
                $('#code_selector').parent().parent().show();
            }
        },
        error: function() {
            console.error("AJAX failure - get codes");
        }
    });
});

$('input[type="submit"]').show();
$('#spinner-file').hide();

$('input[type="submit"]').click(function() {
    $(this).hide();
    $('#spinner-file').show();
});

$('#spinner-file .close').click(function() {
    $('#spinner-file').hide();
    $('input[type="submit"]').show();
});
