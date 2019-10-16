$(function () {

    // Initialize pickers
    $('.blocks-field_type').each(function () {
        var wrapper = $(this);
        var modal = wrapper.find('div.modal');

        modal.on('click', '[data-page],[data-block-type],[data-block-id]', function (e) {
            e.preventDefault();

            modal.find('.modal-content').append('<div class="modal-loading"><div class="active loader"></div></div>');

            var data = {block_type:$(this).data('block-type'),block_id:$(this).data('block-id'),page:$(this).data('page')};
            $.ajax({
                type: "POST",
                url: '/admin/blocks/copy',
                data: data,
                dataType: "json",
                success: function(jsonData){
                    location.reload();
                }
            });

        });
    });

});
