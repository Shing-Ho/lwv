(function ($) {
    "use strict";
    //$(document).ready(function () {
    $(function() {
        openSite();
    });

    function openSite() {
        // Placeholder functionality for older browsers
        modernizrPlaceholder();

        // Init Bootstrap Dropdowns
        $("select").selectpicker({
            dropupAuto: false
        });

        // Disabled Links
        $('a.disabled').click(function (e) {
            e.preventDefault();
            return false;
        });

        // Init Lightboxes
        lightbox();

        // Init Animations
        animateElements();

        // Init dropdown UL lists
        ulToggle();

        // Init Menus
        initMenu();
        initMegaMenu();

        // Init Mobile Banner
        initMobileBanner();

        // Init Collapse
        initCollapse();

        // Init Filterable Containers
        initFilterable();

        // Init Scroll
        initScroll();

        // Init SameHeight
        initSameHeight();

        // Init Read More
        initReadMore();

        // Init Tooltips
        initTooltip();
    }
})(jQuery);

function initMobileBanner() {
    var isBrokenBrowser = /CriOS/.test(navigator.userAgent) || /FxiOS/.test(navigator.userAgent);

    // Chrome iOS = CriOS
    // Firefox iOS = FxiOS
    // Only execute on mobile devices running chrome or firefox
    if (typeof window.orientation !== "undefined" && isBrokenBrowser)  {
        setBannerHeight();
        //orientationQuery.addListener(setBannerHeight);
    }
}

function setBannerHeight() {
    var orientationQuery = window.matchMedia('(orientation: portrait)');
    var hh = $('#header').outerHeight();
    var vh = window.innerHeight - hh;
    var vw = window.innerWidth - hh;
    var banner = $('section.block-header .image-full');

    //if (window.matchMedia( "(max-width: 767px)" ).matches) {
    //    alert('device too small');
    //    return false;
    //}

    if (orientationQuery.matches) {
        banner.css('height',Math.max(vh, vw));
    } else {
        banner.css('height',Math.min(vh, vw));
    }
}

function initAjaxForm(form,callback) {
    // Basic form field validation
    initFormValidation(form);

    // Bind Ajax handler
    $(form).submit( function() {
        clearFormError(form);

        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data    : $(this).serialize(),
            success : function( data ) {
                if (!raiseFormError(form,data.errors)) {
                    // Execute callback and pass data
                    if (typeof callback === "function") {
                        callback(form,data);
                    } else {
                        console.log('Error: callback function not defined');
                        console.log(callback);
                    }
                }
            }
        });
        return false;
    });
}

function initFormValidation(form) {
    // Form Submit
    form.find("button:submit").click(function (e) {
        form.find(".form-error").removeClass("form-error");

        // Inputs
        form.find("input.form-required:visible").each(function() {
            if (isNullOrWhitespace($(this).val())) {
                $(this).addClass('form-error');
            }
        });

        // Bootstrap selects
        form.find("select.form-required").each(function() {
            if (isNullOrWhitespace($(this).val())) {
                $(this).next(":visible").addClass('form-error');
            }
        });

        // Textareas
        form.find("textarea.form-required").each(function() {
            if (isNullOrWhitespace($(this).val())) {
                $(this).addClass('form-error');
            }
        });

        // Radios
        form.find(".form-radio.form-required:visible").each(function() {
            if (!$(this).find("input:checked").length) {
                $(this).addClass('form-error');
            }
        });

        // Do we have any errors?
        if (form.find(".form-error:visible").length) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $(".form-error:visible").filter(":first").offset().top -150
            }, 750);
        }

        return true;
    });
}

function raiseFormError(form,errors) {
    var count = 0;

    for (var error in errors) {
        if (errors.hasOwnProperty(error)) {
            ++count;
            $('<small class="animated fadeIn"></small>').addClass('form-alert').html(errors[error][0]).appendTo(form.find('.form-group.'+error));
            form.find('.form-group.'+error+' .form-control').addClass('form-error');
        }
    }

    return count;
}

function clearFormError(form) {
    form.find('.form-error').removeClass('form-error');
    form.find('.form-alert').remove();
}



function initCollapse() {
    $('a.collapse-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $group = $this.closest('.collapse-group');
        var $collapse = $group.find('.collapse');

        $collapse.collapse('toggle');
        $group.toggleClass('active');

        var search = $group.hasClass('active') ? /More/ : /Less/;
        var replace = $group.hasClass('active') ? 'Less' : 'More';

        $group.find('.collapse-btn').html(function(index,html){
            return html.replace(search,replace);
        });
    });
}

function initFilterable() {
    var filter = getUrlParam('filter',null);

    $.each($('.filterable'), function () {
        $(this).find('.filters').on('click', 'a.filter', function (e) {
            e.preventDefault();
            var container = $(this).closest('.filterable');
            var filterValue = $(this).attr('data-filter');
            var filters = new Array();
            var filterString;

            // Button state
            if (filterValue == '*') {
                $(this).closest('.filters').find('.active').removeClass('active');
            } else {
                $(this).closest('.filter-group').find('.active').removeClass('active');
                $(this).addClass('active');
            }

            // Filter data
            $(container).find('.filters .filter.active').each(function(){
                filters.push( $(this).attr('data-filter') );
            });

            filterString = filters.join('.');

            if (filterString) {
                $(container).find('.filter-item').not('.'+filterString).addClass('filtered');
                $(container).find('.filter-item.'+filterString).removeClass('filtered');
            } else {
                $(container).find('.filter-item').removeClass('filtered');
            }

            if (!$(container).find('.filter-item').not('.filtered').length) {
                $(container).find('.no-results').fadeIn('fast');
            } else {
                $(container).find('.no-results').hide();
            }
        });
    });

    // Default filter taken from request params
    if (filter) {
        $('a.filter[data-filter="'+filter+'"]').trigger('click')
    }
}

function initMegaMenu() {
    $('#header li.has-children a.subnav-link').click(function (e) {
        e.preventDefault();
        var target = $(this).attr('href');

        // Display proper menu
        if ($(this).hasClass('subnav-open')) {
            $(this).removeClass('subnav-open');

            $('#header .subnav').slideUp("fast", function() {
                // Animation complete.
            });

            //$('#header .subnav').hide();
        } else {
            $('#header a.subnav-link').removeClass('subnav-open');
            $(this).addClass('subnav-open');
            $('#header .subnav-item').removeClass('active');
            $('#header .subnav').find(target).addClass('active');

            $('#header .subnav').slideDown("fast", function() {
                // Animation complete.
            });
        }

        e.stopPropagation();
    });

    $('body').off('click').on('click', function() {
        $('#header a.subnav-link').removeClass('subnav-open');

        $('#header .subnav').slideUp("fast", function() {
         //Animation complete.
        });
    });
}

function initMenu() {
    // Init toggle button animations
    $('a.c-hamburger').click(function (e) {
        var linked = $(this).data('linked');
        e.preventDefault();
        $(this).toggleClass('is-active');
        $(linked).toggleClass('is-active');
    });

    // Init Push Menus
    $('.toggle-push').jPushMenu({
       closeOnClickLink: false
    });


    // Init Side Menu
    $.each($('#side-menu .side-menu-block li'), function () {
        if ($(this).find('> ul').length > 0) {
            $(this).find('> a').before('<a class="sub-menu-button"></a>');

            if ($(this).hasClass('current') || $(this).hasClass('active')) {
                $(this).addClass('opened').find('> ul').show();
            }
        }
    });

    $(document).on('click', '#side-menu .side-menu-block li.has-children > a', function (e) {
        var li = $(this).parent();
        var ul = $(li).find('> ul');

        if (!$(this).hasClass('sub-menu-button') && $(li).hasClass('opened')) {
            return true;
        }

        if ($(ul).length > 0) {
            if ($(li).hasClass('opened')) {
                $(li).removeClass('opened');
                $(ul).slideUp('medium');
            }
            else {
                $(li).addClass('opened');
                $(ul).slideDown('medium');
            }
        }

        e.preventDefault();
    });

    /*$(document).on('click', '#side-menu .side-menu-block li .sub-menu-button', function (e) {
        e.preventDefault();
        var li = $(this).parent();
        var ul = $(li).find('> ul');
        if ($(ul).length > 0) {
            if ($(li).hasClass('opened')) {
                $(li).removeClass('opened');
                $(ul).slideUp('medium');
            }
            else {
                $(li).addClass('opened');
                $(ul).slideDown('medium');
            }
        }
     });*/
}

function initTooltip() {
    $('[data-toggle="tooltip"]').tooltip();
}

function initSameHeight() {
    $(".sameheight").sameHeight();
}

function initScroll() {
    $('#scroll').removeClass('hidden');
    refreshScroll();

    $(window).scroll(function() {
        refreshScroll();
    });

    // Back to top button handler
    $('#back-to-top').click(function(e) {
        e.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, 750);
        return false;
    });
}

function refreshScroll() {
    var scrollOffset = 0;
    var backToTopOffset = 350;

    // Scroll Icon
    if ($(this).scrollTop()>scrollOffset) {
        $('#scroll').hide();
    } else {
        $('#scroll').show();
    }

    // Back To Top
    if ($(this).scrollTop()>backToTopOffset) {
        $('#back-to-top').show();
    } else {
        $('#back-to-top').hide();
    }
}

function modernizrPlaceholder() {
    if (!Modernizr.input.placeholder) {
        $('[placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function () {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur();
        $('[placeholder]').parents('form').submit(function () {
            $(this).find('[placeholder]').each(function () {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            })
        });
    }
}

function lightbox() {
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
        event.preventDefault();

        $(this).ekkoLightbox({
            onShow: function () {
                var modal = this.modal;
                $(modal).css({'visibility': 'hidden'});
            },
            onShown: function () {
                var modal = this.modal, dialog = modal.find('.modal-dialog');
                $(modal).css({'visibility': 'visible'});
            }
        });
    });
}

function initReadMore() {
    $('a.read-more').click(function (e) {
        e.preventDefault();
        $(this).remove();
    });
}

function animateElements() {
    // Init WOW
    new WOW().init();
    $('.wow.hidden').removeClass('hidden');
}

function ulToggle() {
    $(document).on('click', 'li > .toggle, li > .toggle + span', function (e) {
        e.preventDefault();
        var li = $(this).parent();
        var ul = $(li).find('> ul');
        if ($(li).hasClass('active')) {
            $(ul).show();
            $(ul).slideUp(200, function () {
                $(li).removeClass('active');
            });
        }
        else {
            $(ul).hide();
            $(ul).slideDown(200, function () {
                $(li).addClass('active');
            });
        }
    });
}

function isNullOrWhitespace( input ) {

    if (typeof input === 'undefined' || input == null) return true;

    return input.replace(/\s/g, '').length < 1;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
    }
    return urlparameter;
}
