(function ($) {
    "use strict";

    $(document).ready(function () {
        var form = $('form.contact');

        // Init contact form
        initContactForm();

        $(form).each(function() {
            initAjaxForm($('#contact'),successContactForm);
        });

        // Interest dropdown
        $(form).find('select[name="interest"]').on('change', function() {
            initContactForm();
        });

        // Form Init
        function initContactForm() {
            var form = $('form.contact');
            var interest = $(form).find('select[name="interest"]').val();
            initContactFields(interest);
        }

        function initContactFields(interest) {
            // Init fields
            var form = $('form.contact');
            var fields = contact_json[interest]['fields'];
            var required = contact_json[interest]['required'];
            var footer = contact_json[interest]['footer'];

            $(form).find('.form-section.fields .form-group').addClass('hidden');

            for (var i = 0, len = fields.length; i < len; i++) {
                $(form).find('.form-section.fields .form-group.'+fields[i]).removeClass('hidden');
            }

            // Init required fields
            $(form).find('.form-group .form-control.form-required').removeClass('form-required');

            $(form).find('.form-group label').not('.custom-checkbox').not('.custom-radio').text(function () {
                return $(this).text().replace("*", "");
            });

            for (var i = 0, len = required.length; i < len; i++) {
                $(form).find('.form-group.'+required[i]+' label').not('.custom-checkbox').not('.custom-radio').text(function () {
                    return $(this).text()+"*";
                }).closest('.form-group').find('.form-control').addClass('form-required');
            }

            // Init form footer
            $('.form-footer').hide();

            if (footer) {
                $('.form-footer.'+footer).show();
            }
        }

        // Form Callback
        function successContactForm(form,data) {
            var confirmation = $(form).closest('.form-wrapper').find('.confirmation');
            //$(form).trigger("reset");
            //initContactForm();
            //$(form).find('select').selectpicker('refresh');
            $(confirmation).removeClass('hidden').show();
            $(form).remove();

            $('html, body').animate({
                scrollTop: $(confirmation).offset().top -150
            }, 400);

            setTimeout(function(){
                $(confirmation).slideUp("normal", function() {
                    $(this).addClass('hidden');
                });
            }, 4000);
        }
    });
})(jQuery);
