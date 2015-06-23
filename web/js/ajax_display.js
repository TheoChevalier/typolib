function clickHandlers() {
    hideEmptyNodes();

    $(".ruletype").unbind('click');
    $(".ruletype").click(function() {
        closeRules($(this), '.ruletype');
    });
}

function getCode() {
    locale = $('#locale_selector').val();
    code = $('#code_selector').val();
    var node = 0;
    if ($('#display-unverified').children().length !== 0) {
        node = 1;
    }

    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_rules&locale=" + locale
                            + "&code=" + encodeURIComponent(code)
                            + "&mode=" + node,
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
}

$('#locale_selector').on('change', function() {
    var node = 0;
    if ($('#display-unverified').children().length !== 0) {
        node = 1;
    }

    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_codes&locale=" + this.value + "&mode=" + node,
        dataType: "html",
        success: function(response) {
            $("#code_selector").html(response);
            $('#exceptionview').hide();
            if (response == '') {
                $('#code_selector').parent().parent().hide();
                $('.treeview').hide();
            } else {
                $('#code_selector').parent().parent().show();
                $('.treeview').show();
                getCode();
            }
        },
        error: function() {
            console.error("AJAX failure - get codes");
        }
    });
});

$('#code_selector').on('change', function() {
    getCode();
});

clickHandlers();
