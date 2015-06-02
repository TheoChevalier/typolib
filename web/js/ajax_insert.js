function clickHandlers() {
    hideEmptyNodes();

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
        event.preventDefault();
        var li = $(this).parent();
        var span = li.find('span');

        var exception = span.text;
        li.html($('.edit-exception-form'));
        li.find("input:text").val(exception);
    });

    $(".edit-rule").unbind('click');
    $(".edit-rule").click(function(event) {
        event.preventDefault();
        var code = $('#code_selector').val();
        var locale = $('#locale_selector').val();
        var li = $(this).parent();
        var id_rule = li.find('.rule').data('id-rule');

        $("#modal").show();

        $.ajax({
            url: "/api/",
            type: "GET",
            data: "action=get_edit_rule&locale=" + locale + "&code=" + code + "&id_rule=" + id_rule,
            dataType: "html",
            context: this,
            success: function(response) {
                if (response != "0") {
                    $('#modal .modal-content').html(response);
                    $("#modal input[type='submit'").unbind('click');
                    $("#modal input[type='submit'").click(function(event) {
                        event.preventDefault();
                        var code = $('#code_selector').val();
                        var locale = $('#locale_selector').val();
                        var id_rule = $('#modal input[name="id_rule"]').val();
                        var comment = $('#modal input[name="comment"]').val();
                        var inputs = new Array();
                        $('#modal input[type=text]').each(function(){
                            var input = $(this);
                            if(input.attr('name').toLowerCase().indexOf("input") >= 0) {
                                inputs.push(input.val());
                            }
                        });
                        $.ajax({
                            url: "/api/",
                            type: "GET",
                            data: "action=send_edit_rule&locale=" + locale + "&code=" + code + "&id_rule=" + id_rule + "&comment=" + comment + "&array=" + JSON.stringify(inputs),
                            dataType: "html",
                            success: function(response) {
                                if (response != "0") {
                                    $('#modal').hide();
                                    $("#results").html(response);
                                    clickHandlers();
                                } else {
                                    alert("The rule form can’t be empty.");
                                }
                            },
                            error: function() {
                                console.error("AJAX failure - send edit rule");
                            }
                        });
                    });
                } else {
                    alert("Sorry, something went wrong while editing this rule. Try again later.");
                }
            },
            error: function() {
                console.error("AJAX failure - edit rule");
            }
        }); 
    });

    $(".delete-rule").unbind('click');
    $(".delete-rule").click(function(event) {
        event.preventDefault();
        var code = $('#code_selector').val();
        var locale = $('#locale_selector').val();
        var li = $(this).parent();
        var id_rule = li.find('.rule').data('id-rule');
        $.ajax({
            url: "/api/",
            type: "GET",
            data: "action=deleting_rule&locale=" + locale + "&code=" + code + "&id_rule=" + id_rule,
            dataType: "html",
            context: this,
            success: function(response) {
                if (response == "1") {
                    $(this).parent().remove();
                    hideEmptyNodes();
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
        event.preventDefault();
        var code = $('#code_selector').val();
        var locale = $('#locale_selector').val();
        var li = $(this).parent();
        var id_exception = li.data('id-exception');
        var rule = li.parent().parent();
        var id_rule = rule.find('.rule').data('id-rule');
        $.ajax({
            url: "/api/",
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
        var code = $('#code_selector').val();
        var locale = $('#locale_selector').val();
        var exception = $('#exception').val();
        var id_rule = $('#exceptionview').parent().parent().find('.rule').data('id-rule');
        $.ajax({
            url: "/api/",
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

    $(".ruletype").unbind('click');
    $(".ruletype").click(function() {
        closeRules($(this), '.ruletype');
    });

    $(".rule").unbind('click');
    $(".rule").click(function() {
        closeRules($(this), '.rule');
    });
};

function updateRuleTemplate() {
    var rule_type = $('#addrule_type :selected').val();
    var res = $('#template-' + rule_type + ' form').clone();
    res.show();
    $('#template').html(res);
};

$('#exceptionview').hide();
clickHandlers();
updateRuleTemplate();



$('#locale_selector').on('change', function() {
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_codes&locale=" + this.value + "&mode=1" ,
        dataType: "html",
        success: function(response) {
            $("#code_selector").html(response);
            clickHandlers();
            $('#exceptionview').hide();
            if (response == '') {
                 $('#edit_code').hide();
                 $('#delete_code').hide();
                 $('#template').hide();
                 $('#rule_type').hide();
                 $('#add_comment').hide();
                 $('.treeview').hide();
            } else {
                $('#edit_code').show();
                $('#delete_code').show();
                $('#template').show();
                $('#rule_type').show();
                $('#add_comment').show();
                $('.treeview').show();
            }
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
        data: "action=get_rules&locale=" + locale + "&code=" + this.value + "&mode=1" ,
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
    var code = $('#code_selector').val();
    var locale = $('#locale_selector').val();
    var rule_type = $('#addrule_type').val();
    var comment = $('#comment').val();
    var placeholder = $('#addrule_type :selected').text();
    var inputs = new Array();
    $('#template input[type=text]').each(function(){
        var input = $(this);
        if(input.attr('name').toLowerCase().indexOf("input") >= 0) {
            inputs.push(input.val());
        }
    });
    $.ajax({
        url: "/api/",
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
