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

    // Autosize Textareas
    autosize($('textarea.autosize'));

    // Copy link
    var clipboard = new ClipboardJS('.copy-button');

    clipboard.on('success', function(e) {
        console.info('Copied Text! :', e.text);
        e.clearSelection();

        const oldText = $('.copy-button span').text();
        $('.copy-button span').text('listo!');
        setTimeout(() => {
            $('.copy-button span').text(oldText);
        }, 3000);
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
});
