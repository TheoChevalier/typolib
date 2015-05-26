
$("#modal-close").unbind('click');
$("#modal-close").click(function(event){
    event.preventDefault();
    $('#modal').hide();
});
