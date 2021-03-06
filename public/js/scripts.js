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
            .fail(function() {
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

    // Open Dynamic
    $('#openDynamic').click(function(event) {
        event.preventDefault();

        if (
            !confirm('Está seguro que desea iniciar el proceso de votaciones?')
        ) {
            return;
        }

        $.ajax({
            method: 'PUT',
            url: $(this).attr('href'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        })
            .done(function() {
                location.reload();
            })
            .fail(function() {
                alert('Ha ocurrido un error, intente nuevamente');
            });
    });

    // Close Dynamic
    $('#closeDynamic').click(function(event) {
        event.preventDefault();

        if (
            !confirm('Está seguro que desea cerrar / finalizar esta dinámica?')
        ) {
            return;
        }

        $.ajax({
            method: 'PUT',
            url: $(this).attr('href'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        })
            .done(function() {
                location.reload();
            })
            .fail(function() {
                alert('Ha ocurrido un error, intente nuevamente');
            });
    });

    // Delete
    $('#deleteDynamic').click(function(event) {
        event.preventDefault();

        if (!confirm('Está seguro que desea eliminar esta dinámica?')) {
            return;
        }

        $.ajax({
            method: 'DELETE',
            url: $(this).attr('href'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        })
            .done(function() {
                location.reload();
            })
            .fail(function() {
                alert('Ha ocurrido un error, intente nuevamente');
            });
    });

    // Sort votes
    $('#vote-options .list-group')
        .sortable({
            placeholderClass: 'list-group-item',
        })
        .bind('sortupdate', function() {
            $('#vote-options .list-group li').each(function(i) {
                $(this)
                    .find('.badge')
                    .text(i + 1);
            });
        });

    // VOTE
    $('#voteForm').submit(function(event) {
        event.preventDefault();

        if (
            !confirm(
                'Está seguro que desea enviar sus preferencias en este orden?'
            )
        ) {
            return;
        }

        var form = $(this);

        $(form)
            .find('button[type=submit]')
            .text('Enviando...');
        $(form)
            .find('button')
            .attr('disabled', true);

        $.post($(form).attr('action'), $(form).serialize())
            .done(function(data) {
                $(form)
                    .find('.alert')
                    .removeClass('alert-danger')
                    .addClass('alert-success')
                    .html('Preferencias enviadas correctamente')
                    .show();

                $('#voteModal').modal('hide');

                setTimeout(function() {
                    location.reload();
                }, 800);
            })
            .fail(function(xhr) {
                $(form)
                    .find('button[type=submit]')
                    .text('Guardar');
                $(form)
                    .find('button')
                    .removeAttr('disabled');

                var errorMessage = 'Ha ocurrido un error, intente nuevamente';
                if (xhr.status === 409) {
                    errorMessage =
                        'Tu usuario ya envió sus preferencias para esta dinámica';
                }

                $(form)
                    .find('.alert')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .html(errorMessage)
                    .show();
            });

        return false;
    });
});
