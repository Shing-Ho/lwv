$(function () {
    initImageForm();

    $('select[name="image_layout"]').on('change', function() {
        initImageForm();
    });
});

function initImageForm() {
    var layout = $('select[name="image_layout"]').find(":selected").val();

    if (layout == "linked" || layout == "video") {
        $(".field-group.link_url").show().closest(".card").show();
    } else {
        $(".field-group.link_url").hide();
    }

    if (layout == "linked") {
        $(".field-group.link_target").show().closest(".card").show();
    } else {
        $(".field-group.link_target").hide();
    }

    if (layout == "text") {
        $(".field-group.overlay").show().closest(".card").show();
    } else {
        $(".field-group.overlay").hide();
    }

    if (layout == "content") {
        $(".field-group.modal_image,.field-group.modal_body").show().closest(".card").show();
    } else {
        $(".field-group.modal_image,.field-group.modal_body").hide();
    }

    $("form .card").not(".controls").each(function() {
        if (!$(this).find(".form-group:visible").length) {
            $(this).hide();
        }
    });
}