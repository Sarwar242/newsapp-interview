let columns = [
    { data: 'id' },
    { data: 'employee_id' },
    { data: 'client_id' }, 
    { data: 'operator_id' },
    { data: 'created_at' },

    { data: 'action', name: 'action', orderable: false, searchable: false, responsive: true },
];
let column_defs = [
    { targets: 5, visible: true },
    { "className": "text-center", "targets": [0, 1, 2, 3, 4, 5] }
];

var table = $('#dataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/advanced/block-users",
        data: function (d) {
            d.is_deleted = $("#isDeleted").val()
        }
    },
    columns: columns,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            text: '<i class="fas fa-download"></i> Export',
            extend: 'collection',
            className: 'custom-html-collection pull-right',
            buttons: [
                'pdf',
                'csv',
                'excel',
            ]
        },
        { html: colVisibility('#dataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="' + BASE_URL + '/advanced/block-users/create"><i class="fas fa-plus"></i> Add New</a>' }
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: {
            pageLength: {
                _: "%d rows",
            }
        }
    }
});

executeColVisibility(table);
// End Tables

window.filterStatus = function (status, type = '') {
    if (type == 'is_deleted') {
        $("#isDeleted").val(1);
    }
    else {
        $("#userStatus").val(status);
        $("#isDeleted").val(0);
    }
    table.ajax.reload();
}

window.unblockUser = function (id)
{
    loading('show');

    axios.post(BASE_URL + '/advanced/block-users/' + id + '/delete')
        .then(response => {
            notify(response.data.message, 'success');
            table.ajax.reload();
        })
        .catch(error => {
            const response = error.response;
            if (response)
                notify(response.data.message, 'error');
        })
        .finally(() => {
            loading('hide');
        });
}

