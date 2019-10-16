(function ($) {
    "use strict";
    $(document).ready(function () {
        initDropzone();
    });
})(jQuery);

function initDropzone() {
    // Init dropzone
    $.each($('.dropzone'), function () {
        var element = $(this);

        var dzIcons = {
            'application/pdf':'{{ asset_path("lwv.field_type.dropzone::img/types/pdf.png") }}',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document':'{{ asset_path("lwv.field_type.dropzone::img/types/document.png") }}',
            'text/plain':'{{ asset_path("lwv.field_type.dropzone::img/types/text.png") }}',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation':'{{ asset_path("lwv.field_type.dropzone::img/types/presentation.png") }}',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':'{{ asset_path("lwv.field_type.dropzone::img/types/spreadsheet.png") }}',
            'audio/mpeg':'{{ asset_path("lwv.field_type.dropzone::img/types/mp3.png") }}',
            'application/postscript':'{{ asset_path("lwv.field_type.dropzone::img/types/eps.png") }}',
            'application/x-zip-compressed':'{{ asset_path("lwv.field_type.dropzone::img/types/archive.png") }}',
            'video/quicktime':'{{ asset_path("lwv.field_type.dropzone::img/types/mov.png") }}',
            'video/avi':'{{ asset_path("lwv.field_type.dropzone::img/types/avi.png") }}',
            'text/css':'{{ asset_path("lwv.field_type.dropzone::img/types/css.png") }}',
            'text/html':'{{ asset_path("lwv.field_type.dropzone::img/types/htm.png") }}',
            'unknown':'{{ asset_path("lwv.field_type.dropzone::img/types/unknown.png") }}',
        };

        var dropzone = new Dropzone('#'+element.attr('id'),
            {
                url: APPLICATION_URL + '/streams/dropzone-field_type/handle',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-RULES': element.data('rules'),
                },
                paramName: "file",
                maxFilesize: element.data('max-size'),
                clickable: true,
                maxFiles: element.data('max-files'),
                parallelUploads: element.data('max-parallel'),
                addRemoveLinks: true,
                dictRemoveFile: element.data('message-remove'),
                dictCancelUpload: element.data('message-cancel'),
                acceptedFiles: element.data('accepted'),
                fallback: function() {
                    if (element.data('allow-fallback') != 1) {
                        $(element).hide();
                    }
                },
            });

        dropzone.on('maxfilesexceeded', function(file) { this.removeFile(file); });

        dropzone.on('removedfile', function(file) {
            initDropzoneInput(dropzone);
        });

        dropzone.on('success', function(file,response) {
            if (response.hasOwnProperty('upload')) {
                file['upload'] = response.upload;
            }
        });

        dropzone.on('queuecomplete', function () {
            initDropzoneInput(dropzone);
        });

        dropzone.on('fallback', function(file,response) {
            $(element).hide();
        });

        dropzone.on('addedfile', function(file) {
            var thumbnail = $(element).find('.dz-preview.dz-file-preview .dz-image:last');

            if (dzIcons.hasOwnProperty(file.type)) {
                thumbnail.css('background-image', 'url('+dzIcons[file.type]+')');
            } else {
                thumbnail.css('background-image', 'url('+dzIcons["unknown"]+')');
                console.log('Dropzone Unknown file type ('+file.type+')');
            }
        });

        // Init remove links
        element.prev().prev().find(".dz-value-remove").click(function (e) {
            e.preventDefault();
            var dz = $(this).data('dropzone');

            $(this).closest('.dz-value').addClass('hidden');
            $('#'+dz).removeClass('hidden');
            $("input[data-dropzone="+dz+"]").val('');
        });
    });
}

function initDropzoneInput(dropzone) {
    var input = $(dropzone.element).prev();
    var uploaded = [];

    for (var i in dropzone.files) {
        var file = dropzone.files[i];

        if (file.hasOwnProperty('upload')) {
            uploaded.push(file['upload']);
        }
    }
    input.val(uploaded.join(','));
}