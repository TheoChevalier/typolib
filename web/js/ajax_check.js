$('#submitCheck').click(function(event) {
    event.preventDefault();
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
                alert("The text field can’t be empty.");
            }
        },
        error: function() {
            console.error("AJAX failure - add rule");
        }
    });
});
