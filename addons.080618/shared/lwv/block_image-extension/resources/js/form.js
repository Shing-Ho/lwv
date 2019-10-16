$(function () {
    initBlockForm();

    $('select[name="layout"]').on('change', function() {
        initBlockForm();
    });
});

function initBlockForm() {
    var layout = $('select[name="layout"]').find(":selected").val();

    if (layout == "left" || layout == "right" || layout == "bannerbg") {
        $(".field-group.alignment").show().closest(".card").show();
    } else {
        $(".field-group.alignment").hide();
    }

    $("form .card").not(".controls").each(function() {
        if (!$(this).find(".form-group:visible").length) {
            $(this).hide();
        }
    });
}