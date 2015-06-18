function clickHandlers() {
    hideEmptyNodes();
    autoResizeTextarea($('#comment'));

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
        var exception = span.html();
        var id_exception = li.data('id-exception');

        $('#modal .modal-content').html($('.edit-exception-form'));
        $(".edit-exception-form input[type='text']").val(exception);
        $('.edit-exception-form').show();
        $("#modal").show();
        $("#submitUpdatedException").unbind('click');
        $("#submitUpdatedException").click(function(event) {
            event.preventDefault();
            var code = $('#code_selector').val();
            var locale = $('#locale_selector').val();
            var exception = $("#modal input[type='text']").val();

            $.ajax({
                url: "/api/",
                type: "GET",
                data: "action=send_edit_exception&locale=" + locale
                                                + "&code=" + code
                                                + "&id_exception=" + id_exception
                                                + "&exception=" + encodeURIComponent(exception),
                dataType: "html",
                success: function(response) {
                    if (response != "0") {
                        $('#modal').hide();
                        span.html($(".edit-exception-form input[type='text']").val());
                    } else {
                        alert("The exception form can’t be empty.");
                    }
                },
                error: function() {
                    console.error("AJAX failure - send edit exception");
                }
            });
        });
    });

    $(".edit-rule").unbind('click');
    $(".edit-rule").click(function(event) {
        event.preventDefault();
        var code = $('#code_selector').val();
        var locale = $('#locale_selector').val();
        var li = $(this).parent();
        var rule = li.find('.rule');
        var id_rule = rule.data('id-rule');

        $("#modal").show();

        $.ajax({
            url: "/api/",
            type: "GET",
            data: "action=get_edit_rule&locale=" + locale
                                    + "&code=" + code
                                    + "&id_rule=" + id_rule,
            dataType: "html",
            context: this,
            success: function(response) {
                if (response != "0") {
                    $('#modal .modal-content').html(response);
                    clickHandlers();
                    autoResizeTextarea($('#comment-edit'));

                    $("#modal input[type='submit']").unbind('click');
                    $("#modal input[type='submit']").click(function(event) {
                        event.preventDefault();
                        var code = $('#code_selector').val();
                        var locale = $('#locale_selector').val();
                        var id_rule = $('#modal input[name="id_rule"]').val();
                        var id_type = $('#modal input[name="id_type"]').val()
                        var comment = $('#modal textarea[name="comment"]').val();
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
                            data: "action=send_edit_rule&locale=" + locale
                                                        + "&code=" + code
                                                        + "&id_rule="+ id_rule
                                                        + "&id_type=" + id_type
                                                        + "&comment=" + encodeURIComponent(comment)
                                                        + "&array=" + encodeURIComponent(JSON.stringify(inputs)),
                            dataType: "html",
                            success: function(response) {
                                if (response != "0") {
                                    $('#modal').hide();
                                    rule.html(response);
                                    var exceptions = rule.parent().find('.exceptions');
                                    exceptions.find('.comment').remove();
                                    exceptions.prepend('<span class="comment">' + comment + '</span>');
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
            data: "action=deleting_rule&locale=" + locale
                                    + "&code=" + code
                                    + "&id_rule=" + id_rule,
            dataType: "html",
            context: this,
            success: function(response) {
                if (response == "1") {
                    if ($(this).parent().has('#exceptionview').length == 1) {
                        $('#exceptionview').hide();
                        $('#exceptionview').appendTo('body');
                    }
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
            data: "action=deleting_exception&locale=" + locale
                                            + "&code=" + code
                                            + "&id_rule=" + id_rule
                                            + "&id_exception=" + id_exception,
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
            data: "action=adding_exception&locale=" + locale
                                        + "&code=" + code
                                        + "&id_rule=" + id_rule
                                        + "&content=" + encodeURIComponent(exception),
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

    $('#submitRule').unbind('click');
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

        var li_type = $(".treeview [data-id-type='" + rule_type + "']");
        var type_number = li_type.data('number-type');
        var rule_number = li_type.find('ul').children().length;

        $.ajax({
            url: "/api/",
            type: "GET",
            data: "action=adding_rule&locale=" + locale
                                    + "&code=" + code
                                    + "&type=" + rule_type
                                    + "&type_number=" + type_number
                                    + "&rule_number=" + rule_number
                                    + "&comment=" + encodeURIComponent(comment)
                                    + "&array=" + encodeURIComponent(JSON.stringify(inputs)),
            dataType: "html",
            success: function(response) {
                if (response != "0") {
                    if (response == "-1") {
                        alert("You can't have more than one quotation mark rule. If you need to change the rule, you can edit the current one.");
                    } else {
                        li_type.find('.rules').append(response);
                        $('#comment').val('');
                        $('#rule').val(placeholder);
                        $('#template input[type=text]').each(function(){
                            var input = $(this);
                            if(input.attr('name').toLowerCase().indexOf("input") >= 0) {
                                input.val('');
                            }
                        });
                        clickHandlers();
                    }
                } else {
                    alert("The rule field can’t be empty.");
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

    $(".draggable").draggable({
        appendTo: "body",
        helper: "clone",
        cursor: "pointer",
        revert: "invalid",
        zIndex: 2500,
    });

    $(".droppable").droppable({
        hoverClass: 'active',
        tolerance: 'pointer',
        drop: function(event, ui) {
            var tempid;
            switch ($(ui.draggable).text()) {
                case 'non-breaking space':
                    tempid = ' ';
                    break;
                case 'white-space':
                    tempid = ' ';
                    break;
                case 'narrow no-break space':
                    tempid = ' ';
                    break;
                default:
                    tempid = $(ui.draggable).text();
                    break;
            }
            var dropText;
            dropText = tempid;
            var droparea = event.target;
            var range1 = droparea.selectionStart;
            var range2 = droparea.selectionEnd;
            var val = droparea.value;
            var str1 = val.substring(0, range1);
            var str3 = val.substring(range1, val.length);
            droparea.value = str1 + dropText + str3;
            droparea.focus();
        }
    });
}

function getCode() {
    var locale = $('#locale_selector').val();
    var code = $('#code_selector').val();
    $.ajax({
        url: "/api/",
        type: "GET",
        data: "action=get_rules&locale=" + locale
                            + "&code=" + code
                            + "&mode=1",
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
}

function updateRuleTemplate() {
    var rule_type = $('#addrule_type :selected').val();
    var res = $('#template-' + rule_type + ' form').clone();
    res.show();
    $('#template').html(res);
    clickHandlers();
}

$('#exceptionview').hide();
clickHandlers();
updateRuleTemplate();
autoResizeTextarea($('#comment'));


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
                $('#code_selector').parent().parent().hide();
                $('#edit_code').parent().hide();
                $('#delete_code').hide();
                $('#new_rule').hide();
                $('#results').hide();
            } else {
                $('#code_selector').parent().parent().show();
                $('#edit_code').parent().show();
                $('#delete_code').show();
                $('#new_rule').show();
                $('#results').show();
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

$('#addrule_type').on('change', function() {
    updateRuleTemplate();
});

