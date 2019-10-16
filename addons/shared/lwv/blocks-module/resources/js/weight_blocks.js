//$(document).ready(function () {
$(function() {
    
    var table = $('table[data-sortable]').sortable({
        handle: '.handle',
        itemSelector: 'tr',
        itemPath: '> tbody',
        containerSelector: 'table',
        placeholder: '<tr class="placeholder"/>',
        afterMove: function ($placeholder) {
            $placeholder.closest('table').find('.dragged').detach().insertBefore($placeholder);
        },
        onDrop: function ($item, container, _super, event) {
            order = new Array();

            $('tbody tr', table).each(function(){
                order.push( $(this).find('input[name="action_to[]"]').val() );
            });
            page = $('table[data-sortable]').find('input[name="page"]').val();
            order = order.join(',');

            $.post('/admin/blocks/order', {
                page: page,
                order: order
            }).success(function(data) {

            });

            _super($item, container);
        }
    });

});

