$(function () {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).data('page');

        $.ajax({
            type: 'POST',
            url: Routing.generate('api.entry.index', {page: page}),
            dataType: 'json'
        }).done(function (data) {
            var table = $('table.table tbody').empty();
            $.each(data.entries, function (index, entry) {
                var buttons = '';
                buttons += '<a class="btn btn-default btn-xs" href="' + Routing.generate('entry.edit', {id: entry.id}) + '"><span aria-hidden="true" class="glyphicon glyphicon-edit"></span> Módosítás</a> ';
                buttons += '<a class="btn btn-default btn-xs" href="' + Routing.generate('entry.delete', {id: entry.id}) + '"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span> Törlés</a>';

                var row = $('<tr>');
                row.append($('<td>').text(entry.name));
                row.append($('<td>').text(new Date(entry.created_at).format('yyyy-mm-dd HH:MM:ss')));
                row.append($('<td>').text(new Date(entry.updated_at).format('yyyy-mm-dd HH:MM:ss')));
                row.append($('<td>').html(buttons));

                table.append(row);
            });

            $('.navigation .pagination').replaceWith(data.pagination);

            history.pushState(null, null, 'entries?page=' + page);
        });
    });
});
