if (!Array.prototype.last) {
    Array.prototype.last = function () {
        return this[this.length - 1];
    };
}

$(function () {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).data('page');

        $.ajax({
            type: 'POST',
            url: Routing.generate('api.entry.index', {page: page}),
            dataType: 'json'
        }).done(function (data) {
            renderTable(data);

            history.pushState(null, null, '?page=' + page);

            $('a.sortable').each(function (index, sortable) {
                var href = $(sortable).attr('href');
                href = href.replace(/page=\d/, 'page=' + page);
                $(sortable).attr('href', href);
            });
        });
    });

    $(document).on('click', 'a.sortable', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var parsedUri = parseUri(href);

        var page = parsedUri.queryKey.page;
        var sort = parsedUri.queryKey.sort;
        var direction = parsedUri.queryKey.direction;

        if (direction == 'asc') {
            direction = 'desc'
        } else {
            direction = 'asc';
        }

        href = replaceGet(href, 'page', page);
        href = replaceGet(href, 'sort', sort);
        href = replaceGet(href, 'direction', direction);

        $(this).attr('href', href);

        $.ajax({
            type: 'POST',
            url: Routing.generate('api.entry.index', {page: page, sort: sort, direction: direction}),
            dataType: 'json'
        }).done(function (data) {
            renderTable(data);

            history.pushState(null, null, '?page=' + page + '&sort=' + sort + '&direction=' + direction);
        });
    });

    $(document).on('click', 'table.table tbody tr', function () {
        var id = $(this).data('id');

        $.ajax({
            type: 'GET',
            url: Routing.generate('api.entry.show', {id: id}),
            dataType: 'json'
        }).done(function (data) {
            var content = 'Név: ' + data.name + '<br/>';

            content += '<br/>Címek:<br/>';
            $.each(data.addresses, function (index, address) {
                content += address.address + '<br/>';
            });

            content += '<br/>E-mail címek:<br/>';
            $.each(data.emails, function (index, email) {
                content += email.email + '<br/>';
            });

            content += '<br/>Telefonok:<br/>';
            $.each(data.phones, function (index, phone) {
                content += phone.phone + '<br/>';
            });

            var modal = $('#details-modal');
            modal.find('.modal-body').html(content);
            modal.modal();
        });
    });

    function renderTable(data) {
        var table = $('table.table tbody').empty();
        $.each(data.entries, function (index, entry) {
            var row = $('<tr>').attr('data-id', entry.id);
            row.append($('<td>').text(entry.name));
            row.append($('<td>').text(entry.addresses.last().address));
            row.append($('<td>').text(entry.emails.last().email));
            row.append($('<td>').text(entry.phones.last().phone));

            table.append(row);
        });

        $('.navigation .pagination').replaceWith(data.pagination);
    }
});
