$(document).ready(function() {
    $('#loginForm input[name=email]').focus();
    $('#loginForm input[name=email]').blur(function() {
        $(this).val($.trim($(this).val()));
    });
});
