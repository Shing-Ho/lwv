$.fn.sameHeight = function (params) {
    var config = {
        mobile: 0,
        outerHeight: true,
        resize: true
    };

    if (params != undefined) {
        if (params.mobile != undefined && params.mobile > 0) {
            config.mobile = params.mobile;
        }
        if (params.outerHeight != undefined && params.outerHeight === false) {
            config.outerHeight = false;
        }
        if (params.resize != undefined && params.resize === false) {
            config.resize = false;
        }
    }

    var el = this;
    if (config.resize === true) {
        if (el.length > 0 && !el.data('sameHeight')) {
            $(window).bind('resize.sameHeight', function () {
                el.sameHeight(params);
            });
            el.data('sameHeight', true);
        }
    }

    var blocks_height = 0;

    $.each($(el), function () {
        var width = window.innerWidth != null ? window.innerWidth : $(window).width();
        if (config.outerHeight === true) {
            var height = $(this).height('auto').outerHeight(true);
        }
        else {
            var height = $(this).height('auto').outerHeight();
        }
        if (!config.mobile || width > config.mobile) {
            if (height > blocks_height) {
                blocks_height = height;
            }
        }
    });

    $.each($(el), function () {
        if ($(this).height() < blocks_height) {
            $(this).css({height: blocks_height + 'px'});
        }
        else {
            $(this).css({height: ''});
        }
    });
};