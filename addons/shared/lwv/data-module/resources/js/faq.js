$(function () {
    initFaqForm();

    $('select[name="faq_layout"]').on('change', function() {
        initFaqForm();
    });
});

function initFaqForm() {
    var layout = $('select[name="faq_layout"]').find(":selected").val();

    if (layout == "linked") {
        $(".form-group.link_url-field, .form-group.link_target-field").parent().show().closest(".card").show();
    } else {
        $(".form-group.link_url-field, .form-group.link_target-field").parent().hide();
    }

    if (layout == "content") {
        $(".form-group.answer-field").parent().show().closest(".card").show();
    } else {
        $(".form-group.answer-field").parent().hide();
    }

    $("form .card").not(".controls").each(function() {
        if (!$(this).find(".form-group:visible").length) {
            $(this).hide();
        }
    });
}