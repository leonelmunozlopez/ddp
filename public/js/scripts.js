$(document).ready(function() {
    $('#login input[name=user]').focus();
    $('#login input[name=user]').blur(function() {
        $(this).val($.trim($(this).val()));
    });
});
