$(document).ready(function() {
    $('#loginForm input[name=email]').focus();
    $('#loginForm input[name=email]').blur(function() {
        $(this).val($.trim($(this).val()));
    });

    $('#profileForm input[name=password]').blur(function() {
        if ($(this).val() !== '') {
            $('#profileForm input[name=password_confirmation]').attr(
                'required',
                true
            );
        } else {
            $('#profileForm input[name=password_confirmation]').removeAttr(
                'required'
            );
        }
    });
});
