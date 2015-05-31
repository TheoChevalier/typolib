function clickHandlers() {
    $(".ruletype").unbind('click');
    $(".ruletype").click(function() {
        closeRules($(this), '.ruletype');
    });
}

$('#locale_selector').on('change', function() {
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_codes&locale=" + this.value + "&mode=0",
        dataType: "html",
        success: function(response) {
            $("#code_selector").html(response);
            $('#exceptionview').hide();
        },
        error: function() {
            console.error("AJAX failure - get codes");
        }
    });
});

$('#code_selector').on('change', function() {
    locale = $('#locale_selector').val();
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_rules&locale=" + locale + "&code=" + this.value + "&mode=0",
        dataType: "html",
        success: function(response) {
            $("#results").html(response);
            $('#exceptionview').hide();
            clickHandlers();
        },
        error: function() {
            console.error("AJAX failure - get rules");
        }
    });
});

clickHandlers();
