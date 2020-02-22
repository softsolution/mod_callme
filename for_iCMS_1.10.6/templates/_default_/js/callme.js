$(function(){
    $(".getpopupcallme").magnificPopup({
        type: 'ajax',
        preloader: true,
        focus: '#name',
        callbacks: {
            beforeOpen: function () {
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }
            }
        }
    });
});

function sendCallmeForm(module_id) {

    var is_valid = true;
    var form = $("#callme_form"+module_id);
    $('#form_error .mess').hide();

    //check email
    if($('.c_required').is('#popup_email_'+module_id)){
        var client_email_field = $('#popup_email_'+module_id);
        var client_email_val = client_email_field.val();
        if(client_email_val.length < 6){
            is_valid = false;
            client_email_field.addClass('has-error');
        } else {
            client_email_field.removeClass('has-error');
        }
    }

    //check phone
    if($('.c_required').is('#popup_phone_'+module_id)){
        var client_phone_field = $('#popup_phone_'+module_id);
        var client_phone_val = client_phone_field.val();
        if(client_phone_val.length < 6){
            is_valid = false;
            client_phone_field.addClass('has-error');
        } else {
            client_phone_field.removeClass('has-error');
        }
    }

    if(is_valid){
        $.ajax({
            type : "POST",
            cache : false,
            url : "/modules/mod_callme/ajax/sendmail.php",
            data : form.serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    form.html(data.html);
                    setTimeout("$.magnificPopup.close();", 4000);
                }
            }
        });
    } else {
        $('#form_error .mess').show();
        return false;
    }
}