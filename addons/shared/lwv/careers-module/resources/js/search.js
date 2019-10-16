(function ($) {
    "use strict";

    var $grid;

    $(document).ready(function () {

        // Search Form Handler
        $('form.career-search').submit( function() {
            var target = $('#career-search-results');

            $.ajax({
                url     : $(this).attr('action'),
                type    : $(this).attr('method'),
                dataType: 'html',
                data    : $(this).serialize(),
                success : function( data ) {
                    var data = $(data);
                    target.empty().html(data);
                    initSearchResults();

                    setTimeout(function(){
                        $('html, body').animate({
                            scrollTop: target.offset().top -150
                        }, 400);
                    }, 100);

                }
            });

            return false;
        });
    });

    // Init search results
    function initSearchResults() {
        // SameHeight
        $.each($('.team-results'), function () {
            $(this).find('.team-result').sameHeight({mobile: 768, outerHeight: false});
        });

        // Init Application Forms
        initApplyForm();

        $('.team-result').on('click', 'a.apply', function (e) {
            e.preventDefault();
            var item = $(this).closest('.result-item');

            $(item).find('.application').removeClass('hidden');
            $grid.isotope('layout');
        });


        // Init Isotope
        $grid = $('.team-results-items').isotope({
            itemSelector: '.result-item',
            layoutMode: 'masonry'
        });

        // Isotope Filter
        $('.team-results .department-filter').on('click', 'a.filter', function (e) {
            e.preventDefault();
            var filterValue = $(this).attr('data-filter');

            // Hide details
            resetSearchResults();

            // Apply filter
            if (filterValue != '*') {
                filterValue = '.' + filterValue;
                $(this).closest('.department-filter').find('.active').removeClass('active');
                $(this).addClass('active');
            } else {
                $('.filters').find('.active').removeClass('active');
                $('.filters').find('.filter[data-filter="*"]').addClass('active');
            }
            $grid.isotope({filter: filterValue});
        });

        // Job Detail
        $('.team-result').on('click', 'a.detail', function (e) {
            e.preventDefault();
            var results = $(this).closest('.team-results-items');
            var item = $(this).closest('.result-item');
            var filterValue = '#'+$(item).attr('id');

            $('.filters').find('.filter.active').removeClass('active');

            $('html, body').animate({
                scrollTop: results.offset().top-150
            }, 100);

            $(item).addClass('detail').find('.summary').addClass('hidden').next().removeClass('hidden');
            $grid.isotope({filter: filterValue});
        });
    }

    function initApplyForm() {
        initDropzone();

        $('form.career-apply').each(function() {
            initAjaxForm($('#'+$(this).attr('id')),successCareerApplyForm);
        });

        // Initialize character counter
        $('textarea[data-provides="anomaly.field_type.textarea"]').each(function () {
            var wrapper = $(this).closest('div');
            var counter = wrapper.find('.counter');

            $(this).characterCounter({
                limit: $(this).data('max'),
                counterSelector: $(this).closest('div').find('.count'),
            });
        });
    }

    function resetSearchResults() {
        $('.result-item.detail').removeClass('detail').find('.summary').removeClass('hidden').next().addClass('hidden').next().addClass('hidden');
    }

    function successCareerApplyForm(form,data) {
        form.slideUp('fast', function() {
            $(this).closest('.team-result-content').find('a.apply').hide();
            $(this).closest('.application').find('.confirmation').removeClass('hidden');
            $(this).remove();
            $grid.isotope('layout');
        });
    }

})(jQuery);
