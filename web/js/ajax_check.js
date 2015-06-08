function check() {
    var code = $('#code_selector').val();
    var locale = $('#locale_selector').val();
    var user_string = $('#enterText').val();
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=check&locale=" + locale + "&code=" + code + "&string=" + user_string ,
        dataType: "html",
        success: function(response) {
            if (response != "0") {
                $("#checkResponse").val(response);
            } else {
                $("#checkResponse").val('');
            }
        },
        error: function() {
            console.error("AJAX failure - add rule");
        }
    });
}

$('#submitCheck').click(function(event) {
    event.preventDefault();
    check();
});

$('#enterText').on('keyup', function () {
    check();
});

$('#locale_selector').on('change', function() {
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_codes&locale=" + this.value + "&mode=1" ,
        dataType: "html",
        success: function(response) {
            $("#code_selector").html(response);

            if (response == '') {
                $('#code_selector').parent().parent().hide();
                $('#enterText').parent().hide();
                $('#checkResponse').parent().hide();
                $('#submitCheck').hide();
            } else {
                $('#code_selector').parent().parent().show();
                $('#enterText').parent().show();
                $('#checkResponse').parent().show();
                $('#submitCheck').show();
            }
        },
        error: function() {
            console.error("AJAX failure - get codes");
        }
    });
});
