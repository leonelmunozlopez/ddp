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

    // Store Project
    $('#projectForm').submit(function(event) {
        event.preventDefault();

        var form = $(this);

        $(form)
            .find('button[type=submit]')
            .text('Guardando...');
        $(form)
            .find('button')
            .attr('disabled', true);

        $.post($(form).attr('action'), $(form).serialize())
            .done(function(data) {
                $(form)
                    .find('.alert')
                    .removeClass('alert-danger')
                    .addClass('alert-success')
                    .html('Projecto enviado correctamente')
                    .show();

                $('#projectModal').modal('hide');

                setTimeout(function() {
                    location.reload();
                }, 800);
            })
            .fail(function(x, s, e) {
                console.log(x, s, e);

                $(form)
                    .find('button[type=submit]')
                    .text('Guardar');
                $(form)
                    .find('button')
                    .removeAttr('disabled');

                $(form)
                    .find('.alert')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .html('Ha ocurrido un error, intente nuevamente')
                    .show();
            });

        return false;
    });
});
