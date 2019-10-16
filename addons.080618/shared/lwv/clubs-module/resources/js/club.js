$(function () {
    initClubForm();

    $('select[name="hosting"]').on('change', function() {
        initClubForm();
    });
});

function initClubForm() {
    var hosting = $('select[name="hosting"]').find(":selected").val();

    if (hosting == "external") {
        $(".field-group.url").show().closest(".card").show();
    } else {
        $(".field-group.url").hide();
    }

    if (hosting == "internal") {
        $(".field-group.admins").show().closest(".card").show();
    } else {
        $(".field-group.admins").hide();
    }

    $("form .card").not(".controls").each(function() {
        if (!$(this).find(".form-group:visible").length) {
            $(this).hide();
        }
    });
}