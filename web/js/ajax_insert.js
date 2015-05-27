function clickHandlers() {
    $("a.new-exception").unbind('click');
    $("a.new-exception").click(function(event) {
        event.preventDefault();
        // Make sure the form is displayed
        $('#exceptionview').show();

        // Show the "New exception…" under previous rule
        $('#exceptionview').parent().find('.new-exception').show();

        // Hide "new exception…" under current rule
        $(this).hide();

        // Move the form under current rule
        $('#exceptionview').detach().appendTo($(this).parent());
    });


    $(".edit-exception").unbind('click');
    $(".edit-exception").click(function(event) {
        var li = $(this).parent();
        var span = li.find('span');

        var exception = span.text;
        li.html($('.edit-exception-form'));
        li.find("input:text").val(exception);
    });

    $(".edit-rule").unbind('click');
    $(".edit-rule").click(function(event) {
        var li = $(this).parent();
        var type = li.find('.rule').data('id-type');
        var template = $('#template-' + type + '-edit form').clone();

        $("#modal").show();
        $('#modal .modal-content').html(template);
    });

    $(".delete-rule").unbind('click');
    $(".delete-rule").click(function(event) {
        code = $('#code_selector').val();
        locale = $('#locale_selector').val();
        var li = $(this).parent();
        id_rule = li.find('.rule').data('id-rule');
        $.ajax({
            url: "api/",
            type: "GET",
            data: "action=deleting_rule&locale=" + locale + "&code=" + code + "&id_rule=" + id_rule,
            dataType: "html",
            context: this,
            success: function(response) {
                if (response == "1") {
                    $(this).parent().remove();
                } else {
                    alert("Sorry, something went wrong while deleting this rule. Try again later.");
                }
            },
            error: function() {
                console.error("AJAX failure - delete rule");
            }
        });
    });

    $(".delete-exception").unbind('click');
    $(".delete-exception").click(function(event) {
        code = $('#code_selector').val();
        locale = $('#locale_selector').val();
        var li = $(this).parent();
        id_exception = li.data('id-exception');
        var rule = li.parent().parent();
        id_rule = rule.find('.rule').data('id-rule');
        $.ajax({
            url: "api/",
            type: "GET",
            data: "action=deleting_exception&locale=" + locale + "&code=" + code + "&id_rule=" + id_rule + "&id_exception=" + id_exception,
            dataType: "html",
            context: this,
            success: function(response) {
                if (response == "1") {
                    $(this).parent().remove();
                } else {
                    alert("Sorry, something went wrong while deleting this exception. Try again later.");
                }
            },
            error: function() {
                console.error("AJAX failure - delete exception");
            }
        });
    });


    $('#submitRuleException').unbind('click');
    $('#submitRuleException').click(function(event) {
        event.preventDefault();
        code = $('#code_selector').val();
        locale = $('#locale_selector').val();
        exception = $('#exception').val();
        id_rule = $('#exceptionview').parent().parent().find('.rule').data('id-rule');
        $.ajax({
            url: "api/",
            type: "GET",
            data: "action=adding_exception&locale=" + locale + "&code=" + code + "&id_rule=" + id_rule + "&content=" + exception,
            dataType: "html",
            success: function(response) {
                if (response != "0") {
                    var ul = $('#exceptionview').parent();
                    ul.append(response);
                    ul.find('#exceptionview').appendTo(ul);
                    ul.find('.new-exception').appendTo(ul);
                    clickHandlers();
                    $('#exception').val('');
                } else {
                    alert("The exception field can’t be empty.");
                }
            },
            error: function() {
                console.error("AJAX failure - add rule");
            }
        });
    });
};

function updateRuleTemplate() {
    rule_type = $('#addrule_type :selected').val();
    var res = $('#template-' + rule_type + ' form').clone();
    res.show();
    $('#template').html(res);
};

$('#exceptionview').hide();
clickHandlers();
updateRuleTemplate();



$('#locale_selector').on('change', function() {
    $.ajax({
        url: "api/",
        type: "GET",
        data: "action=get_codes&locale=" + this.value,
        dataType: "html",
        success: function(response) {
            $("#code_selector").html(response);
            clickHandlers();
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
        url: "api/",
        type: "GET",
        data: "action=get_rules&locale=" + locale + "&code=" + this.value,
        dataType: "html",
        success: function(response) {
            $("#results").html(response);
            clickHandlers();
            $('#exceptionview').hide();
        },
        error: function() {
            console.error("AJAX failure - get rules");
        }
    });
});

$('#addrule_type').on('change', function() {
    updateRuleTemplate();
});

$('#submitRule').click(function(event) {
    event.preventDefault();
    code = $('#code_selector').val();
    locale = $('#locale_selector').val();
    rule_type = $('#addrule_type').val();
    comment = $('#comment').val();
    placeholder = $('#addrule_type :selected').text();
    var inputs = new Array();
    $('#template input[type=text]').each(function(){
        var input = $(this);
        if(input.attr('name').toLowerCase().indexOf("input") >= 0) {
            inputs.push(input.val());
        }
    });
    $.ajax({
        url: "api/",
        type: "GET",
        data: "action=adding_rule&locale=" + locale + "&code=" + code + "&type=" + rule_type + "&comment=" + comment + "&array=" + JSON.stringify(inputs),
        dataType: "html",
        success: function(response) {
            if (response != "0") {
                $("#results").html(response);
                $('#comment').val('');
                $('#rule').val(placeholder);
                $('#template input[type=text]').each(function(){
                    var input = $(this);
                    if(input.attr('name').toLowerCase().indexOf("input") >= 0) {
                        input.val('');
                    }
                });
                clickHandlers();
            } else {
                alert("The rule field can’t be empty.");
            }
        },
        error: function() {
            console.error("AJAX failure - add rule");
        }
    });
});
